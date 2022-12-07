<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Feeds;

use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\Framework\Request\Request;

class MetaController extends Controller
{
    public function index(Request $request, $postId)
    {
        $platform = $request->get('platform');
        do_action('wpsocialreviews/get_editor_settings_' . $platform, $postId);
    }

    public function update(Request $request, $postId)
    {
        $platform = $request->get('platform');
        $settings = json_decode($request->get('settings'), true);
        $settings = wp_unslash($settings);
        do_action('wpsocialreviews/update_editor_settings_' . $platform, $settings, $postId);
    }

    public function edit(Request $request, $postId)
    {
        $platform = $request->get('platform');
        $settings = json_decode($request->get('settings'), true);
        $settings = wp_unslash($settings);
        do_action('wpsocialreviews/edit_editor_settings_' . $platform, $settings, $postId);
    }
}