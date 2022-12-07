<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Twitter;

use WpFluent\Exception;
use WPSocialReviews\App\Models\Cache;
use WPSocialReviews\App\Services\Platforms\Feeds\BaseFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;
use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Config as TwitterConfig;
use WPSocialReviews\App\Services\Platforms\Feeds\Common\FeedFilters;
use WPSocialReviews\App\Services\GlobalSettings;

class TwitterFeed extends BaseFeed
{
    protected $consumerKey = 'sh28wFaco96FXhzEWuKY71k4z';
    protected $consumerSecret = 'pJASn62pdt60DjlUi4OWvL8guRVnnAhuhRl5xaqnqfz6oRXxuO';
    protected $baseFeedUrl = 'https://api.twitter.com/1.1/';
    protected $totalFeed = 10;
    protected $paginate = 6;
    protected $cacheHandler;
    protected $isTwitterConnected = false;
    public $platform = 'twitter';
    public $transient_name;
    private $cronScheduleName = 'wpsr_twitter_feed_update';

    public function __construct()
    {
        parent::__construct($this->platform);
        $this->cacheHandler = new CacheHandler($this->platform);
    }

    public function pushValidPlatform($platforms)
    {
        $isActive = get_option('wpsr_'.$this->platform.'_verification_configs');
        if($isActive) {
            $platforms['twitter'] = __('Twitter', 'wp-social-reviews');
        }
        return $platforms;
    }

    public function verifyApiCredentials($settings = array())
    {
        $requestMethod = "GET";
        $apiUrl        = $this->baseFeedUrl . 'account/verify_credentials.json';
        $twitterApi    = new TwitterApi($settings);

        try {
            $response = $twitterApi->buildOauth($apiUrl, $requestMethod)->performRequest();
            if (Arr::get($response, 'errors') || Arr::get($response, 'error')) {
                $errorMessage = __('Can\'t authenticate you,please provide valid information', 'wp-social-reviews');
                if (Arr::get($response, 'errors') && isset($response['errors'][0]['message'])) {
                    $errorMessage = $response['errors'][0]['message'];
                }
                if (Arr::get($response, 'error')) {
                    $errorMessage = $response['error'];
                }
                throw new \Exception($errorMessage);
            }

            return $response;
        } catch (\Exception $exception) {
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    public function getCredentialsSettings($args = array())
    {
        $settings = array();
        if (Arr::get($args, 'manual_connect')) {
            $settings['consumer_key']    = Arr::get($args, 'consumer_key');
            $settings['consumer_secret'] = Arr::get($args, 'consumer_secret');
        } else {
            $settings['consumer_key']    = $this->consumerKey;
            $settings['consumer_secret'] = $this->consumerSecret;
        }
        $settings['oauth_access_token']        = Arr::get($args, 'oauth_access_token');
        $settings['oauth_access_token_secret'] = Arr::get($args, 'oauth_access_token_secret');
        $settings['manual_connect']            = Arr::get($args, 'manual_connect');
        $settings['platform']                  = Arr::get($args, 'platform');
        $this->isTwitterConnected              = true;

        return $settings;
    }

    public function handleCredential($args = array())
    {
        $settings                = $this->getCredentialsSettings($args);
        $response                = $this->verifyApiCredentials($settings);
        $settings['screen_name'] = Arr::get($response, 'screen_name', '');
        $dynamicConfigs          = ['dynamic' => $settings];
        update_option('wpsr_twitter_verification_configs', $dynamicConfigs, 'no');
        $settings = get_option('wpsr_twitter_verification_configs');

        // add global twitter settings when user verified
        $args = array(
            'global_settings' => array(
                'expiration'    => 60*60*6,
                'caching_type'  => 'background'
            )
        );

        update_option('wpsr_twitter_global_settings', $args);

        wp_send_json_success([
            'message'  => __('Twitter Successfully Connected!', 'wp-social-reviews'),
            'settings' => $settings
        ], 200);
    }

    public function getVerificationConfigs()
    {
        $twitterConfig = get_option('wpsr_twitter_verification_configs');
        wp_send_json_success([
            'message'  => __('Twitter Successfully Connected!', 'wp-social-reviews'),
            'settings' => $twitterConfig
        ], 200);
    }

    public function clearVerificationConfigs()
    {
        $settings = delete_option('wpsr_twitter_verification_configs');
        delete_option('wpsr_twitter_global_settings');
        wp_clear_scheduled_hook($this->cronScheduleName);
        $this->cacheHandler->clearCache();

        wp_send_json_success([
            'message'  => __('Twitter Successfully Disconnected!', 'wp-social-reviews'),
            'settings' => $settings
        ], 200);
    }

    public function getTemplateMeta($settings = array())
    {
        $formatted_feed_template_meta = $settings;

        //feed settings to simplify repetitive use
        $feed_settings = Arr::get($formatted_feed_template_meta, 'feed_settings', []);
        //get dynamic response
        $apiSettings = Arr::get($feed_settings, 'additional_settings', []);
        $feed_type   = Arr::get($apiSettings, 'additional_settings.feed_type', '');
        $count       = Arr::get($apiSettings, 'additional_settings.feed_count', $this->totalFeed);

        $response       = $this->apiConnectionResponse($feed_type, $count, $formatted_feed_template_meta);
        $filterSettings = Arr::get($feed_settings, 'filters', []);

        if (isset($response['error_message'])) {
            $filterResponse = $response;
        } else {
            $filterResponse = (new FeedFilters())->filterFeedResponse($this->platform, $filterSettings, $response);
        }

        $formatted_feed_template_meta['dynamic']       = Arr::get($filterResponse, 'items', []);
        $formatted_feed_template_meta['header']        = Arr::get($filterResponse, 'header', []);
        $formatted_feed_template_meta['error_message'] = Arr::get($filterResponse, 'error_message', []);

        return $formatted_feed_template_meta;
    }

    public function getEditorSettings($postId = null)
    {
        $twitterConfig = new TwitterConfig();

        $feed_template_meta = get_post_meta($postId, '_wpsr_template_config', true);
        $feed_template_style_meta = get_post_meta($postId, '_wpsr_template_styles_config', true);
        $decodedMeta        = json_decode($feed_template_meta, true);
        $feed_settings      = Arr::get($decodedMeta, 'feed_settings', []);
        $feed_settings      = Config::formatTwitterConfig($feed_settings, array());
        $settings           = $this->getTemplateMeta($feed_settings);

        $settings['styles_config'] = $twitterConfig->formatStylesConfig(json_decode($feed_template_style_meta, true), $postId);
        $templateDetails    = get_post($postId);

        $translations = GlobalSettings::getTranslations();
        wp_send_json_success([
            'message'          => __('Success', 'wp-social-reviews'),
            'settings'         => $settings,
            'template_details' => $templateDetails,
            'elements'  => $twitterConfig->getStyleElement(),
            'translations'     => $translations
        ], 200);
    }

    public function editEditorSettings($configs = array(), $postId = null)
    {
        $styles_config = Arr::get($configs, 'styles_config');

        $feed_settings = Arr::get($configs, 'feed_settings', []);
        $feed_settings = Config::formatTwitterConfig($feed_settings, array());
        $settings      = $this->getTemplateMeta($feed_settings);

        $settings['styles_config'] = $styles_config;
        wp_send_json_success([
            'message'  => __('Twitter Settings Updated', 'wp-social-reviews'),
            'settings' => $settings,
        ], 200);
    }

    public function updateEditorSettings($settings = array(), $postId = null)
    {
        if(defined('WPSOCIALREVIEWS_PRO_VERSION')){
            (new \WPSocialReviewsPro\Classes\TemplateCssHandler())->saveCss($settings, $postId);
        }

        $unsetKeys = ['dynamic', 'header', 'styles_config', 'styles', 'responsive_styles'];
        foreach ($unsetKeys as $key){
            if(Arr::get($settings, $key, false)){
                unset($settings[$key]);
            }
        }

        $encodedMeta        = json_encode($settings, JSON_UNESCAPED_UNICODE);
        update_post_meta($postId, '_wpsr_template_config', $encodedMeta);
        wp_send_json_success([
            'message' => __('Template Saved Successfully!!', 'wp-social-reviews')
        ], 200);
    }

    /**
     * sets transient name for the caching system
     *
     * @param string $feed_type
     * @param integer $count
     * @param string $name
     * @param string $hashtag
     *
     * @return string
     * @since 2.0.0
     */
    public function setTransientName(string $feed_type, int $count, string $name, string $hashtag)
    {
        if ($feed_type === 'home_timeline') {
            $this->transient_name = $feed_type . '_num' . $count . '';
        } elseif ($feed_type === 'user_timeline') {
            $this->transient_name = $feed_type . '_name_' . $name . '_num' . $count;
        } elseif (($feed_type === 'hashtag' || $feed_type === 'user_mentions') && defined('WPSOCIALREVIEWS_PRO')) {
            $this->transient_name = apply_filters('wpsocialreviews/set_twitter_transient_name', $this->transient_name,
                $feed_type, $count, $hashtag);
        }

        return $this->transient_name;
    }

    /**
     * uses the endpoints to determining what get get fields need to be set
     *
     * @param string $name
     * @param integer $count
     * @param string $feed_type
     * @param string $hashtag
     *
     * @return string
     * @since 2.0.0
     */
    public function setGetFieldsString(string $name, int $count, string $feed_type, string $hashtag)
    {
        $get_field = '?count=' . intval($count);
        if ($feed_type === 'user_timeline') {
            $get_field = "?screen_name=" . $name . "&count=" . intval($count) . "&tweet_mode=extended&exclude_replies=true";
        } elseif ($feed_type === 'home_timeline') {
            $get_field = '?count=' . intval($count) . "&tweet_mode=extended&exclude_replies=true";
        } elseif (($feed_type === 'hashtag' || $feed_type === 'user_mentions') && defined('WPSOCIALREVIEWS_PRO')) {
            $get_field = apply_filters('wpsocialreviews/twitter_set_get_field', $feed_type, $count, $hashtag);
        }

        return $get_field;
    }

    /**
     * sets the complete url for API endpoint
     *
     * @param string $feed_type
     *
     * @return string
     * @since 2.0.0
     */
    public function setBaseUrl(string $feed_type)
    {
        $api_base_url = '';
        if ($feed_type === 'user_timeline') {
            $api_base_url = $this->baseFeedUrl . 'statuses/user_timeline.json';
        } elseif ($feed_type === 'home_timeline') {
            $api_base_url = $this->baseFeedUrl . 'statuses/home_timeline.json';
        } elseif (($feed_type === 'hashtag' || $feed_type === 'user_mentions') && defined('WPSOCIALREVIEWS_PRO')) {
            $api_base_url = apply_filters('wpsocialreviews/set_twitter_api_base_url', $feed_type, $this->baseFeedUrl);
        }

        return $api_base_url;
    }

    public function sendApiRequest($settings, $get_field, $api_base_url, $feed_type, $name)
    {
        $response      = array();
        $requestMethod = "GET";
        $twitterApi    = new TwitterApi($settings);

        $responseTwitter = $twitterApi->setGetfield($get_field)->buildOauth($api_base_url,
            $requestMethod)->performRequest();
        if (isset($responseTwitter['error'])) {
            return array('error_message' => $responseTwitter['error']);
        }

        if ($feed_type === 'hashtag' && defined('WPSOCIALREVIEWS_PRO')) {
            $responseTwitter = apply_filters('wpsocialreviews/twitter_feed_response', $responseTwitter);
        }

        $this->cacheHandler->createCache($this->transient_name, $responseTwitter);
        $response['items'] = $responseTwitter;

        if (defined('WPSOCIALREVIEWS_PRO') && $feed_type !== 'hashtag') {
            $headerCacheName    = 'twitter_feed_header_' . $name;
            $headerResponse     = $this->headerResponse($twitterApi, $name, $headerCacheName);
            $response['header'] = $headerResponse;
        }

        return $response;
    }

    public function headerResponse($twitterApi, $name, $headerCacheName)
    {
        $headerResponse = apply_filters('wpsocialreviews/twitter_feed_header_api_response', $twitterApi,
            $name, $this->baseFeedUrl);
        $hasError       = isset($headerResponse['error']);
        if (!$hasError) {
            $this->cacheHandler->createCache($headerCacheName, $headerResponse);

            return $headerResponse;
        }
    }

    public function apiConnectionResponse($feed_type, $count, $newConfigs = null)
    {
        //do not cache if no tweets found
        $configs = get_option('wpsr_twitter_verification_configs');
        $name    = $hashtag = '';
        if ($newConfigs) {
            $newConfigs = $newConfigs['feed_settings']['additional_settings'];
            $feed_type  = Arr::get($newConfigs, 'feed_type', '');
            $count      = Arr::get($newConfigs, 'feed_count', '');
            $name       = Arr::get($newConfigs, 'screen_name', '');
            $hashtag    = Arr::get($newConfigs, 'hashtag', '');
        }
        if (!$name || ($feed_type === 'user_mentions' || $feed_type === 'home_timeline')) {
            //for old settings
            if (isset($configs['dynamic']['screen_name'])) {
                $name = $configs['dynamic']['screen_name'];
            }
        }

        $settings = array();
        if (!empty($configs) && is_array($configs)) {
            $settings = $this->getCredentialsSettings($configs['dynamic']);
        }

        if (!empty($name)) {
            $this->transient_name = $this->setTransientName($feed_type, $count, $name, $hashtag);
            $response             = array();
            // check cache data exist or not
	        $response['items'] = $this->cacheHandler->getFeedCache($this->transient_name);
            if ($response['items']) {
                if (defined('WPSOCIALREVIEWS_PRO') && $feed_type !== 'hashtag') {
                    $headerCacheName = 'twitter_feed_header_' . $name;
	                $response['header'] = $this->cacheHandler->getFeedCache($headerCacheName);
					if (!$response['header']) {
						$twitterApi         = new TwitterApi($settings);
						$headerResponse     = $this->headerResponse($twitterApi, $name, $headerCacheName);
						$response['header'] = $headerResponse;
					}
                }
            } else {
                if ($this->isTwitterConnected) {
                    $get_field    = $this->setGetFieldsString($name, $count, $feed_type, $hashtag);
                    $api_base_url = $this->setBaseUrl($feed_type);
                    $response     = $this->sendApiRequest($settings, $get_field, $api_base_url, $feed_type, $name);
                } else {
                    return array(
                        'error_message' => __('Please set your twitter configuration correctly!!', 'wp-social-reviews')
                    );
                }
            }

            return $response;
        }
    }

    public function updateCachedFeeds($caches)
    {
        $settings = get_option('wpsr_twitter_verification_configs');

        if ($settings && isset($settings['dynamic'])) {
            $settings = $this->getCredentialsSettings($settings['dynamic']);
            foreach ($caches as $cache) {
                $optionName = $cache['option_name'];

                $name_position    = strpos($optionName, '_name_');
                $hashtag = '';
                $hash_position    = strpos($optionName, '_#');
                $cache_position   = 0;
                $num_position     = strpos($optionName, '_num');
                $screenName       = '';
                if ($name_position) {
                    $feedType   = substr($optionName, $cache_position, $name_position);
                    $screenName = substr($optionName, $name_position + 6, $num_position - $name_position - 6);
                } elseif ($hash_position) {
                    $feedType = substr($optionName, $cache_position, $hash_position);
					$hashtag = substr($optionName, $hash_position + 1, $num_position - ($hash_position + 1));
                } else {
                    $feedType = substr($optionName, $cache_position, $num_position);
                }
                $totalFeed = substr($optionName, $num_position + 4);
                $totalFeed = intval($totalFeed);

                $feedSettings['feed_type']   = $feedType;
                $feedSettings['feed_count']  = $totalFeed;
                $feedSettings['screen_name'] = $screenName;

                $get_field            = $this->setGetFieldsString($screenName, $totalFeed, $feedType, $hashtag);
                $api_base_url         = $this->setBaseUrl($feedType);
                $this->transient_name = $this->setTransientName($feedType, $totalFeed, $screenName, $hashtag);

                $this->sendApiRequest($settings, $get_field, $api_base_url, $feedType, $screenName);
            }
        }
    }

    public function clearCache()
    {
        $this->cacheHandler->clearCache();
        wp_send_json_success([
            'message' => __('Cache cleared successfully!', 'wp-social-reviews'),
        ], 200);
    }
}
