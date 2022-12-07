<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Reviews;

use WPSocialReviews\App\Models\Review;
use WPSocialReviews\Framework\Foundation\Application;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;

class ConfigsController extends Controller
{
    protected $app = null;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function index(Request $request)
    {
        $platformName   = $request->get('platform');
        $credential     = $this->app->applyCustomFilters('api_credential_' . $platformName, []);
        $businessInfo   = $this->app->applyCustomFilters('business_info_' . $platformName, []);
        $additionalInfo = $this->app->applyCustomFilters('additional_info_' . $platformName, []);

        return [
            'credential'      => $credential,
            'business_info'   => $businessInfo,
            'additional_info' => $additionalInfo
        ];
    }

    public function store(Request $request)
    {
        $platform = $request->get('platform');
        $configs  = $request->get('verificationData');
        $this->app->doCustomAction('save_configs' . $platform, $configs);
    }

    public function saveReviews(Request $request)
    {
        $settings = $request->get('settings');
        $this->app->doCustomAction('verify_review_credential_' . $settings['platform'], $settings);
    }

    public function manuallySyncReviews(Request $request)
    {
        $platform = $request->get('platform');
        $credentials = $request->get('credentials');
        $this->app->doCustomAction($platform . '_manually_sync_reviews', $credentials);
    }

    public function delete(Request $request)
    {
        $platform           = $request->get('platform');
        $sourceId           = $request->get('sourceId');
        $settings_option_name = 'wpsr_reviews_' . $platform . '_settings';
        $business_info_option_name = 'wpsr_reviews_' . $platform . '_business_info';
        $settings           = get_option($settings_option_name);
        $businessInfo       = get_option($business_info_option_name);

        if($sourceId){
            unset($settings[$sourceId]);
            unset($businessInfo[$sourceId]);
        }
        update_option($settings_option_name, $settings, 'no');
        update_option($business_info_option_name, $businessInfo, 'no');

	    (new CacheHandler($platform))->clearCacheByName($business_info_option_name.'_' . $sourceId);

        if((is_array($settings) && count($settings) === 0) || (is_array($businessInfo) && count($businessInfo) === 0) || $sourceId === 'clear-locations') {
            delete_option($settings_option_name);
            delete_option($business_info_option_name);
            delete_option('wpsr_' . $platform . '_global_settings');
            if ($platform === 'google') {
                delete_option('wpsr_reviews_google_connected_accounts');
                // delete locations list of google business
                if($sourceId === 'clear-locations'){
                    delete_option('wpsr_reviews_google_locations_list');
                }
            }

            // delete pages list of facebook reviews
            if ($platform === 'facebook' && $sourceId === 'clear-locations') {
                delete_option('wpsr_reviews_facebook_pages_list');
            }

            // delete reviews by platform name
            if($sourceId === 'clear-locations'){
                Review::where('platform_name', $platform)
                    ->delete();
            }
        }

        // delete reviews by specific business id
        if($sourceId !== 'clear-locations'){
            Review::where('platform_name', $platform)
                ->where('source_id', $sourceId)
                ->delete();
        }

        return [
            'message' => __('Clear Configurations', 'wp-social-reviews')
        ];
    }
}
