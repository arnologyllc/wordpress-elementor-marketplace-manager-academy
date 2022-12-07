<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Services\Platforms\Feeds\BaseFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\App\Services\Platforms\Feeds\Common\FeedFilters;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;
use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\Config as InstagramConfig;
use WPSocialReviews\App\Models\Cache;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class InstagramFeed extends BaseFeed
{
    public $platform = 'instagram';
    protected $cacheHandler;
    private $cronScheduleName = 'wpsr_instagram_feed_update';

    public function __construct()
    {
        parent::__construct($this->platform);
        $this->cacheHandler = new CacheHandler('instagram');

        add_action('wpsr_instagram_access_token_refresh_weekly', array($this, 'doTokenRefreshes'));
    }

    public function pushValidPlatform($platforms)
    {
        $isActive = get_option('wpsr_'.$this->platform.'_verification_configs');
        if($isActive) {
            $platforms['instagram'] = __('Instagram', 'wp-social-reviews');
        }
        return $platforms;
    }

    /**
     * Manual access token handler
     *
     * @return json
     * @since 1.3.0
     */
    public function handleCredential($args = [])
    {
        try {
            $args['is_private'] = false;
            $instagramUrl = '';
            $accountArgs  = [];

            if( $args['credentials_type'] === 'manually' && strpos($args['access_token'], 'EAAGTJHJgNIMB') !== false){
                if(!Arr::get($args, 'user_id')){
                    $error_message = __('Please provide a user id.', 'wp-social-reviews');
                    throw new \Exception($error_message);
                }
                $instagramUrl = $this->getHeaderApiUrl($args, 'header');
            }

            if ($args['api_type'] === 'personal') {
                $instagramUrl = $this->getHeaderApiUrl($args, 'verification_header');
            } elseif ($args['api_type'] === 'business' && $args['credentials_type'] !== 'manually' && sizeof($args['selectedAccounts']) === 0) {
                $instagramUrl = 'https://graph.facebook.com/me/accounts?fields=instagram_business_account,access_token&limit=500&access_token=' . $args['access_token'];
            }

            $response = null;
            if($args['api_type'] === 'personal' || $args['credentials_type'] === 'manually' || sizeof($args['selectedAccounts']) === 0){
                $response = (new Common())->makeRequest($instagramUrl);
            }

            if (!is_wp_error($response) && !(new Common())->instagramError($response) && sizeof($args['selectedAccounts']) === 0 && $args['api_type'] === 'business' && $args['credentials_type'] !== 'manually'){
                $this->setAuthorizedBusinessAccount($response);
            }

            if ($args['api_type'] === 'personal' && !is_wp_error($response) && !(new Common())->instagramError($response) && isset($response['username']) && isset($response['id'])) {
                $accountArgs = $this->setPersonalAccount($response, $args);
            }

            if ((( sizeof($args['selectedAccounts']) > 0 || $args['credentials_type'] === 'manually') && $args['api_type'] === 'business' ) ) {
                $accountArgs = $this->setBusinessAccount($args, $response);
            }

            if (!is_wp_error($response) && !(new Common())->instagramError($response) && $accountArgs) {
                $this->updateVerificationConfigs($accountArgs);
                $settings = get_option('wpsr_instagram_verification_configs', []);
                $this->setGlobalSettings();
                wp_send_json_success([
                    'settings' => $settings,
                    'message'  => __('You\'ve successfully connected your account!', 'wp-social-reviews')
                ]);
            }

            if (is_wp_error($response)) {
                throw new \Exception($response->get_error_message());
            }

            $message = $this->getErrorMessage($response);
            throw new \Exception($message);
        } catch (\Exception $exception) {
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    /**
     * Set instagram api url
     *
     * @return string
     * @since 1.3.0
     */
    public function getHeaderApiUrl($args, $endpoint)
    {
        if (!empty($args) && isset($args['api_type']) && $args['access_token']) {
            $api_type     = $args['api_type'];
            $access_token = $args['access_token'];
            $apiUrl       = '';

            if ($api_type === 'personal') {
                if ($endpoint === 'verification_header') {
                    //header
                    $apiUrl = 'https://graph.instagram.com/me?fields=id,username,media_count&access_token=' . $access_token;
                } elseif ($endpoint === 'header') {
                    //header
                    $access_token = (new RefreshToken())->getAccessToken($args);
                    $apiUrl       = 'https://graph.instagram.com/me?fields=id,username,media_count&access_token=' . $access_token;
                }
            } elseif ($api_type === 'business') {
                if ($endpoint === 'verification') {
                    //verification
                    $apiUrl = "https://graph.facebook.com/v8.0/me/accounts?fields=name,id&access_token=" . $access_token;
                } elseif ($endpoint === 'header') {
                    //header
                    $apiUrl = 'https://graph.facebook.com/' . $args['user_id'] . '?fields=biography,id,username,website,followers_count,media_count,profile_picture_url,name&access_token=' . $access_token;
                }
            }
            return $apiUrl;
        }
    }

    public function setAuthorizedBusinessAccount($response = [])
    {
        $business_accounts = [];
        $is_business_account = false;
        foreach ($response['data'] as $index => $responseData) {
            $business_id = Arr::get($responseData, 'instagram_business_account.id');
            if( $business_id ){
                $is_business_account = true;
                $apiUrl = 'https://graph.facebook.com/' . $business_id . '?fields=name,id,username,profile_picture_url&access_token=' . $responseData['access_token'];
                $response = (new Common())->makeRequest($apiUrl);
                if (is_wp_error($response)) {
                    throw new \Exception($response->get_error_message());
                }
                $response['access_token'] = $responseData['access_token'];
                $business_accounts[] = $response;
            }
        }

        if(!$is_business_account){
            $error_message = __('Please configure your business account correctly!', 'wp-social-reviews');
            throw new \Exception($error_message);
        }

        if(isset($response['data']) && empty($response['data'])){
            $error_message = __('Please check, you allow all access in wp social ninja facebook app correctly.', 'wp-social-reviews');
            throw new \Exception($error_message);
        }

        update_option('wpsr_instagram_authorized_business_accounts_list', $business_accounts);
        wp_send_json_success([
            'message'  => __('You are successfully verified.', 'wp-social-reviews')
        ], 200);
    }

    public function setPersonalAccount($response = [], $args = [])
    {
        $args['username']    = $response['username'];
        $args['user_id']     = $response['id'];
        $args['user_avatar'] = '';
        $response            = (new RefreshToken())->refreshToken($args);

        if (isset($response['error']['code']) && $response['error']['code'] === 10) {
            $args['is_private'] = true;
        }
        $args[$args['user_id']] = $args;
        return $args;
    }

    public function setBusinessAccount($args = [], $response = [])
    {
        $args['isConnected'] = false;
       
        // set ig authorize business profile info
        if(empty($response)){
            foreach ($args['selectedAccounts'] as $account){
                $args['user_id'] = Arr::get($account, 'id');
                $args['access_token'] = Arr::get($account, 'access_token');
                $instagramUrl        = $this->getHeaderApiUrl($args, 'header');
                $response            = (new Common())->makeRequest($instagramUrl);
                $args['username']    = $response['username'];
                $args['user_avatar'] = $response['profile_picture_url'];
                $args['isConnected'] = true;
                $args[$args['user_id']] = $args;
            }
        }

        // set manually ig business profile info
        if (!is_wp_error($response) && !(new Common())->instagramError($response)) {
            $args['username']    = $response['username'];
            $args['user_avatar'] = $response['profile_picture_url'];
            $args['isConnected'] = true;
            $args[$args['user_id']] = $args;
        }
        return $args;
    }

    /**
     * Instagram Api Error Message
     *
     * @param array $response
     *
     * @return string
     * @since 1.3.0
     */
    public function getErrorMessage($response)
    {
        $message = __('Error connecting to instagram', 'wp-social-reviews');
        if(is_wp_error($response)) {
            $message = $response->get_error_message();
        } else if (Arr::get($response, 'error.message')) {
            $message = sprintf(__(' API error: %s', 'wp-social-reviews'), $response['error']['message']);
        } else {
            if (isset($response['response']) && isset($response['response']->errors)) {
                foreach ($response['response']->errors as $key => $item) {
                    $message .= ' ' . $key . ' - ' . $item[0];
                }
            }
        }

        return $message;
    }

    /**
     * Get All Verified Accounts
     * @return json
     * @since 1.3.0
     */
    public function getVerificationConfigs()
    {
        $connected_accounts = (new Common())->findConnectedAccounts();
        foreach($connected_accounts as $key => $account) {
            if ($account['api_type'] === 'business') {
                $transientName = 'user_account_header_'.$account['user_id'];
                $transient = $this->cacheHandler->getFeedCache($transientName);
                if ($transient) {
                    $connected_accounts[$key]['user_avatar'] = $transient['user_avatar'];
                }
            }
        }
        $business_accounts_list = get_option('wpsr_instagram_authorized_business_accounts_list');

        wp_send_json_success([
            'message'            => __('Instagram Successfully Connected!', 'wp-social-reviews'),
            'status'             => true,
            'connected_accounts' => $connected_accounts,
            'business_accounts'  => $business_accounts_list
        ], 200);
    }

    /**
     * Update Verification Configs
     *
     * @param array $args
     *
     * @return array
     * @since 1.3.0
     */
    public function updateVerificationConfigs($accountArgs)
    {
        $configs            = get_option('wpsr_instagram_verification_configs', []);
        $connected_accounts = Arr::get($configs, 'connected_accounts', []);
        foreach ($accountArgs as $args){
            if (Arr::get($args, 'user_id') && Arr::get($args, 'username')) {
                $userId                      = (string)$args['user_id'];
                $connected_accounts[$userId] = array(
                    'access_token' => Arr::get($args, 'access_token', ''),
                    'expires_in'   => Arr::get($args, 'expires_in', ''),
                    'created_at'   => time(),
                    'user_id'      => $userId,
                    'username'     => Arr::get($args, 'username', ''),
                    'api_type'     => Arr::get($args, 'api_type', ''),
                    'user_avatar'  => Arr::get($args, 'user_avatar', ''),
                    'is_private'   => Arr::get($args, 'is_private', false)
                );
            }
        }

        update_option('wpsr_instagram_verification_configs', array('connected_accounts' => $connected_accounts));

        foreach ($connected_accounts as $connected_account) {
            if ($connected_account['api_type'] == 'personal') {
                (new CacheHandler('instagram'))->createOrUpdateCache(
                    'wpsr_instagram_verification_configs_' . $connected_account['user_id'],
                    $connected_account['user_id'],
                    7 * 24 * 60 * 60
                );
            }
        }
    }

    /**
     * Disconnect Verification Configs
     * @return json
     * @since 1.3.0
     */
    public function clearVerificationConfigs($userId)
    {
        $accounts = (new Common())->findConnectedAccounts();
        unset($accounts[$userId]);
        update_option('wpsr_instagram_verification_configs', array('connected_accounts' => $accounts));

        $cache_array1 = [];
        if (!count($accounts)) {
            delete_option('wpsr_instagram_verification_configs');
            delete_option('wpsr_instagram_global_settings');
            $cache_array1 = [
                'hashtag_',
            ];
        }

        $cache_array2 = [
            'user_account_header_' . $userId,
            'user_account_feed_id_' . $userId,
            'hashtag_feed_id_' . $userId,
            'wpsr_instagram_verification_configs_'.$userId
        ];
        $cache_names = array_merge($cache_array1, $cache_array2);
        foreach ($cache_names as $cache_name) {
            $this->cacheHandler->clearCacheByName($cache_name);
        }

        wp_send_json_success([
            'message' => __('Your Instagram Account Successfully Disconnected!', 'wp-social-reviews'),
        ], 200);
    }

    public function getTemplateMeta($settings = [])
    {
        $formatted_feed_template_meta = $settings;
        //feed settings to simplify repetitive use
        $feed_settings = Arr::get($formatted_feed_template_meta, 'feed_settings', []);
        $response      = $this->templateApiHandler($feed_settings);

        //filter the feeds
        $filterSettings = Arr::get($feed_settings, 'filters', []);
        if (Arr::get($response, 'error_message')) {
            $filterResponse = $response;
        } else {
            $filterResponse = (new FeedFilters())->filterFeedResponse($this->platform, $filterSettings, $response);
        }

        $formatted_feed_template_meta['dynamic'] = $filterResponse;
        $configs                                 = $formatted_feed_template_meta;

        //get all connected ids
        $connected_ids            = (new Common())->findConnectedAccounts();
        $configs['connected_ids'] = $connected_ids;

        return $configs;
    }

    /**
     * Get Feed Settings
     *
     * @return json
     * @since 1.3.0
     */
    public function getEditorSettings($postId = null)
    {
        $instagramConfig = new InstagramConfig();

        $feed_template_meta   = get_post_meta($postId, '_wpsr_template_config', true);
        $feed_template_style_meta = get_post_meta($postId, '_wpsr_template_styles_config', true);
        $decodedMeta          = json_decode($feed_template_meta, true);
        $feed_settings        = Arr::get($decodedMeta, 'feed_settings', []);
        $format_feed_settings = Config::formatInstagramConfig($feed_settings, array());
        $settings             = $this->getTemplateMeta($format_feed_settings);
        $settings['styles_config'] = $instagramConfig->formatStylesConfig(json_decode($feed_template_style_meta, true), $postId);
        $templateDetails      = get_post($postId);
        $translations         = GlobalSettings::getTranslations();
        wp_send_json_success([
            'message'          => __('Success', 'wp-social-reviews'),
            'settings'         => $settings,
            'template_details' => $templateDetails,
            'elements'         => $instagramConfig->getStyleElement(),
            'translations'     => $translations
        ]);
    }

    /**
     * Show updated data if new data fetched in editor without update in db
     *
     * @return json
     * @throws /Exception
     * @since 1.3.0
     */
    public function editEditorSettings($settings = array(), $postId = null)
    {
        $styles_config = Arr::get($settings, 'styles_config');

        $settings['feed_settings']['source_settings']['hash_tags'] = $this->formatHashTags($settings);
        $format_feed_settings = Config::formatInstagramConfig($settings['feed_settings'], array());
        $settings             = $this->getTemplateMeta($format_feed_settings);

        $settings['styles_config'] = $styles_config;
        wp_send_json_success([
            'message'  => __('Instagram Settings Updated successfully', 'wp-social-reviews'),
            'settings' => $settings,
        ]);
    }

    /**
     * Update template is settings is changed in editor
     *
     * @return json
     * @since 1.3.0
     */
    public function updateEditorSettings($settings = array(), $postId = null)
    {
        $settings['feed_settings']['source_settings']['hash_tags'] = $this->formatHashTags($settings);

        if(defined('WPSOCIALREVIEWS_PRO_VERSION')){
            (new \WPSocialReviewsPro\Classes\TemplateCssHandler())->saveCss($settings, $postId);
        }
        $format_feed_settings = Config::formatInstagramConfig($settings['feed_settings'], array());

        // unset them for wpsr_template_config meta
        $unsetKeys = ['dynamic', 'styles_config', 'styles', 'responsive_styles'];
        foreach ($unsetKeys as $key){
            if(Arr::get($format_feed_settings, $key, false)){
                unset($format_feed_settings[$key]);
            }
        }

        $encodedMeta        = json_encode($format_feed_settings, JSON_UNESCAPED_UNICODE);
        update_post_meta($postId, '_wpsr_template_config', $encodedMeta);

        $this->cacheHandler->clearPageCaches($this->platform);
        wp_send_json_success([
            'message' => __('Template Saved Successfully!!', 'wp-social-reviews'),
        ]);
    }

    public function formatHashTags($settings)
    {
        $hash_tags = Arr::get($settings, 'feed_settings.source_settings.hash_tags', '');

        if(empty($hash_tags)) {
            return '';
        }

        //remove all whitespace (including tabs and line ends)
        $hash_tags = preg_replace('/\s+/', '', $hash_tags);
        $hash_tags = explode(',', $hash_tags);
        $hash_tag_text = '';

        if( !empty($hash_tags) ) {
            foreach ($hash_tags as $hash_tag) {
                if($hash_tag[0] !== '#') {
                    $hash_tag = '#'.$hash_tag;
                }
                $hash_tag_text .= $hash_tag.',';
            }
        }

        $hash_tags = rtrim($hash_tag_text, ',');
        return $hash_tags;
    }

    /**
     * Template Api Handler
     *
     * @param $feed_settings
     *
     * @return array
     * @since 1.3.0
     */
    public function templateApiHandler($feed_settings)
    {
        $apiSettings   = Arr::get($feed_settings, 'source_settings', []);
        $accountIds    = Arr::get($apiSettings, 'account_ids', []);
        $headerDetails = $this->getHeaderDetails($accountIds, $feed_settings);

        if (!empty($accountIds) && is_array($accountIds)) {
            $feedType = $apiSettings['feed_type'];
            $response = array();
            if ($feedType === 'user_account_feed') {
                $response = (new AccountFeed())->getMultipleAccountResponse($accountIds);
            }

            if ($feedType === 'tagged_feed') {
                if (defined('WPSOCIALREVIEWS_PRO')) {
                    $response = (new \WPSocialReviewsPro\Classes\Feeds\Instagram\TaggedFeed())->getMultipleTaggedResponse($accountIds);
                } else {
                    $message = __('You need to upgrade to pro version to show tagged feeds!!', 'wp-social-reviews');

                    return array('error_message' => $message);
                }
            }

            if ($feedType === 'hashtag_feed') {
                $hashtagType = isset($apiSettings['hashtag_type']) ? $apiSettings['hashtag_type'] : 'recent_media ';
                $hashtags    = isset($apiSettings['hash_tags']) ? $apiSettings['hash_tags'] : '';

                if ($hashtags && !empty($hashtags)) {
                    if (defined('WPSOCIALREVIEWS_PRO')) {
                        $response = (new \WPSocialReviewsPro\Classes\Feeds\Instagram\HashtagFeed())->getMultipleHashtagResponse($accountIds,
                            $hashtags, $hashtagType);
                    } else {
                        $message = __('You need to upgrade to pro version to show hashtag feeds!!',
                            'wp-social-reviews');

                        return array('error_message' => $message);
                    }
                } else {
                    $message = __('Please enter a hashtag to fetch your instagram hashtags feed!!',
                        'wp-social-reviews');

                    return array('error_message' => $message);
                }
            }

            $keys = array_keys($response);
            $first_key = null;

            if(!empty($keys)) {
                $first_key = $keys[0];
            }
            // make sure which account has given the error
            if (!empty($first_key) && (new Common())->instagramError($response[$first_key])) {
                $errorPrefix = __('Error in '. $first_key. ' account. ', 'wp-social-reviews');
                return array(
                    'error_message' => $errorPrefix . $this->getErrorMessage($response[$first_key])
                );
            } elseif (isset($response['error_message'])) {
                return array(
                    'error_message' => $response['error_message']
                );
            }
            else if (count($response) <= 0) {
                $message = __('We couldn\'t find any feed from your instagram account!!', 'wp-social-reviews');
                return array('error_message' => $message);
            } else {
                return array(
                    'header' => $headerDetails,
                    'items'  => $response,
                );
            }
        }

        return array();
    }

    public function getHeaderDetails($accountIds, $feed_settings)
    {
        $headerSettings      = Arr::get($feed_settings, 'header_settings', []);
        $connectedAccounts   = (new Common())->findConnectedAccounts();
        $connectedAccountsId = array_keys($connectedAccounts);
        $existsAccounts      = array_intersect($connectedAccountsId, $accountIds);

        if (empty($existsAccounts)) {
            return array('error_message' => 'Please configure source settings correctly from the template editor panel');
        }

        $accountToShow    = isset($headerSettings['account_to_show']) ? $headerSettings['account_to_show'] : '';
        $accountCacheName = 'user_account_header_' . $accountToShow;

        $accountDetails  = isset($connectedAccounts[$accountToShow]) ? $connectedAccounts[$accountToShow] : array();
        $instagramApiUrl = $this->getHeaderApiUrl($accountDetails, 'header');

        $headerDetails = $this->cacheHandler->getFeedCache($accountCacheName);

        if (!$headerDetails) {
            $headerDetails = (new Common())->makeRequest($instagramApiUrl);

            if (!(new Common())->instagramError($headerDetails)) {
                $headerDetails = $this->formatHeaderDetails($headerDetails);
                $this->cacheHandler->createCache($accountCacheName, $headerDetails);
            } else {
                $headerDetails = false;
            }
        }

        return $headerDetails;
    }

    /**
     * formats header
     *
     * @param $args
     *
     * @return array
     * @since 1.3.0
     */
    public function formatHeaderDetails($args = [])
    {
        return array(
            'username'        => Arr::get($args, 'username', ''),
            'biography'       => Arr::get($args, 'biography', ''),
            'user_avatar'     => Arr::get($args, 'profile_picture_url', ''),
            'followers_count' => Arr::get($args, 'followers_count', ''),
            'media_count'     => Arr::get($args, 'media_count', ''),
            'name'            => Arr::get($args, 'name', '')
        );
    }

    public function updateCachedFeeds($caches)
    {
        $this->cacheHandler->clearPageCaches($this->platform);

        $connectedAccounts = (new Common())->findConnectedAccounts();
        foreach ($caches as $index => $cache) {
            $optionName = $cache['option_name'];
            $feed_type  = '';

            $separator        = '_feed';
            $feed_position    = strpos($optionName, $separator) + strlen($separator);
            $initial_position = 0;
            if ($feed_position) {
                $feed_type = substr($optionName, $initial_position, $feed_position - $initial_position);
            }
            $feedTypes = ['user_account_feed', 'hashtag_feed'];

            if (in_array($feed_type, $feedTypes)) {
                if ($feed_type === 'user_account_feed') {
                    $separator     = '_id_';
                    $feed_position = strpos($optionName, $separator) + strlen($separator);
                    $accountId     = substr($optionName, $feed_position, strlen($optionName) - $feed_position);

                    if (!empty($accountId)) {
                        //for user account feed type we need to find header details of the ig user
                        $accountDetails  = isset($connectedAccounts[$accountId]) ? $connectedAccounts[$accountId] : array();
                        if(empty($accountDetails)) {
                            continue;
                        }
                        $instagramApiUrl = $this->getHeaderApiUrl($accountDetails, 'header');

                        $headerDetails   = (new Common())->makeRequest($instagramApiUrl);
                        $headerCacheName = 'user_account_header_' . $accountId;
                        if (!(new Common())->instagramError($headerDetails)) {
                            $headerDetails = $this->formatHeaderDetails($headerDetails);
                            $this->cacheHandler->createCache($headerCacheName, $headerDetails);
                        } else {
                            $this->cacheHandler->clearCache();
                        }

                        $feedCacheName         = 'user_account_feed_id_' . $accountId;
                        $instagramApiUrl       = (new AccountFeed())->getApiUrl($accountDetails);
                        $resultWithoutComments = (new Common())->expandWithoutComments($instagramApiUrl);
                        if (!(new Common())->instagramError($resultWithoutComments)) {
                            $resultWithComments = (new Common())->expandWithComments($accountDetails,
                                $resultWithoutComments);
                            $this->cacheHandler->createCache($feedCacheName, $resultWithComments);
                        } else {
                            $this->cacheHandler->clearCache();
                        }
                    }
                } else if ($feed_type === 'hashtag_feed' && defined('WPSOCIALREVIEWS_PRO')) {
                    $separator           = '_id_';
                    $id_position         = strpos($optionName, $separator) + strlen($separator);
                    $type_position       = strpos($optionName, '_type_');
                    $hashtag_id_position = strpos($optionName, '_hashtag_id_');

                    $accountId = substr($optionName, $id_position, $hashtag_id_position - $id_position);

                    //hashtag id
                    $hashtagId = substr($optionName, $hashtag_id_position + strlen('_hashtag_id_'),
                        $type_position - ($hashtag_id_position + strlen('_hashtag_id_')));

                    $hashtagType = substr($optionName, $type_position + strlen('_type_'),
                        strlen($optionName) - ($type_position + strlen('_type_')));

                    $hashtagCacheName = "hashtag_feed_id_${accountId}_hashtag_id_${hashtagId}_type_${hashtagType}";

                    $accountDetails = isset($connectedAccounts[$accountId]) ? $connectedAccounts[$accountId] : '';
                    if(empty($accountDetails)) {
                        continue;
                    }
                    $api_url  = (new \WPSocialReviewsPro\Classes\Feeds\Instagram\HashtagFeed())->getFeedApiUrl($hashtagId, $hashtagType, $accountDetails);
                    $feedResponse = (new Common())->makeRequest($api_url);
                    if (!(new Common())->instagramError($feedResponse)) {
                        $feedResponse = (isset($feedResponse['data']) ? $feedResponse['data'] : array());
                        if (!empty($feedResponse)) {
                            $this->cacheHandler->createCache($hashtagCacheName, $feedResponse);
                        }
                    } else {
                        $this->cacheHandler->clearCache();
                    }
                }
            }
        }
    }

    public function doTokenRefreshes()
    {
        $caches = $this->cacheHandler->getExpiredCacheByName('wpsr_instagram_verification_configs_');

        $options            = get_option('wpsr_instagram_verification_configs', array());
        $connected_accounts = isset($options['connected_accounts']) ? $options['connected_accounts'] : array();
        if (is_array($connected_accounts) && !empty($connected_accounts)) {
            foreach ($connected_accounts as $connected_account) {
                if (in_array($connected_account['user_id'], $caches)) {
                    $is_personal = (isset($connected_account['api_type']) && $connected_account['api_type'] === 'personal');
                    $is_private  = (isset($connected_account['is_private'])) ? $connected_account['is_private'] : false;

                    if ($is_personal && isset($connected_account['expires_in']) && !empty($connected_account['expires_in']) && !$is_private) {
                        if ((new RefreshToken())->should_attempt_refresh($connected_account)) {
                            (new RefreshToken())->getAccessToken($connected_account);
                        }
                    }
                }
            }
        }
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
                    'caching_type'     => 'background'
                )
            );
            update_option($option_name, $args);
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
