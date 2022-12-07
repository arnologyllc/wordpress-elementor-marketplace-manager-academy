<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Facebook;

use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Services\Platforms\Feeds\BaseFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;
use WPSocialReviews\App\Services\Platforms\Feeds\Facebook\Config as FacebookConfig;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Common\FeedFilters;

if (!defined('ABSPATH')) {
    exit;
}

class FacebookFeed extends BaseFeed
{
    private $remoteFetchUrl = 'https://graph.facebook.com/';
    protected $cacheHandler;

    public function __construct()
    {
        parent::__construct('facebook_feed');
        $this->cacheHandler = new CacheHandler('facebook_feed');
    }

    public function pushValidPlatform($platforms)
    {
        $isActive = get_option('wpsr_'.$this->platform.'_verification_configs');
        if($isActive) {
            $platforms['facebook_feed'] = __('Facebook Feed', 'wp-social-reviews');
        }
        return $platforms;
    }

    public function handleCredential($args = [])
    {
        try {
            $selectedAccounts = Arr::get($args, 'selectedAccounts');

            if(sizeof($selectedAccounts) === 0 && !empty($args['access_token'])){
                $this->saveVerificationConfigs($args['access_token']);
                $this->saveAuthorizedSourceList($args['access_token']);
            }

            if($selectedAccounts && sizeof($selectedAccounts) > 0){
                $this->saveSourceConfigs($args);
            }

            wp_send_json_success( [
                'message' => __('You are Successfully Verified.', 'wp-social-reviews'),
                'status'  => true
            ], 200 );

        } catch (\Exception $exception){
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    public function saveVerificationConfigs($accessToken)
    {
        $fetchUrl = $this->remoteFetchUrl.'me?fields=id,name,link,picture&access_token=' . $accessToken;
        $response = wp_remote_get($fetchUrl);

        if(is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        if(200 !== wp_remote_retrieve_response_code($response)) {
            $errorMessage = $this->getErrorMessage($response);
            throw new \Exception($errorMessage);
        }

        if(200 === wp_remote_retrieve_response_code($response)) {
            $responseArr = json_decode(wp_remote_retrieve_body($response), true);
            $name = Arr::get($responseArr, 'name');
            $avatar = Arr::get($responseArr, 'picture.data.url');
            if($name && $avatar) {
                $data = [
                    'name'          => $name,
                    'avatar'        => $avatar,
                    'access_token'  => $accessToken
                ];
                update_option('wpsr_' . $this->platform . '_verification_configs', $data);
                $this->setGlobalSettings();
            }
        }
    }

    public function getVerificationConfigs()
    {
        $verificationConfigs    = get_option('wpsr_' . $this->platform . '_verification_configs');
        $connected_source_list  = $this->getConncetedSourceList();
        $authorized_source_list = $this->getAuthorizedSourceList();

        wp_send_json_success([
            'authorized_source_list' => $authorized_source_list,
            'connected_source_list'  => $connected_source_list,
            'settings'               => $verificationConfigs,
            'status'                 => true,
        ], 200);
    }

    public function clearVerificationConfigs($userId)
    {
        $sources = $this->getConncetedSourceList();
        unset($sources[$userId]);
        update_option('wpsr_facebook_feed_connected_sources_config', array('sources' => $sources));

        if (!count($sources)) {
            delete_option('wpsr_facebook_feed_verification_configs');
            delete_option('wpsr_facebook_feed_connected_sources_config');
            delete_option('wpsr_facebook_feed_authorized_sources');
            delete_option('wpsr_facebook_feed_global_settings');
        }

        $cache_names = [
            'user_account_header_' . $userId,
            'timeline_feed_id_' . $userId,
            'photo_feed_id_' . $userId,
            'video_feed_id_' . $userId,
        ];

        foreach ($cache_names as $cache_name) {
            $this->cacheHandler->clearCacheByName($cache_name);
        }

        wp_send_json_success([
            'message' => __('Successfully Disconnected!', 'wp-social-reviews'),
        ], 200);
    }

    public function saveAuthorizedSourceList($access_token)
    {
        $api = $this->remoteFetchUrl.'me/accounts?limit=500&access_token='.$access_token;
        $response = wp_remote_get($api);

        if(is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        if(200 !== wp_remote_retrieve_response_code($response)) {
            $errorMessage = $this->getErrorMessage($response);
            throw new \Exception($errorMessage);
        }

        if(200 === wp_remote_retrieve_response_code($response)) {
            $result = json_decode(wp_remote_retrieve_body($response), true);
            $data = Arr::get($result, 'data', []);
            if ($data) {
                $connected_accounts = [];
                foreach ($data as $index => $page) {
                    if (Arr::get($page, 'id') && Arr::get($page, 'name')) {
                        $pageId = (string)$page['id'];
                        $connected_accounts[] = $this->formatPageData($page, $pageId);
                    }
                }
                update_option('wpsr_facebook_feed_authorized_sources', array('sources' => $connected_accounts));
            }
        }
    }

    public function getAuthorizedSourceList()
    {
        $sources = get_option('wpsr_facebook_feed_authorized_sources', []);
        $connected_sources = Arr::get($sources, 'sources') ? $sources['sources'] : [];
        return $connected_sources;
    }

    public function saveSourceConfigs($args = [])
    {
        if(Arr::get($args, 'selectedAccounts')) {
            $connected_accounts = $this->getConncetedSourceList();
            foreach ($args['selectedAccounts'] as $index => $page) {
                if (Arr::get($page, 'id') && Arr::get($page, 'name')) {
                    $pageId                      = (string)$page['id'];
                    $connected_accounts[$pageId] = $this->formatPageData($page, $pageId);
                }
            }
            update_option('wpsr_facebook_feed_connected_sources_config', array('sources' => $connected_accounts));
            wp_send_json_success([
                'message'            => __('Successfully Connected!', 'wp-social-reviews'),
                'status'          => true,
            ], 200);
        }
    }

    public function formatPageData($page, $pageId)
    {
        $data = [
            'access_token' => Arr::get($page, 'access_token', ''),
            'expires_in'   => Arr::get($page, 'expires_in', ''),
            'created_at'   => time(),
            'page_id'      => $pageId,
            'id'           => $pageId,
            'name'         => Arr::get($page, 'name', ''),
            'type'         => 'page',
            'is_private'   => Arr::get($page, 'is_private', false)
        ];
        return $data;
    }

    public function getConncetedSourceList()
    {
        $configs = get_option('wpsr_facebook_feed_connected_sources_config', []);
        $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];
        return $sourceList;
    }

    public function getTemplateMeta($settings = array(), $postId = null)
    {
        $feed_settings = Arr::get($settings, 'feed_settings', array());
        $apiSettings   = Arr::get($feed_settings, 'source_settings', array());

        $data = [];
        if(!empty(Arr::get($apiSettings, 'selected_accounts'))) {
            $response = $this->apiConnection($apiSettings);
            if(isset($response['error_message'])) {
                $settings['dynamic'] = $response;
            } else {
                $data['items'] = $response;
            }
        } else {
            $settings['dynamic']['error_message'] = __('Please select a page to get feeds', 'wp-social-reviews');
        }

        $account = Arr::get($feed_settings, 'header_settings.account_to_show');
        if(!empty($account)) {
            $accountDetails = $this->getAccountDetails($account);
            if(isset($accountDetails['error_message'])) {
                $settings['dynamic'] = $accountDetails;
            } else {
                $data['header'] = $accountDetails;
            }
        }

        $filterSettings = Arr::get($feed_settings, 'filters', []);
        if (Arr::get($settings, 'dynamic.error_message')) {
            $filterResponse = $settings['dynamic'];
        } else {
            $filterResponse = (new FeedFilters())->filterFeedResponse($this->platform, $filterSettings, $data);
        }
        $settings['dynamic'] = $filterResponse;
        return $settings;
    }

    public function getEditorSettings($postId = null)
    {
        $facebookConfig = new FacebookConfig();

        $feed_meta       = get_post_meta($postId, '_wpsr_template_config', true);
        $feed_template_style_meta = get_post_meta($postId, '_wpsr_template_styles_config', true);
        $decodedMeta     = json_decode($feed_meta, true);
        $feed_settings   = Arr::get($decodedMeta, 'feed_settings', array());
        $feed_settings   = Config::formatFacebookConfig($feed_settings, array());
        $settings        = $this->getTemplateMeta($feed_settings, $postId);
        $templateDetails = get_post($postId);
        $settings['feed_type'] = Arr::get($settings, 'feed_settings.source_settings.feed_type');
        $settings['styles_config'] = $facebookConfig->formatStylesConfig(json_decode($feed_template_style_meta, true), $postId);

        $translations = GlobalSettings::getTranslations();
        wp_send_json_success([
            'message'          => __('Success', 'wp-social-reviews'),
            'settings'         => $settings,
            'sources'          => $this->getConncetedSourceList(),
            'template_details' => $templateDetails,
            'elements'         => $facebookConfig->getStyleElement(),
            'translations'     => $translations
        ], 200);
    }

    public function updateEditorSettings($settings = array(), $postId = null)
    {
        if(defined('WPSOCIALREVIEWS_PRO_VERSION')){
            (new \WPSocialReviewsPro\Classes\TemplateCssHandler())->saveCss($settings, $postId);
        }

        // unset them for wpsr_template_config meta
        $unsetKeys = ['dynamic', 'feed_type', 'styles_config', 'styles', 'responsive_styles'];
        foreach ($unsetKeys as $key){
            if(Arr::get($settings, $key, false)){
                unset($settings[$key]);
            }
        }

        $encodedMeta = json_encode($settings, JSON_UNESCAPED_UNICODE);
        update_post_meta($postId, '_wpsr_template_config', $encodedMeta);

        $this->cacheHandler->clearPageCaches($this->platform);
        wp_send_json_success([
            'message' => __('Template Saved Successfully!!', 'wp-social-reviews'),
        ], 200);
    }

    public function editEditorSettings($settings = array(), $postId = null)
    {
        $styles_config = Arr::get($settings, 'styles_config');

        $format_feed_settings = Config::formatFacebookConfig($settings['feed_settings'], array());
        $settings             = $this->getTemplateMeta($format_feed_settings);
        $settings['feed_type'] = Arr::get($settings, 'feed_settings.source_settings.feed_type');

        $settings['styles_config'] = $styles_config;
        wp_send_json_success([
            'settings' => $settings,
        ]);
    }

    public function apiConnection($apiSettings)
    {
        return $this->getMultipleFeeds($apiSettings);
    }

    public function getMultipleFeeds($apiSettings)
    {
        $ids = Arr::get($apiSettings, 'selected_accounts');

        $connectedAccounts = $this->getConncetedSourceList();
        $multiple_feeds = [];
        foreach ($ids as $id) {
            if (isset($connectedAccounts[$id])) {
                $pageInfo = $connectedAccounts[$id];
                if ($pageInfo['type'] === 'page') {
                    $feed = $this->getPageFeed($pageInfo, $apiSettings);
                    if(isset($feed['error_message'])) {
                        return $feed;
                    }
                    $multiple_feeds[] = $feed;
                }
            }
        }

        $fb_feeds = [];
        foreach ($multiple_feeds as $index => $feeds) {
            $fb_feeds = array_merge($fb_feeds, $feeds);
        }

        return $fb_feeds;
    }

    public function getPageFeed($page, $apiSettings, $cache = false)
    {
        $accessToken    = $page['access_token'];
        $pageId         = $page['page_id'];
        $feedType       = Arr::get($apiSettings, 'feed_type');
        $totalFeed      = Arr::get($apiSettings, 'feed_count');
        $totalFeed      = !defined('WPSOCIALREVIEWS_PRO') && $totalFeed > 50 ? 50 : $totalFeed;
        $pageCacheName  = $feedType.'_id_'.$pageId.'_num_'.$totalFeed;

        $feeds = [];
        if(!$cache) {
            $feeds = $this->cacheHandler->getFeedCache($pageCacheName);
        }
        $fetchUrl = '';

        if(!$feeds) {
            if($feedType === 'timeline_feed') {
                $fields = 'id,created_time,updated_time,message,attachments,from{name,id,picture{url},link},picture,full_picture,permalink_url,shares,status_type,story';
                $fields = apply_filters('wpsocialreviews/facebook_timeline_feed_api_fields', $fields);
                $fetchUrl = $this->remoteFetchUrl . $pageId . '/posts?fields='.$fields.'&limit='.$totalFeed.'&access_token=' . $accessToken;
            } else if($feedType === 'video_feed') {
                $fetchUrl = apply_filters('wpsocialreviews/facebook_video_feed_api_details', $this->remoteFetchUrl, $pageId, $totalFeed, $accessToken);
            } else if($feedType === 'photo_feed') {
                $fetchUrl = apply_filters('wpsocialreviews/facebook_photo_feed_api_details', $this->remoteFetchUrl, $pageId, $totalFeed, $accessToken);
            }

            $args     = array(
                'timeout'   => 60
            );
            $pages_data = wp_remote_get($fetchUrl, $args);

            if(is_wp_error($pages_data)) {
                $errorMessage = ['error_message' => $pages_data->get_error_message()];
                return $errorMessage;
            }

            if(Arr::get($pages_data, 'response.code') !== 200) {
                $errorMessage = $this->getErrorMessage($pages_data);
                return ['error_message' => $errorMessage];
            }

            if(Arr::get($pages_data, 'response.code') === 200) {
                $page_feeds = json_decode(wp_remote_retrieve_body($pages_data), true);
                if(isset($page_feeds['data']) && !empty($page_feeds['data'])) {
                    $this->cacheHandler->createCache($pageCacheName, $page_feeds['data']);
                }
                $feeds = $page_feeds['data'];
            }
        }

        if(!$feeds || empty($feeds)) {
            return [];
        }

        return $feeds;
    }

    public function getAccountDetails($account)
    {
        $connectedAccounts = $this->getConncetedSourceList();
        $pageDetails = [];
        if (isset($connectedAccounts[$account])) {
            $pageInfo = $connectedAccounts[$account];
            if ($pageInfo['type'] === 'page') {
               $pageDetails  = $this->getPageDetails($pageInfo, false);
            }
        }
        return $pageDetails;
    }

    public function getPageDetails($page, $cacheFetch = false)
    {
        $pageId = $page['page_id'];
        $accessToken = $page['access_token'];

        $accountCacheName = 'user_account_header_'.$pageId;

        $accountData = [];

        if(!$cacheFetch) {
            $accountData = $this->cacheHandler->getFeedCache($accountCacheName);
        }

        if(empty($accountData) || $cacheFetch) {
            $fetchUrl = $this->remoteFetchUrl . $pageId . '?fields=id,name,picture.height(150).width(150),fan_count,description,about,link,cover&access_token=' . $accessToken;
            $accountData = wp_remote_get($fetchUrl);

            if(is_wp_error($accountData)) {
                return ['error_message' => $accountData->get_error_message()];
            }

            if(Arr::get($accountData, 'response.code') !== 200) {
                $errorMessage = $this->getErrorMessage($accountData);
                return ['error_message' => $errorMessage];
            }

            if(Arr::get($accountData, 'response.code') === 200) {
                $accountData = json_decode(wp_remote_retrieve_body($accountData), true);

                $this->cacheHandler->createCache($accountCacheName, $accountData);
            }
        }

        return $accountData;
    }

    public function getErrorMessage($response = [])
    {
        $message = Arr::get($response, 'response.message');
        if (Arr::get($response, 'response.error')) {
            $error = Arr::get($response, 'response.error.message');
        } else if ($message) {
            $error = $message;
        } else {
            $error = __('Something went wrong', 'wp-social-reviews');
        }
        return $error;
    }

    public function setGlobalSettings()
    {
        $option_name    = 'wpsr_' . $this->platform . '_global_settings';
        $existsSettings = get_option($option_name);
        if (!$existsSettings) {
            // add global instagram settings when user verified
            $args = array(
                'global_settings' => array(
                    'expiration'    => 60*60*6,
                    'caching_type'  => 'background'
                )
            );
            update_option($option_name, $args);
        }
    }

    public function updateCachedFeeds($caches)
    {
        $this->cacheHandler->clearPageCaches($this->platform);
        foreach ($caches as $index => $cache) {
            $optionName = $cache['option_name'];
            $num_position = strpos($optionName, '_num_');
            $total    = substr($optionName, $num_position + strlen('_num_'), strlen($optionName));

            $feed_type  = '';
            $separator        = '_feed';
            $feed_position    = strpos($optionName, $separator) + strlen($separator);
            $initial_position = 0;
            if ($feed_position) {
                $feed_type = substr($optionName, $initial_position, $feed_position - $initial_position);
            }

            $id_position = strpos($optionName, '_id_');
            $sourceId    = substr($optionName, $id_position + strlen('_id_'),
                $num_position - ($id_position + strlen('_id_')));

            $feedTypes = ['timeline_feed', 'video_feed', 'photo_feed'];
            $connectedSources = $this->getConncetedSourceList();
            if(in_array($feed_type, $feedTypes)) {
                  if(isset($connectedSources[$sourceId])) {
                      $page = $connectedSources[$sourceId];
                      $apiSettings['feed_type'] = $feed_type;
                      $apiSettings['feed_count'] = $total;
                      $this->getPageFeed($page, $apiSettings, true);
                  }
            }

            $accountIdPosition = strpos($optionName, '_account_header_');
            $accountId = substr($optionName, $accountIdPosition + strlen('_account_header_'), strlen($optionName));
            if(!empty($accountId)) {
              if(isset($connectedSources[$accountId])) {
                  $page = $connectedSources[$accountId];
                  $this->getPageDetails($page, true);
              }
            }
        }
    }

    public function clearCache()
    {
        $this->cacheHandler->clearPageCaches($this->platform);
        $this->cacheHandler->clearCache();
        wp_send_json_success([
            'message' => __('Cache cleared successfully!', 'wp-social-reviews'),
        ], 200);
    }
}