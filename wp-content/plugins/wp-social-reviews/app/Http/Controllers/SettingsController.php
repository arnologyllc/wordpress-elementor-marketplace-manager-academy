<?php

namespace WPSocialReviews\App\Http\Controllers;

use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\Framework\Support\Arr;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->get('platform');
        do_action('wpsocialreviews/get_advance_settings_' . $platform);
    }

    public function update(Request $request)
    {
        $platform = $request->get('platform');
        $settingsJSON = $request->get('settings');
        $settings = json_decode($settingsJSON, true);
        $settings = wp_unslash($settings);
        do_action('wpsocialreviews/save_advance_settings_' . $platform, $settings);
    }

    public function delete(Request $request)
    {
        $platform = $request->get('platform');
        $cacheType = $request->get('cacheType');
        do_action('wpsocialreviews/clear_cache_' . $platform, $cacheType);
    }

    public function getFluentFormsSettings(Request $request)
    {
        $platform = 'fluent_forms';
        do_action('wpsocialreviews/get_advance_settings_' . $platform);
    }

    public function saveFluentFormsSettings(Request $request)
    {
        $platform = 'fluent_forms';
        $settingsJSON = $request->get('settings');
        $settings = json_decode($settingsJSON, true);
        $settings = wp_unslash($settings);
        do_action('wpsocialreviews/save_advance_settings_' . $platform, $settings);
    }

    public function deleteTwitterCard()
    {
        delete_option('wpsr_twitter_cards_data');

        return [
            'success' => 'success',
            'message' => __('Card Data Deleted Successfully!', 'wp-social-reviews')
        ];
    }

    public function getLicense(Request $request)
    {
        $response = apply_filters('wpsr_get_license', false, $request);
        if(!$response) {
            return $this->sendError([
                'message' => __('Sorry! License could not be retrieved. Please try again', 'wp-social-reviews')
            ]);
        }

        return $response;
    }

    public function removeLicense(Request $request)
    {
        $response = apply_filters('wpsr_deactivate_license', false, $request);
        if(!$response) {
            return $this->sendError([
                'message' => __('Sorry! License could not be removed. Please try again', 'wp-social-reviews')
            ]);
        }

        return $response;
    }

    public function addLicense(Request $request)
    {
        $response = apply_filters('wpsr_activate_license', false, $request);
        if(!$response) {
            return $this->sendError([
                'message' => __('Sorry! License could not be added. Please try again', 'wp-social-reviews')
            ]);
        }

        return $response;
    }

    public function getTranslations()
    {
        $globalSettings = new GlobalSettings();
        return $globalSettings->formatGlobalSettings();
    }

    public function saveTranslations(Request $request)
    {
        $settings = $request->get('global_settings');
        update_option('wpsr_global_settings', $settings);

        return [
            'message'   =>  __('Settings saved successfully!', 'wp-social-reviews')
        ];
    }
}