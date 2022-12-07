<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\Common;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\RefreshToken;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class AccountFeed
{
    protected $cacheHandler;

    public function __construct()
    {
        $this->cacheHandler = new CacheHandler('instagram');
    }

    /**
     * Get Accounts Feed
     *
     * @param array $accountIds
     *
     * @return array
     * @since 1.3.0
     */
    public function getMultipleAccountResponse($accountIds)
    {
        $response          = array();
        $connectedAccounts = (new Common())->findConnectedAccounts();
        foreach ($accountIds as $index => $accountId) {
            $accountDetails     = Arr::get($connectedAccounts, $accountId) ? $connectedAccounts[$accountId] : '';
            if(empty($accountDetails)){
                continue;
            }

            $userName = $accountDetails ? $accountDetails['username'] : '';
            $resultWithComments = array();
            if ($accountDetails) {
                $feedCacheName   = 'user_account_feed_id_' . $accountId;
                $instagramApiUrl = $this->getApiUrl($accountDetails);
                // return errors
                if ( is_array($instagramApiUrl) && (new Common())->instagramError($instagramApiUrl)) {
                    return array($userName => $instagramApiUrl);
                }
	            $resultWithComments = $this->cacheHandler->getFeedCache($feedCacheName);

                if (!$resultWithComments) {
                    $resultWithoutComments = (new Common())->expandWithoutComments($instagramApiUrl);
                    if ((new Common())->instagramError($resultWithoutComments)) {
                        return array($userName => $resultWithoutComments);
                    }
                    if (!(new Common())->instagramError($resultWithoutComments)) {
                        $resultWithComments = (new Common())->expandWithComments($accountDetails,
                            $resultWithoutComments);
                        if ((new Common())->instagramError($resultWithComments)) {
                            return array($userName => $resultWithComments);
                        }
                        $this->cacheHandler->createCache($feedCacheName, $resultWithComments);
                    } else {
                        $resultWithComments = false;
                    }
                }
            }
            $response[$index] = $resultWithComments ? $resultWithComments : array();
        }

        $accountFeed = array();

        foreach ($response as $index => $feeds) {
            $accountFeed = array_merge($accountFeed, $feeds);
        }

        return $accountFeed;
    }

    public function getApiUrl($accountDetails)
    {
        $num    = apply_filters('wpsocialreviews/instagram_feeds_limit', 10);
        $apiUrl = '';
        if ($accountDetails['api_type'] === 'business') {
            $apiUrl = 'https://graph.facebook.com/' . $accountDetails['user_id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit=' . $num . '&access_token=' . $accountDetails['access_token'].'&status_code=PUBLISHED';
        } elseif ($accountDetails['api_type'] === 'personal') {
            $accessToken = (new RefreshToken())->getAccessToken($accountDetails);

            // return errors
            if (is_array($accessToken) && (new Common())->instagramError($accessToken)) {
                return $accessToken;
            }
            $apiUrl      = 'https://graph.instagram.com/' . $accountDetails['user_id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit=' . $num . '&access_token=' . $accessToken.'&status_code=PUBLISHED';
        }

        return $apiUrl;
    }
}
