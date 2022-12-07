<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle Google Reviews Place Id and Api Key
 * @since 1.0.0
 */
class GoogleMyBusiness extends BaseReview
{
    private $remoteBaseUrl = 'https://mybusiness.googleapis.com/v4/';
    private $redirect = 'https://wpsocialninja.com/gapi/';
    private $clientId = '1066221839285-b63ib6vnhv9aed2euhtecbp2nojvq9rp.apps.googleusercontent.com';
    private $clientSecret = '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';
    private $placeId;
    public $nextPageToken = '';

    public function __construct()
    {
        parent::__construct(
            'google',
            'wpsr_reviews_google_settings',
            'wpsr_google_reviews_update'
        );
    }

    public function makeRequest($url, $bodyArgs, $type = 'GET', $headers = false)
    {
        if (!$headers) {
            $headers = array(
                'Content-Type'              => 'application/http',
                'Content-Transfer-Encoding' => 'binary',
                'MIME-Version'              => '1.0',
            );
        }

        $args = [
            'headers' => $headers
        ];
        if ($bodyArgs) {
            $args['body'] = json_encode($bodyArgs);
        }

        $args['method'] = $type;
        $request        = wp_remote_request($url, $args);

        if (is_wp_error($request)) {
            $message = $request->get_error_message();

            return new \WP_Error(423, $message);
        }

        $body = json_decode(wp_remote_retrieve_body($request), true);

        if (!empty($body['error'])) {
            $error = 'Unknown Error';
            if (isset($body['error_description'])) {
                $error = $body['error_description'];
            } elseif (!empty($body['error']['message'])) {
                $error = $body['error']['message'];
            }

            return new \WP_Error(423, $error);
        }

        return $body;
    }

    public function generateAccessKey($token)
    {
        $body = [
            'code'          => $token,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->redirect,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret
        ];

        return $this->makeRequest('https://accounts.google.com/o/oauth2/token', $body, 'POST');
    }

    public function getAccessToken()
    {
        $tokens = get_option('wpsr_reviews_google_verification_configs');
        if (!$tokens) {
            return false;
        }
        if (($tokens['created_at'] + $tokens['expires_in'] - 30) < time()) {
            // It's expired so we have to re-issue again
            $refreshTokens = $this->refreshToken($tokens);

            if(is_wp_error($refreshTokens)){
                $message = $refreshTokens->get_error_message();
                $code = $refreshTokens->get_error_code();
                wp_send_json_error([
                    'message' => $message
                ], $code);
            }

            if (!is_wp_error($refreshTokens)) {
                $tokens['access_token'] = $refreshTokens['access_token'];
                $tokens['expires_in']   = $refreshTokens['expires_in'];
                $tokens['created_at']   = time();
                update_option('wpsr_reviews_google_verification_configs', $tokens, 'no');
            } else {
                return false;
            }
        }

        return $tokens['access_token'];
    }

    private function refreshToken($tokens)
    {

        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;

        //To support previous Google Authentication Process we must use the Previous App
        if( !isset($tokens['version']) ){
            $clientId = '1066221839285-ckecknkno31o1ma3ti37lv4fb3vlidhi.apps.googleusercontent.com';
            $clientSecret = 'mkhMmZ-0T2VEYuwEkfn5umqm';
        }

        $args = [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $tokens['refresh_token'],
            'grant_type'    => 'refresh_token'
        ];

        return $this->makeRequest('https://accounts.google.com/o/oauth2/token', $args, 'POST');
    }

    public function handleCredentialSave($settings = array())
    {
        $apiKey = $this->getAccessToken();

        if($apiKey) {
            $placeId = json_decode($settings['source_id'], true);
            try {
                $businessInfo = $this->verifyCredential($apiKey, $placeId);

                $myBusinessKey = '';
                $myBusinessKeys = explode('/', $placeId[0]);
                if(!empty($myBusinessKeys)) {
                    $myBusinessKey = $myBusinessKeys[3];
                }

                $message = Helper::getNotificationMessage($businessInfo, $myBusinessKey);

                if (Arr::get($businessInfo, 'total_fetched_reviews') && Arr::get($businessInfo, 'total_fetched_reviews') > 0) {
                    unset($businessInfo['total_fetched_reviews']);
                    update_option('wpsr_reviews_google_connected_accounts', $placeId, 'no');
                }

                // save caches when auto sync is on
                $apiSettings = get_option('wpsr_google_global_settings');
                if(Arr::get($apiSettings, 'global_settings.auto_syncing') === 'true'){
                    $this->saveCache();
                }

                wp_send_json_success([
                    'message' => $message,
                    'business_info' => $businessInfo
                ], 200);
            } catch (\Exception $exception) {
                wp_send_json_error([
                    'message' => $exception->getMessage()
                ], 423);
            }
        } else {
            wp_send_json_error([
                'message' => __('Something went wrong, please try again!', 'wp-social-reviews')
            ], 423);
        }
    }

    public function pushValidPlatform($platforms)
    {
        $settings = $this->getApiSettings();
        if ($settings['api_key'] && $settings['place_id']) {
            $platforms['google'] = __('Google', 'wp-social-reviews');
        }

        return $platforms;
    }

    public function verifyCredential($apiKey, $placeId)
    {
        $data = $this->fetchRemoteReviews($apiKey, $placeId);

        if (is_wp_error($data)) {
            throw new \Exception($data->get_error_message());
        }

        if(empty($data)) {
            throw new \Exception('No reviews fetched!');
        }

        $this->saveApiSettings([
            'api_key'  => $apiKey,
            'place_id' => $placeId
        ]);

        $business_info = $this->saveBusinessInfo($apiKey, $placeId, $data);

        $this->placeId = $placeId;
        $this->syncRemoteReviews($data['reviews']);

        $totalFetchedReviews = count($data['reviews']);

        if ($totalFetchedReviews > 0) {
            update_option('wpsr_reviews_google_business_info', $business_info, 'no');
        }

        $business_info['total_fetched_reviews'] = $totalFetchedReviews;
        return $business_info;
    }

    public function fetchRemoteReviews($apiKey, $placeId)
    {
        $fetchUrl = $this->remoteBaseUrl.$placeId[0].'/reviews';

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $apiKey,
            ),
        );

        $response = wp_remote_get($fetchUrl, $args);

        if (is_wp_error($response)) {
            return $response;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);


        if(Arr::get($data, 'nextPageToken')){
            $data['reviews'] = $this->getNextPageResponse($placeId, $data, $args);
        }


        if(Arr::get($data, 'error')){
            $error_message = Arr::get($data, 'error.message');
            throw new \Exception($error_message);
        }

        if (empty($data) || empty($data['reviews'])) {
            throw new \Exception(
                __('No reviews found!', 'wp-social-reviews')
            );
        }

        return $data;
    }

    public function getNextPageResponse($placeId, $data, $args)
    {
        $reviews = Arr::get($data, 'reviews');
        $this->nextPageToken = $data['nextPageToken'];
        $totalReviewCount = Arr::get($data, 'totalReviewCount');
        $limit = apply_filters('wpsocialreviews/gmb_reviews_limit', 100);
        $limit = $limit > 200 ? 200 : $limit;
        $total = $totalReviewCount >= $limit ? $limit : $totalReviewCount;
        $pageSize = 50;
        $pages = ceil($total/$pageSize);
        $x = 1;
        while($x < $pages) {
            $x++;
            $fetchUrl = $this->remoteBaseUrl.$placeId[0].'/reviews?pageToken='.$this->nextPageToken;
            $response = wp_remote_get($fetchUrl, $args);
            if (is_wp_error($response)) {
                return $response;
            }
            $data = json_decode(wp_remote_retrieve_body($response), true);
            $this->nextPageToken = $data['nextPageToken'];
            $reviews = array_merge($reviews, $data['reviews']);
        }
        return $reviews;
    }

    public function formatData($review, $index)
    {
        $accountId = explode('/', $this->placeId[0]);
        $locations     = get_option('wpsr_reviews_google_locations_list');

        $reviewDate = Arr::get($review, 'createTime');
        return [
            'platform_name' => $this->platform,
            'source_id'     => $accountId[3],
            'review_id'     => Arr::get($review, 'reviewId'),
            'reviewer_name' => Arr::get($review, 'reviewer.displayName'),
            'review_title'  => '',
            'reviewer_url'  => 'https://search.google.com/local/reviews?placeid='. $locations[$accountId[3]]['location_key'],
            'reviewer_img'  => Arr::get($review, 'reviewer.profilePhotoUrl'),
            'reviewer_text' => Arr::get($review, 'comment'),
            'rating'        => $this->convertRating(Arr::get($review, 'starRating')),
            'review_time'   => date('Y-m-d H:i:s', strtotime($reviewDate)),
            'review_approved' => 1,
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_at'    => date('Y-m-d H:i:s')
        ];
    }

    public function saveBusinessInfo($apiKey, $placeId, $reviewData)
    {
        $businessInfo  = [];
        $infos         = $this->getBusinessInfo();
        $infos = empty($infos) ? [] : $infos;

        if (empty($placeId)) {
            return [];
        }

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $apiKey,
            ),
        );

        $account = explode('/', $placeId[0]);
        $locationId = $account[3];

        $fetchUrl = "https://mybusinessbusinessinformation.googleapis.com/v1/locations/". $locationId ."?readMask=name,title,phoneNumbers,metadata,profile,relationshipData,serviceArea,serviceItems";
        $response = wp_remote_get($fetchUrl, $args);

        if (is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        $locationInfo = json_decode(wp_remote_retrieve_body($response), true);

        $locationId = explode('/', $locationInfo['name']);
        $businessInfo['place_id']       = $locationId[1];
        $businessInfo['name']           = Arr::get($locationInfo, 'title', '');
        $businessInfo['url']            = Arr::get($locationInfo, 'metadata.newReviewUri', '');
        $businessInfo['address']        = Arr::get($locationInfo, 'address', '');
        $businessInfo['average_rating'] = Arr::get($reviewData, 'averageRating');
        $businessInfo['total_rating']   = Arr::get($reviewData, 'totalReviewCount');
        $businessInfo['phone']          = Arr::get($locationInfo, 'phoneNumbers.primaryPhone', '');
        $businessInfo['platform_name']  = $this->platform;
        $infos[$locationId[1]]          = $businessInfo;

        return $infos;
    }

    public function getBusinessInfo($data = array())
    {
        return get_option('wpsr_reviews_google_business_info');
    }

    public function saveApiSettings($settings)
    {
        return update_option($this->optionKey, $settings, 'no');
    }

    public function getApiSettings()
    {
        $settings = get_option($this->optionKey);
        $apiSettings          = get_option('wpsr_reviews_google_verification_configs');
        if (!$settings) {
            $settings['api_key']  = Arr::get($apiSettings, 'access_token', '');
            $settings['place_id'] = [];
        }

        if (!$settings || empty($settings['api_key'])) {
            $settings = [
                'api_key'  => '',
                'place_id' => []
            ];
        }
        $settings['version'] = Arr::get($apiSettings, 'version', '');
        return $settings;
    }

    public function saveConfigs($accessCode = null)
    {
        try {
            if (empty($accessCode) || !$accessCode) {
                wp_send_json_error([
                    'message' => __('Access code should not be empty!', 'wp-social-reviews')
                ], 423);
            }

            $body = $this->generateAccessKey($accessCode);

            if (is_wp_error($body)) {
                throw new \Exception($body->get_error_message());
            }
            $body['created_at'] = time();
            $body['version'] = 'latest';

            $accessToken = Arr::get($body, 'access_token');
            $headers     = array(
                'Authorization' => 'Bearer ' . $accessToken,
            );

            $locationsLists = $this->getBusinessAccountId($headers);
            update_option('wpsr_reviews_google_verification_configs', $body, 'no');
            wp_send_json_success(
                [
                    'message'      => __('You are Successfully Verified', 'wp-social-reviews'),
                    'locations'    => $locationsLists,
                    'access_token' => $accessToken
                ],
                200
            );
        } catch (\Exception $exception) {
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    public function getAdditionalInfo()
    {
        $locationLists      = get_option('wpsr_reviews_google_locations_list');
        $connected_accounts = get_option('wpsr_reviews_google_connected_accounts');

        return [
            'location_lists'     => $locationLists,
            'connected_accounts' => $connected_accounts ? $connected_accounts : []
        ];
    }

    public function getBusinessAccountId($headers)
    {
        $fetchUrl     = "https://mybusinessaccountmanagement.googleapis.com/v1/accounts";
        $accountsData = $this->makeRequest($fetchUrl, false, 'GET', $headers);

        if (is_wp_error($accountsData)) {
            $message = $accountsData->get_error_message();
            wp_send_json_error([
                'message' => $message
            ], 423);
        }

        $locationsLists = array();
        if(isset($accountsData['accounts']) && !empty($accountsData['accounts'])) {
            foreach ($accountsData['accounts'] as $index => $accountData) {
                $account = explode('/', $accountData['name']);
                $accountId = $account[1];
                if ($accountId || !empty($accountId)) {
                    $locations = $this->getLocationsList($accountData, $headers);
                    if(!empty($locations)){
                        $locationsLists += $locations;
                    }
                }
            }
        }

        if (empty($locationsLists)) {
            wp_send_json_error([
                'message' => __('We don\'t find any business location from this email address', 'wp-social-reviews')
            ], 423);
        }

        update_option('wpsr_reviews_google_locations_list', $locationsLists, 'no');

        return get_option('wpsr_reviews_google_locations_list');
    }

    public function getLocationsList($accountData, $headers)
    {
        $fetchUrl = "https://mybusinessbusinessinformation.googleapis.com/v1/".$accountData['name']."/locations?pageSize=100&readMask=name,latlng,metadata,profile,serviceItems,title,openInfo";
        $data = $this->makeRequest($fetchUrl, false, 'GET', $headers);

        $locations = '';
        if (!empty($data) && (isset($data['locations']) && !empty($data['locations']))) {
            $locations = $this->getLocationInfo($data['locations'], $accountData);
        }

        return $locations;
    }

    public function getLocationInfo($locations = [], $accountData = [])
    {
        $locationInfo = [];
        $accountName = Arr::get($accountData, 'accountName');
        $accountType = Arr::get($accountData, 'type');
        $accountType = $accountType === 'PERSONAL' ? 'Personal' : 'Group';

        $account = explode('/', $accountData['name']);
        $accountId = $account[1];

        global $wpdb;
        $charset = $wpdb->get_col_charset( $wpdb->posts, 'post_content' );

        foreach ($locations as $index => $location) {
            if(isset($location['metadata']['placeId'])) {
                $locationName = explode('/', $location['name']);
                $locationId = $locationName[1];
                $locationInfo[$locationId]['accountId']    = $accountId;
                $locationInfo[$locationId]['accountName']  = $accountName;
                $locationInfo[$locationId]['accountType']  = $accountType;
                $locationInfo[$locationId]['locationId']   = $locationId;
                $locationInfo[$locationId]['locationName'] = 'utf8' === $charset ? wp_encode_emoji($location['title']) : $location['title'];
                $locationInfo[$locationId]['place_id']     = $accountData['name'].'/'. $location['name'];
                $locationInfo[$locationId]['location_key'] = $location['metadata']['placeId'];
            }
        }

        return $locationInfo;
    }

    public function convertRating($ratingStrVal)
    {
        if ($ratingStrVal === 'FIVE') {
            return 5;
        } elseif ($ratingStrVal === 'FOUR') {
            return 4;
        } elseif ($ratingStrVal === 'THREE') {
            return 3;
        } elseif ($ratingStrVal === 'TWO') {
            return 2;
        } elseif ($ratingStrVal === 'ONE') {
            return 1;
        } else {
            return 0;
        }
    }

    public function manuallySyncReviews($credentials)
    {
        $locationLists      = get_option('wpsr_reviews_google_locations_list');
        $placeId = Arr::get($credentials, 'place_id', '');
        if (isset($locationLists[$placeId])) {
            $place = $locationLists[$placeId]['place_id'];
            $apiKey = $this->getAccessToken();
            if($apiKey){
                try {
                    $this->verifyCredential($apiKey, [0 => $place]);
                    wp_send_json_success([
                        'message'    => __('Reviews synced successfully!', 'wp-social-reviews'),
                        'credentials'      => $credentials,
                    ]);
                } catch (\Exception $exception){
                    error_log($exception->getMessage());
                }
            }
        }
    }

    public function doCronEvent()
    {
        $cacheHandler = new cacheHandler($this->platform);
        $expiredCaches =  $cacheHandler->getExpiredCaches();
        if(!$expiredCaches) {
            return false;
        }

        $settings = get_option($this->optionKey);

        if (in_array($settings['place_id'][0], $expiredCaches)) {
            //find api key and place id
            $apiKey = $this->getAccessToken();
            if($apiKey) {
                try {
                    $this->verifyCredential($apiKey, $settings['place_id']);
                } catch (\Exception $exception) {
                    error_log($exception->getMessage());
                }
            }

            $cacheHandler->createCache(
                'wpsr_reviews_' . $this->platform . '_business_info_' . $settings['place_id'][0],
                $settings['place_id'][0]
            );
        }
    }
}