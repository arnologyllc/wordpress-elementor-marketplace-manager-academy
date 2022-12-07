<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Feeds;

use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\Framework\Request\Request;

class ConfigsController extends Controller
{
    public function index(Request $request)
    {
        $platform = $request->get('platform');
        do_action('wpsocialreviews/get_verification_configs_' . $platform);
    }

    public function store(Request $request)
    {
        $settings = $request->get('settings');
        $settings = json_decode($settings, true);
        $settings = wp_unslash($settings);
        $platform = $request->get('platform');
        do_action('wpsocialreviews/verify_credential_' . $platform, $settings);
    }

    public function delete(Request $request)
    {
        $platform = $request->get('platform');
        $userId   = $request->get('user_id'); //for instagram only
        do_action('wpsocialreviews/clear_verification_configs_' . $platform, $userId);
    }
}