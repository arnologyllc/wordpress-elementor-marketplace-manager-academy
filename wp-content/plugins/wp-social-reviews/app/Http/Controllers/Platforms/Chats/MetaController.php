<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Chats;

use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\Framework\Request\Request;

class MetaController extends Controller
{
    public function index(Request $request, $postId)
    {
        do_action('wpsocialreviews/get_chat_settings', $postId);
    }

    public function update(Request $request, $postId)
    {
        $settings = json_decode($request->get('args'), true);
        $settings = wp_unslash($settings);
        do_action('wpsocialreviews/update_chat_settings', $postId, $settings);
    }

    public function delete(Request $request, $postId)
    {
        do_action('wpsocialreviews/delete_chat_settings', $postId);
    }
}