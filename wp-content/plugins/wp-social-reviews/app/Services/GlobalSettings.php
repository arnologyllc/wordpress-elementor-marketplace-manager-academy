<?php

namespace WPSocialReviews\App\Services;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register a widget that render a feed shortcode
 * @since 1.3.0
 */
class GlobalSettings
{
    public function formatGlobalSettings()
    {
        $settings = get_option('wpsr_global_settings', []);

        return array(
            'global_settings' => array(
                'translations' => array(
                    'subscribers'       => sanitize_text_field(Arr::get($settings,'global_settings.translations.subscribers', __('Subscribers', 'wp-social-reviews'))),
                    'following'         => sanitize_text_field(Arr::get($settings,'global_settings.translations.following', __('Following', 'wp-social-reviews'))),
                    'followers'         => sanitize_text_field(Arr::get($settings,'global_settings.translations.followers', __('Followers', 'wp-social-reviews'))),
                    'videos'            => sanitize_text_field(Arr::get($settings,'global_settings.translations.videos', __('Videos', 'wp-social-reviews'))),
                    'views'             => sanitize_text_field(Arr::get($settings,'global_settings.translations.views', __('Views', 'wp-social-reviews'))),
                    'tweets'            => sanitize_text_field(Arr::get($settings,'global_settings.translations.tweets', __('Tweets', 'wp-social-reviews'))),
                    'people_like_this'  => sanitize_text_field(Arr::get($settings,'global_settings.translations.people_like_this', __('people like this', 'wp-social-reviews'))),
                    'posts'             => sanitize_text_field(Arr::get($settings,'global_settings.translations.posts', __( 'Posts', 'wp-social-reviews' ))),
                    'leave_a_review'    => sanitize_text_field(Arr::get($settings,'global_settings.translations.leave_a_review', __( 'Where you want to leave a review?', 'wp-social-reviews' ))),
                    'recommends'        => sanitize_text_field(Arr::get($settings,'global_settings.translations.recommends', __('recommends', 'wp-social-reviews'))),
                    'does_not_recommend' => sanitize_text_field(Arr::get($settings,'global_settings.translations.does_not_recommend', __('doesn\'t recommend', 'wp-social-reviews'))),
                    'on'                => sanitize_text_field(Arr::get($settings,'global_settings.translations.on', __('on', 'wp-social-reviews'))),
                    'read_all_reviews'  => sanitize_text_field(Arr::get($settings,'global_settings.translations.read_all_reviews', __('Read all reviews', 'wp-social-reviews'))),
                    'read_more'         => sanitize_text_field(Arr::get($settings,'global_settings.translations.read_more', __('Read more', 'wp-social-reviews'))),
                    'read_less'         => sanitize_text_field(Arr::get($settings,'global_settings.translations.read_less', __('Read less', 'wp-social-reviews'))),
                    'comments'          => sanitize_text_field(Arr::get($settings,'global_settings.translations.comments', __('Comments', 'wp-social-reviews'))),
                    'view_on_fb'        => sanitize_text_field(Arr::get($settings,'global_settings.translations.view_on_fb', __( 'View on Facebook', 'wp-social-reviews' ))),
                    'view_on_ig'        => sanitize_text_field(Arr::get($settings,'global_settings.translations.view_on_ig', __( 'View on Instagram', 'wp-social-reviews' ))),
                    'likes'             => sanitize_text_field(Arr::get($settings,'global_settings.translations.likes', __( 'likes', 'wp-social-reviews' ))),
                ),
            )
        );
    }

    public static function getTranslations()
    {
        $translations_settings = (new self)->formatGlobalSettings();
        $translations = Arr::get($translations_settings, 'global_settings.translations');
        return $translations;
    }
}