<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Reviews\AirbnbHelper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle Airbnb Reviews
 * @since 1.0.0
 */
class Airbnb extends BaseReview
{
    private $remoteBaseUrl = 'https://www.airbnb.com/api/v2/';
    private $curUrl = 'https://www.airbnb.com';
    private $placeId = null;
    private $businessName;
    private $businessType;

    public function __construct()
    {
        parent::__construct(
            'airbnb',
            'wpsr_reviews_airbnb_settings',
            'wpsr_airbnb_reviews_update'
        );
    }

    public function searchBusiness($settings)
    {
        $this->businessName = $settings['business_name'];
        $this->businessType = $settings['business_type'];
        $downloadUrl = $this->businessName;
        $downloadUrl = strtok($downloadUrl, '?');
        $viaUrl      = filter_var($downloadUrl, FILTER_VALIDATE_URL);

        if($viaUrl) {
            $this->businessType = '';
            $this->businessName = '';
        } else {
            $downloadUrl = '';
        }

        if(!$viaUrl && !empty($this->businessType) && !empty($this->businessName)) {
            if (empty($this->businessType)) {
                throw new \Exception(__('Please select business type field!', 'wp-social-reviews'));
            }

            if (empty($this->businessName)) {
                throw new \Exception(__('Business name field should not be empty!', 'wp-social-reviews'));
            }

            if (filter_var($this->businessName, FILTER_VALIDATE_URL)) {
                throw new \Exception(__('Please enter a valid business name!', 'wp-social-reviews'));
            }

            $businessInfo = [];
            if ($this->businessType === 'rooms') {
                $businessInfo = (new AirbnbHelper())->getRoomsBusinessDetails($this->businessName);
            } else {
                $businessInfo = (new AirbnbHelper())->getExperienceBusinessDetails($this->businessName);
            }

            //collected data
            if (Arr::get($businessInfo, 'data.status') || Arr::get($businessInfo, 'message')) {
                throw new \Exception(
                    __(Arr::get($businessInfo, 'message'), 'wp-social-reviews')
                );
            }

            if (!empty($businessInfo)) {
                $downloadUrl = $businessInfo['business_url'];
            }

            if (empty($downloadUrl)) {
                throw new \Exception(
                    __('We don\'t find this business in the search results! Please try with business url!!', 'wp-social-reviews')
                );
            }

            if (strcmp($this->businessName, $businessInfo['business_name'])) {
                throw new \Exception(
                    __('We don\'t find this business in the search results! Please try with business url!!', 'wp-social-reviews')
                );
            }
        }

        if ($viaUrl && empty($downloadUrl)) {
            if (empty($this->businessType)) {
                throw new \Exception(__('This field should not be empty!!', 'wp-social-reviews'));
            }
        }

        if ($viaUrl && !filter_var($downloadUrl, FILTER_VALIDATE_URL)) {
            throw new \Exception(__('Please enter a valid ur!', 'wp-social-reviews'));
        }

        $data = $this->verifyCredential($downloadUrl);

        if ($viaUrl) {
            $businessInfo = $data;
        }

        $businessInfo = $this->saveBusinessInfo($businessInfo);

        if($data['total_fetched_reviews'] > 0) {
            update_option('wpsr_reviews_airbnb_business_info', $businessInfo, 'no');
        }

        $businessInfo['total_fetched_reviews'] = $data['total_fetched_reviews'];

        return $businessInfo;
    }

    public function handleCredentialSave($settings = array())
    {
        try {
            $businessInfo = $this->searchBusiness($settings);

            $message = Helper::getNotificationMessage($businessInfo, $this->placeId);
            if (Arr::get($businessInfo, 'total_fetched_reviews') && Arr::get($businessInfo, 'total_fetched_reviews') > 0) {
                // save caches when auto sync is on
                $apiSettings = get_option('wpsr_airbnb_global_settings');
                if(Arr::get($apiSettings, 'global_settings.auto_syncing') === 'true'){
                    $this->saveCache();
                }
            }

            wp_send_json_success([
                'message'       => $message,
                'business_info' => $businessInfo,
            ], 200);
        } catch (\Exception $exception) {
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    public function pushValidPlatform($platforms)
    {
        $settings    = $this->getApiSettings();
        if (!isset($settings['data']) && sizeof($settings) > 0) {
            $platforms['airbnb'] = __('Airbnb', 'wp-social-reviews');
        }
        return $platforms;
    }

    /**
     * @throws \Exception
     */
    public function verifyCredential($downloadUrl)
    {
        $this->curUrl = strtok($downloadUrl, '?');
        //start: find api key and place id
        $businessUrl = $this->curUrl;
        $this->placeId  = (int)filter_var($downloadUrl, FILTER_SANITIZE_NUMBER_INT);
        $response             = wp_remote_get($businessUrl);
        $html_content = '';
        if (is_array($response)) {
            $html_content = $response['body'];
        } else {
            throw new \Exception(__("Error finding key. Please try again.", 'wp-social-reviews'));
        }

        ini_set('memory_limit', '600M');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(1);
        $dom->loadHTML($html_content);
        $xpath  = new \DOMXpath($dom);
        $items  = $xpath->query('//meta/@content');
        $key    = '';
        $locale = '';

        $find_api_config = '"api_config":{';
        if ($items->length < 1) {
            throw new \Exception(__('Error 1: No key found.', 'wp-social-reviews'));
        } else {
            foreach ($items as $item) {
                if (strpos($item->nodeValue, $find_api_config)) {
                    $data   = json_decode($item->nodeValue, true);
                    $key    = $data['api_config']['key'];
                    $locale = $data['locale'];
                    break;
                }
            }
        }

        if ($key === "") {
            $find_api_config   = '","api_config":';
            $position          = strpos($html_content, $find_api_config);
            $api_locale_string = substr($html_content, $position - 20, 200);
            $find_api_config   = 'api","key":"';
            $position          = strpos($api_locale_string, $find_api_config);
            //find api key
            $tempendstring = substr($api_locale_string, $position, 100);
            $end           = strpos($tempendstring, '"},');
            $key           = substr($api_locale_string, $position + 12, $end - 12);
            //find locale
            $find_api_config = '"locale":"';
            $locale_pos      = strpos($api_locale_string, $find_api_config);
            $locale          = substr($api_locale_string, $locale_pos + 10, 2);
        }

        if ((!$key || empty($key)) && (!$this->placeId || empty($this->placeId))) {
            throw new \Exception(__('Error: Something went wrong. Please try again', 'wp-social-reviews'));
        }

        $limit        = apply_filters('wpsocialreviews/airbnb_reviews_limit_end_point', 5);
        $offset       = 0;
        $experiences  = strpos($downloadUrl, '/experiences/') !== false;
        $fetchUrl     = '';
        if ($experiences) {
            $fetchUrl = add_query_arg([
                'key'             => $key,
                '_order'          => 'language_country',
                'reviewable_id'   => $this->placeId,
                'reviewable_type' => 'MtTemplate',
                'role'            => 'guest',
                '_limit'          => $limit,
                '_format'         => 'for_p3'
            ], $this->remoteBaseUrl . '/reviews');
        } else {
            $fetchUrl = add_query_arg([
                'key'        => $key,
                '_order'     => 'language_country',
                'listing_id' => $this->placeId,
                'role'       => 'guest',
                '_limit'     => $limit,
                '_format'    => 'for_p3'
            ], $this->remoteBaseUrl . '/reviews');
        }

        $response = wp_remote_get($fetchUrl);

        //end: find airbnb reviews
        if (is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        $data     = json_decode(wp_remote_retrieve_body($response), true);

        if(Arr::get($data, 'error_message')) {
            throw new \Exception(Arr::get($data, 'error_message'));
        }

        if (isset($data['reviews'])) {
            $this->saveApiSettings([
                'api_key'       => $key,
                'place_id'      => $this->placeId,
                'business_name' => $this->businessName,
                'business_type' => $this->businessType,
                'url_value'     => $businessUrl
            ]);
            $this->syncRemoteReviews($data['reviews']);

            $businessInfo          = array();
            $businessInfo['total_fetched_reviews'] = count($data['reviews']);
            $businessInfo['total_rating'] = $data['metadata']['reviews_count'];
            return $businessInfo;
        } else {
            throw new \Exception(__('No reviews Found!', 'wp-social-reviews'));
        }
    }

    public function formatData($review, $index)
    {
        $reviewDate  = $review['created_at'];
        return [
            'platform_name' => $this->platform,
            'source_id'     => $this->placeId,
            'reviewer_name' => $review['reviewer']['first_name'],
            'review_title'  => '',
            'reviewer_url'  => 'https://www.airbnb.com' . $review['reviewer']['profile_path'],
            'reviewer_img'  => $review['reviewer']['picture_url'],
            'reviewer_text' => Arr::get($review, 'comments'),
            'rating'        => Arr::get($review, 'rating'),
            'review_time'   => date('Y-m-d H:i:s', strtotime($reviewDate)),
            'review_approved' => 1,
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_at'    => date('Y-m-d H:i:s')
        ];
    }

    public function saveBusinessInfo($data = array())
    {
        $businessInfo  = [];
        $infos         = $this->getBusinessInfo();
        $infos = empty($infos) ? [] : $infos;
        if ($data && is_array($data)) {
            $placeId                          = $this->placeId;
            $businessInfo['place_id']         = $placeId;
            $businessInfo['name']             = Arr::get($data, 'business_name');
            $businessInfo['url']              = $this->curUrl;
            $businessInfo['address']          = '';
            $businessInfo['average_rating']   = Arr::get($data, 'avg_rating');
            $businessInfo['total_rating']     = Arr::get($data, 'total_rating');
            $businessInfo['phone']            = '';
            $businessInfo['platform_name']    = $this->platform;
            $businessInfo['status']           = true;
            $infos[$placeId]                  =  $businessInfo;
        }
        return $infos;
    }

    public function getBusinessInfo()
    {
        return get_option('wpsr_reviews_airbnb_business_info');
    }

    public function saveApiSettings($settings)
    {
        $apiKey       = $settings['api_key'];
        $placeId      = $settings['place_id'];
        $businessUrl  = $settings['url_value'];
        $businessName = Arr::get($settings, 'business_name');
        $businessType = Arr::get($settings, 'business_type');

        $apiSettings  = $this->getApiSettings();

        if(isset($apiSettings['data']) && !$apiSettings['data']) {
            $apiSettings = [];
        }

        if($apiKey && $placeId && $businessUrl){
            $apiSettings[$placeId]['api_key']       = $apiKey;
            $apiSettings[$placeId]['place_id']      = $placeId;
            $apiSettings[$placeId]['url_value']     = $businessUrl;
            $apiSettings[$placeId]['business_name'] = $businessName;
            $apiSettings[$placeId]['business_type'] = $businessType;
        }
        return update_option($this->optionKey, $apiSettings, 'no');
    }

    public function getApiSettings()
    {
        $settings = get_option($this->optionKey);
        if (!$settings) {
            $settings = [
                'api_key'   => '',
                'place_id'  => '',
                'url_value' => '',
                'data'      => false
            ];
        }
        return $settings;
    }

    public function getAdditionalInfo()
    {
        return [];
    }
}
