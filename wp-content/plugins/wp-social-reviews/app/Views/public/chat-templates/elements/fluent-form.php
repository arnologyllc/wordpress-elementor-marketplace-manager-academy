<?php
use WPSocialReviews\Framework\Support\Arr;

if(!defined('FLUENTFORM_VERSION')){
    return;
}

$title = Arr::get($settings, 'ff_settings.header_title', __('Contact Us', 'wp-social-reviews'));

echo '<div class="wpsr-fluentform-wrapper">';
echo '<h3 class="wpsr-fluent-form-title">' . apply_filters('wpsocialreviews/ff_title', $title) . '</h3>';
foreach ($settings['channels'] as $key => $channel) {
    if($channel['name'] === 'fluent_forms' && !strpos($channel['credential'], 'fluentform_modal')){
        echo do_shortcode($channel['credential']);
    }
}
echo '</div>';