<?php

namespace WPSocialReviews\App\Services\Platforms\Chats;

if (!defined('ABSPATH')) {
    exit;
}

abstract class BaseChat
{
    public function registerHooks()
    {
        add_action('wpsocialreviews/get_chat_settings', array($this, 'getSettings'), 10, 2);
        add_action('wpsocialreviews/delete_chat_settings', array($this, 'deleteSettings'), 10, 2);
        add_action('wpsocialreviews/update_chat_settings', array($this, 'updateSettings'), 10, 2);
    }
}