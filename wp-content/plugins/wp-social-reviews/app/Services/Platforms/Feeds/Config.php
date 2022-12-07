<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds;

use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\Helper as InstagramHelper;
use WPSocialReviews\App\Services\Platforms\Feeds\Facebook\Helper as FacebookHelper;

use WPSocialReviews\Framework\Support\Arr;

class Config
{
    public static function formatTwitterConfig($settings, $response)
    {
        $isPopup = Arr::get($settings, 'advance_settings.show_image_video_popup', 'false');
        if (!defined('WPSOCIALREVIEWS_PRO')) {
            $isPopup = 'false';
        }

        return array(
            'feed_settings' => array(
                'platform'               => 'twitter',
                'template'               => Arr::get($settings,'template', 'template1'),
                'layout_type'            => Arr::get($settings,'layout_type', 'standard'),
                'column_number'          => Arr::get($settings,'column_number', '4'),
                'responsive_column_number'  => array(
                    'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column_number', '4')),
                    'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','6'),
                    'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
                ),
                'column_gaps'            => Arr::get($settings,'column_gaps', 'default'),
                'enable_style'           => Arr::get($settings,'enable_style', 'false'),
                'additional_settings'    => array(
                    'feed_type'   => Arr::get($settings,'additional_settings.feed_type', 'user_timeline'),
                    'feed_count'  => (int) Arr::get($settings,'additional_settings.feed_count', 10),
                    "screen_name" => sanitize_text_field(Arr::get($settings,'additional_settings.screen_name', '')),
                    "hashtag"     => sanitize_text_field(Arr::get($settings,'additional_settings.hashtag', '')),
                ),
                'pagination_settings'    => array(
                    'pagination_type'       => Arr::get($settings,'pagination_settings.pagination_type', 'none'),
                    'load_more_button_text' => sanitize_text_field(__(Arr::get($settings, 'pagination_settings.load_more_button_text', 'Load More'), 'wp-social-reviews')),
                    'paginate'              => (int) Arr::get($settings,'pagination_settings.paginate', 6),
                ),
                'carousel_settings'      => array(
                    'autoplay'         => Arr::get($settings,'carousel_settings.autoplay', 'true'),
                    'autoplay_speed'   => (int) Arr::get($settings,'carousel_settings.autoplay_speed', 3000),
                    'slides_to_show'   => (int) Arr::get($settings,'carousel_settings.slides_to_show', 3),
                    'slides_to_scroll' => (int) Arr::get($settings,'carousel_settings.slides_to_scroll', 3),
                    'navigation'       => Arr::get($settings,'carousel_settings.navigation', 'dot')
                ),
                'advance_settings'       => array(
                    'user_name'                     => Arr::get($settings,'advance_settings.user_name', 'true'),
                    'avatar_image'                  => Arr::get($settings,'advance_settings.avatar_image', 'true'),
                    'author_name'                   => Arr::get($settings,'advance_settings.author_name', 'true'),
                    'twitter_logo'                  => Arr::get($settings,'advance_settings.twitter_logo', 'true'),
                    'tweet_text'                    => Arr::get($settings,'advance_settings.tweet_text', 'true'),
                    'date'                          => Arr::get($settings,'advance_settings.date', 'true'),
                    'tweet_action_target'           => Arr::get($settings,'advance_settings.tweet_action_target', '_blank'),
                    'show_reply_action'             => Arr::get($settings,'advance_settings.show_reply_action', 'true'),
                    'show_retweet_action'           => Arr::get($settings,'advance_settings.show_retweet_action', 'true'),
                    'show_like_action'              => Arr::get($settings,'advance_settings.show_like_action', 'true'),
                    'equal_height'                  => Arr::get($settings,'advance_settings.equal_height', 'false'),
                    'show_retweeted_tweet'          => Arr::get($settings,'advance_settings.show_retweeted_tweet', 'true'),
                    'show_quoted_tweet'             => Arr::get($settings,'advance_settings.show_quoted_tweet', 'true'),
                    'show_tweet_image'              => Arr::get($settings,'advance_settings.show_tweet_image', 'true'),
                    'show_tweet_video'              => Arr::get($settings,'advance_settings.show_tweet_video', 'true'),
                    'show_tweet_gif'                => Arr::get($settings,'advance_settings.show_tweet_gif', 'true'),
                    'show_image_video_popup'        => $isPopup,
                    'show_twitter_card'             => Arr::get($settings,'advance_settings.show_twitter_card', 'false'),
                    'show_card_for_third_party_url' => Arr::get($settings,'advance_settings.show_card_for_third_party_url', 'false'),
                ),
                'header_settings'        => array(
                    'show_header'       => Arr::get($settings,'header_settings.show_header', 'true'),
                    'show_total_tweets' => Arr::get($settings,'header_settings.show_total_tweets', 'true'),
                    'show_following'    => Arr::get($settings,'header_settings.show_following', 'true'),
                    'show_followers'    => Arr::get($settings,'header_settings.show_followers', 'true'),
                    'show_name'         => Arr::get($settings,'header_settings.show_name', 'true'),
                    'show_user_name'    => Arr::get($settings,'header_settings.show_user_name', 'true'),
                    'show_avatar'       => Arr::get($settings,'header_settings.show_avatar', 'true'),
                    'show_description'  => Arr::get($settings,'header_settings.show_description', 'true'),
                    'show_banner_image' => Arr::get($settings,'header_settings.show_banner_image', 'true'),
                    'show_location'     => Arr::get($settings,'header_settings.show_location', 'true'),
                ),
                'follow_button_settings' => array(
                    'display_follow_button'  => Arr::get($settings,'follow_button_settings.display_follow_button', 'true'),
                    'follow_button_text'     => sanitize_text_field(Arr::get($settings,'follow_button_settings.follow_button_text', __('Follow', 'wp-social-reviews'))),
                    'follow_button_position' => Arr::get($settings,'follow_button_settings.follow_button_position', 'header'),
                ),
                'filters'                => array(
                    'total_posts'      => (int) Arr::get($settings,'filters.total_posts', 50),
                    'total_posts_number'  => array(
                        'desktop'  => (int) Arr::get($settings, 'filters.total_posts_number.desktop', Arr::get($settings,'filters.total_posts', 50)),
                        'mobile'   => (int) Arr::get($settings, 'filters.total_posts_number.mobile', Arr::get($settings,'filters.total_posts', 50))
                    ),
                    'post_order'       => Arr::get($settings,'filters.post_order', 'ascending'),
                    'includes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.includes_inputs', '')),
                    'excludes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.excludes_inputs', '')),
                    'hide_posts_by_id' => sanitize_text_field(Arr::get($settings,'filters.hide_posts_by_id', ''))
                ),
                'popup_settings'         => array(
                    'autoplay'            => Arr::get($settings,'popup_settings.autoplay', 'true'),
                    'display_sidebar'     => Arr::get($settings,'popup_settings.display_sidebar', 'true'),
                    'user_name'           => Arr::get($settings,'popup_settings.user_name', 'true'),
                    'avatar_image'        => Arr::get($settings,'popup_settings.avatar_image', 'true'),
                    'author_name'         => Arr::get($settings,'popup_settings.author_name', 'true'),
                    'twitter_logo'        => Arr::get($settings,'popup_settings.twitter_logo', 'true'),
                    'tweet_text'          => Arr::get($settings,'popup_settings.tweet_text', 'true'),
                    'display_date'        => Arr::get($settings,'popup_settings.display_date', 'true'),
                    'show_reply_action'   => Arr::get($settings,'popup_settings.show_reply_action', 'true'),
                    'show_retweet_action' => Arr::get($settings,'popup_settings.show_retweet_action', 'true'),
                    'show_like_action'    => Arr::get($settings,'popup_settings.show_like_action', 'true'),
                ),
            ),
            'dynamic'       => Arr::get($response,'feed', $response),
            'header'        => Arr::get($response,'header', [])
        );
    }

    /**
     * Format youtube settings
     *
     * @param array $settings settings
     * @param array $response response
     *
     * @return array
     * @since 1.2.5
     */
    public static function formatYoutubeConfig($settings, $response)
    {
        $play_mode = defined('WPSOCIALREVIEWS_PRO') ? 'gallery' : 'inline';

        return array(
            'feed_settings' => array(
                'platform'                  => 'youtube',
                'template'                  => Arr::get($settings, 'template', 'template1'),
                'layout_type'               => Arr::get($settings, 'layout_type', 'grid'),
                'column_number'             => Arr::get($settings, 'column_number', '4'),
                'responsive_column_number'  => array(
                    'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column_number', '4')),
                    'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','6'),
                    'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
                ),
                'column_gaps'               => Arr::get($settings, 'column_gaps', 'default'),
                'enable_style'              => Arr::get($settings,'enable_style', 'false'),
                'source_settings'           => array(
                    'feed_type'   => Arr::get($settings, 'source_settings.feed_type', 'channel_feed'),
                    'channel_id'  => sanitize_text_field(Arr::get($settings, 'source_settings.channel_id', '')),
                    'playlist_id' => sanitize_text_field(Arr::get($settings, 'source_settings.playlist_id', '')),
                    'user_name'   => sanitize_text_field(Arr::get($settings, 'source_settings.user_name', '')),
                    'feed_count'  => (int) Arr::get($settings, 'source_settings.feed_count', 50),
                    'search_term' => sanitize_text_field(Arr::get($settings, 'source_settings.search_term', '')),
                    'video_id'    => sanitize_text_field(Arr::get($settings, 'source_settings.video_id', '')),
                    'event_type'  => Arr::get($settings, 'source_settings.event_type', 'completed'),
                ),
                'video_settings'            => array(
                    'display_play_icon'        => Arr::get($settings,'video_settings.display_play_icon', 'true'),
                    'display_duration'         => Arr::get($settings,'video_settings.display_duration', 'true'),
                    'display_title'            => Arr::get($settings,'video_settings.display_title', 'true'),
                    'trim_title_words'         => (int) Arr::get($settings,'video_settings.trim_title_words', 8),
                    'display_date'             => Arr::get($settings,'video_settings.display_date', 'true'),
                    'display_description'      => Arr::get($settings,'video_settings.display_description', 'true'),
                    'display_views_counter'    => Arr::get($settings,'video_settings.display_views_counter', 'true'),
                    'display_likes_counter'    => Arr::get($settings,'video_settings.display_likes_counter', 'false'),
                    'display_comments_counter' => Arr::get($settings,'video_settings.display_comments_counter', 'false'),
                    'play_mode'                => Arr::get($settings,'video_settings.play_mode', $play_mode),
                    'display_channel_name'     => Arr::get($settings,'video_settings.display_channel_name', 'false'),
                ),
                'carousel_settings'         => array(
                    'autoplay'         => Arr::get($settings,'carousel_settings.autoplay', 'true'),
                    'autoplay_speed'   => (int) Arr::get($settings,'carousel_settings.autoplay_speed', 3000),
                    'slides_to_show'   => (int) Arr::get($settings,'carousel_settings.slides_to_show', 3),
                    'slides_to_scroll' => (int) Arr::get($settings,'carousel_settings.slides_to_scroll', 3),
                    'navigation'       => Arr::get($settings,'carousel_settings.navigation', 'dot'),
                ),
                'header_settings'           => array(
                    'display_header'             => Arr::get($settings,'header_settings.display_header', 'true'),
                    'display_name'               => Arr::get($settings,'header_settings.display_name', 'true'),
                    'display_description'        => Arr::get($settings,'header_settings.display_description', 'false'),
                    'display_videos_counter'     => Arr::get($settings,'header_settings.display_videos_counter', 'true'),
                    'display_subscriber_counter' => Arr::get($settings,'header_settings.display_subscriber_counter', 'true'),
                    'display_views_counter'      => Arr::get($settings,'header_settings.display_views_counter', 'true'),
                    'display_logo'               => Arr::get($settings,'header_settings.display_logo', 'true'),
                    'display_banner'             => Arr::get($settings,'header_settings.display_banner', 'true'),
                ),
                'subscribe_button_settings' => array(
                    'display_subscribe_button'  => Arr::get($settings,'subscribe_button_settings.display_subscribe_button', 'true'),
                    'subscribe_button_text'     => sanitize_text_field(Arr::get($settings,'subscribe_button_settings.subscribe_button_text', __('SUBSCRIBE', 'wp-social-reviews'))),
                    'subscribe_button_position' => Arr::get($settings,'subscribe_button_settings.subscribe_button_position', 'header'),
                ),
                'popup_settings'            => array(
                    'display_title'               => Arr::get($settings,'popup_settings.display_title', 'true'),
                    'display_channel_name'        => Arr::get($settings,'popup_settings.display_channel_name', 'true'),
                    'display_channel_logo'        => Arr::get($settings,'popup_settings.display_channel_logo', 'true'),
                    'display_subscribers_counter' => Arr::get($settings,'popup_settings.display_subscribers_counter', 'true'),
                    'display_subscribe_button'    => Arr::get($settings,'popup_settings.display_subscribe_button', 'true'),
                    'display_views_counter'       => Arr::get($settings,'popup_settings.display_views_counter', 'true'),
                    'display_likes_counter'       => Arr::get($settings,'popup_settings.display_likes_counter', 'true'),
                    'display_dislikes_counter'    => Arr::get($settings,'popup_settings.display_dislikes_counter', 'true'),
                    'display_date'                => Arr::get($settings,'popup_settings.display_date', 'true'),
                    'display_description'         => Arr::get($settings,'popup_settings.display_description', 'true'),
                    'display_comments'            => Arr::get($settings,'popup_settings.display_comments', 'true'),
                    'autoplay'                    => Arr::get($settings,'popup_settings.autoplay', 'true'),
                    'video_loop'                  => Arr::get($settings,'popup_settings.video_loop', 'false'),
                ),
                'filters'                   => array(
                    'total_posts'      => (int) Arr::get($settings,'filters.total_posts', 50),
                    'total_posts_number'  => array(
                        'desktop'  => (int) Arr::get($settings, 'filters.total_posts_number.desktop', Arr::get($settings,'filters.total_posts', 50)),
                        'mobile'   => (int) Arr::get($settings, 'filters.total_posts_number.mobile', Arr::get($settings,'filters.total_posts', 50))
                    ),
                    'post_order'       => Arr::get($settings,'filters.post_order', 'ascending'),
                    'includes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.includes_inputs', '')),
                    'excludes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.excludes_inputs', '')),
                    'hide_posts_by_id' => sanitize_text_field(Arr::get($settings,'filters.hide_posts_by_id', ''))
                ),
                'pagination_settings'       => array(
                    'pagination_type'       => Arr::get($settings,'pagination_settings.pagination_type', 'none'),
                    'load_more_button_text' => sanitize_text_field(Arr::get($settings, 'pagination_settings.load_more_button_text', __('Load More', 'wp-social-reviews'))),
                    'paginate'              => (int) Arr::get($settings,'pagination_settings.paginate', 6),
                ),
            ),

            'dynamic' => $response,

            'feed_info' => array(
                'feed_type'  => Arr::get($settings,'source_settings.feed_type', ''),
                'event_type' => Arr::get($settings,'source_settings.event_type', ''),
            ),
        );
    }
    
    /**
     * Formatted All Instagram Configs
     *
     * @param array $settings
     * @param array $response
     *
     * @return array
     * @since 1.3.0
     */
    public static function formatInstagramConfig($settings, $response)
    {
        $accounts    = InstagramHelper::getUserAccounts($settings);
        $displayMode = Arr::get($settings, 'post_settings.display_mode', 'instagram');
        if (!defined('WPSOCIALREVIEWS_PRO')) {
            $displayMode = (Arr::get($settings,'post_settings.display_mode') && $settings['post_settings']['display_mode'] === 'none') ? 'none' : 'instagram';
        }

        return array(
            'feed_settings' => array (
                'platform'      => 'instagram',
                'template'      => Arr::get($settings,'template', 'template1'),
                'layout_type'   => Arr::get($settings,'layout_type', 'grid'),
                'column_number' => Arr::get($settings,'column_number', '4'),
                'responsive_column_number'  => array(
                    'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column_number', '4')),
                    'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','4'),
                    'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
                ),
                'column_gaps'   => Arr::get($settings,'column_gaps', 'default'),
                'enable_style'  => Arr::get($settings,'enable_style', 'false'),

                'source_settings' => array(
                    'feed_type'    => Arr::get($settings,'source_settings.feed_type', 'user_account_feed'),
                    'account_ids'  => $accounts['account_ids'],
                    'hash_tags'    => sanitize_text_field(Arr::get($settings,'source_settings.hash_tags', '')),
                    'hashtag_type' => Arr::get($settings,'source_settings.hashtag_type', 'top_media'),
                ),

                'carousel_settings' => array(
                    'autoplay'         => Arr::get($settings,'carousel_settings.autoplay', 'true'),
                    'autoplay_speed'   => (int) Arr::get($settings,'carousel_settings.autoplay_speed', 3000),
                    'slides_to_show'   => (int) Arr::get($settings,'carousel_settings.slides_to_show', 3),
                    'slides_to_scroll' => (int) Arr::get($settings,'carousel_settings.slides_to_scroll', 3),
                    'navigation'       => Arr::get($settings,'carousel_settings.navigation', 'dot')
                ),

                'header_settings' => array(
                    'display_header'            => Arr::get($settings,'header_settings.display_header', 'true'),
                    'account_to_show'           => $accounts['connected_account_id'],
                    'display_name'              => Arr::get($settings,'header_settings.display_name', 'true'),
                    'display_username'          => Arr::get($settings,'header_settings.display_username', 'true'),
                    'display_avatar'            => Arr::get($settings,'header_settings.display_avatar', 'true'),
                    'display_description'       => Arr::get($settings,'header_settings.display_description', 'true'),
                    'display_posts_counter'     => Arr::get($settings,'header_settings.display_posts_counter', 'true'),
                    'display_followers_counter' => Arr::get($settings,'header_settings.display_followers_counter', 'true'),
                    'custom_profile_bio_text'   => sanitize_text_field(Arr::get($settings,'header_settings.custom_profile_bio_text', '')),
                    'custom_profile_photo'      => Arr::get($settings,'header_settings.custom_profile_photo', ''),
                ),

                'post_settings' => array (
                    'display_mode'             => $displayMode,
                    'display_likes_counter'    => Arr::get($settings,'post_settings.display_likes_counter', 'true'),
                    'display_comments_counter' => Arr::get($settings,'post_settings.display_comments_counter', 'true'),
                    'display_caption'          => Arr::get($settings,'post_settings.display_caption', 'true'),
                    'trim_caption_words'       => (int) Arr::get($settings,'post_settings.trim_caption_words', 15),
                ),

                'popup_settings' => array (
                    'display_sidebar'       => Arr::get($settings,'popup_settings.display_sidebar', 'true'),
                    'display_profile_photo' => Arr::get($settings,'popup_settings.display_profile_photo', 'true'),
                    'display_username'      => Arr::get($settings,'popup_settings.display_username', 'true'),
                    'display_caption'       => Arr::get($settings,'popup_settings.display_caption', 'true'),
                    'display_date'          => Arr::get($settings,'popup_settings.display_date', 'true'),
                    'display_comments'      => Arr::get($settings,'popup_settings.display_comments', 'true'),
                    'display_cta_btn'       => Arr::get($settings,'popup_settings.display_cta_btn', 'true'),
                ),

                'follow_button_settings' => array (
                    'display_follow_button'  => Arr::get($settings,'follow_button_settings.display_follow_button', 'true'),
                    'follow_button_text'     => sanitize_text_field(Arr::get($settings,'follow_button_settings.follow_button_text', __('Follow on Instagram', 'wp-social-reviews'))),
                    'follow_button_position' => Arr::get($settings,'follow_button_settings.follow_button_position', 'header'),
                ),

                'filters' => array (
                    'total_posts'      => (int) Arr::get($settings,'filters.total_posts', 50),
                    'total_posts_number'  => array(
                        'desktop'  => (int) Arr::get($settings, 'filters.total_posts_number.desktop', Arr::get($settings,'filters.total_posts', 50)),
                        'mobile'   => (int) Arr::get($settings, 'filters.total_posts_number.mobile', Arr::get($settings,'filters.total_posts', 50))
                    ),
                    'post_order'       => Arr::get($settings,'filters.post_order', 'ascending'),
                    'post_type'        => Arr::get($settings,'filters.post_type', 'all'),
                    'includes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.includes_inputs', '')),
                    'excludes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.excludes_inputs', '')),
                    'hide_posts_by_id' => sanitize_text_field(Arr::get($settings,'filters.hide_posts_by_id', ''))
                ),

                'pagination_settings' => array (
                    'pagination_type'       => Arr::get($settings,'pagination_settings.pagination_type', 'none'),
                    'load_more_button_text' => sanitize_text_field(Arr::get($settings, 'pagination_settings.load_more_button_text', __('Load More', 'wp-social-reviews'))),
                    'paginate'              => (int) Arr::get($settings,'pagination_settings.paginate', 6),
                ),
            ),
            'dynamic'       => $response
        );
    }

    public static function formatFacebookConfig($settings, $response)
    {
        $accounts    = FacebookHelper::getConncetedSourceList();
        $selectedAccounts = Arr::get($settings, 'source_settings.selected_accounts', []);

        $firstKey = '';
        if(!empty($accounts) && empty($selectedAccounts)) {
            $accountsKeys = array_keys($accounts);
            $firstKey = ''.$accountsKeys[0];
            $selectedAccounts = Arr::get($settings, 'source_settings.account_ids', [0 => $firstKey]);
        }

        return array(
            'feed_settings' => array(
                'platform'                  => 'facebook_feed',
                'template'                  => Arr::get($settings, 'template', 'template1'),
                'layout_type'               => Arr::get($settings, 'layout_type', 'grid'),
                'column_number'             => Arr::get($settings, 'column_number', '4'),
                'responsive_column_number'  => array(
                    'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column_number', '4')),
                    'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','6'),
                    'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
                ),
                'column_gaps'               => Arr::get($settings, 'column_gaps', 'default'),
                'enable_style'           => Arr::get($settings,'enable_style', 'false'),
                'source_settings'  => array(
                    'feed_type'         => Arr::get($settings, 'source_settings.feed_type', 'timeline_feed'),
                    'selected_accounts' => $selectedAccounts,
                    'feed_count'        => (int) Arr::get($settings, 'source_settings.feed_count', 50),
                ),
                'filters'  => array(
                    'total_posts'      => (int) Arr::get($settings,'filters.total_posts', 50),
                    'total_posts_number'  => array(
                        'desktop'  => (int) Arr::get($settings, 'filters.total_posts_number.desktop', Arr::get($settings,'filters.total_posts', 50)),
                        'mobile'   => (int) Arr::get($settings, 'filters.total_posts_number.mobile', Arr::get($settings,'filters.total_posts', 50))
                    ),
                    'post_order'       => Arr::get($settings,'filters.post_order', 'ascending'),
                    'includes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.includes_inputs', '')),
                    'excludes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.excludes_inputs', '')),
                    'hide_posts_by_id' => sanitize_text_field(Arr::get($settings,'filters.hide_posts_by_id', '')),
                    'hide_shared_posts' => Arr::get($settings,'filters.hide_shared_posts', true)
                ),
                'post_settings' => array(
                    'display_mode'            => Arr::get($settings,'post_settings.display_mode', 'facebook'),
                    'display_author_photo'    => Arr::get($settings,'post_settings.display_author_photo', 'true'),
                    'display_author_name'     => Arr::get($settings,'post_settings.display_author_photo', 'true'),
                    'display_date'            => Arr::get($settings,'post_settings.display_date', 'true'),
                    'display_description'     => Arr::get($settings,'post_settings.display_description', 'true'),
                    'display_likes_count'     => Arr::get($settings,'post_settings.display_likes_count', 'true'),
                    'display_comments_count'  => Arr::get($settings,'post_settings.display_comments_count', 'true'),
                    'display_play_icon'       => Arr::get($settings,'post_settings.display_play_icon', 'true'),
                    'display_duration'        => Arr::get($settings,'post_settings.display_duration', 'true'),
                    'display_platform_icon'   => Arr::get($settings,'post_settings.display_platform_icon', 'true'),
                    'equal_height'            => Arr::get($settings,'post_settings.equal_height', 'true'),
                ),
                'header_settings' => array(
                    'display_header'             => Arr::get($settings,'header_settings.display_header', 'true'),
                    'account_to_show'            => Arr::get($settings,'header_settings.account_to_show', $firstKey),
                    'display_cover_photo'        => Arr::get($settings,'header_settings.display_cover_photo', 'true'),
                    'display_profile_photo'      => Arr::get($settings,'header_settings.display_profile_photo', 'true'),
                    'display_page_name'          => Arr::get($settings,'header_settings.display_page_name', 'true'),
                    'display_description'        => Arr::get($settings,'header_settings.display_description', 'true'),
                    'display_likes_counter'      => Arr::get($settings,'header_settings.display_likes_counter', 'true'),
                ),
                'carousel_settings' => array(
                    'autoplay'         => Arr::get($settings,'carousel_settings.autoplay', 'true'),
                    'autoplay_speed'   => (int) Arr::get($settings,'carousel_settings.autoplay_speed', 3000),
                    'slides_to_show'   => (int) Arr::get($settings,'carousel_settings.slides_to_show', 3),
                    'slides_to_scroll' => (int) Arr::get($settings,'carousel_settings.slides_to_scroll', 3),
                    'navigation'       => Arr::get($settings,'carousel_settings.navigation', 'dot'),
                ),
                'popup_settings'     => array(
                    'display_sidebar'       => Arr::get($settings,'popup_settings.display_sidebar', 'true'),
                    'display_profile_photo' => Arr::get($settings,'popup_settings.display_profile_photo', 'true'),
                    'display_username'      => Arr::get($settings,'popup_settings.display_username', 'true'),
                    'display_caption'       => Arr::get($settings,'popup_settings.display_caption', 'true'),
                    'display_date'          => Arr::get($settings,'popup_settings.display_date', 'true'),
                    'display_comments'      => Arr::get($settings,'popup_settings.display_comments', 'true'),
                    'display_cta_btn'       => Arr::get($settings,'popup_settings.display_cta_btn', 'true'),
                ),
                'like_button_settings' => array(
                    'display_like_button'       => Arr::get($settings,'like_button_settings.display_like_button', 'true'),
                    'like_button_text'          => sanitize_text_field(Arr::get($settings,'like_button_settings.like_button_text', __('Like Page', 'wp-social-reviews'))),
                    'like_button_position'      => Arr::get($settings,'like_button_settings.like_button_position', 'header'),
                ),
                'share_button_settings' => array(
                    'display_share_button'      => Arr::get($settings,'share_button_settings.display_share_button', 'true'),
                    'share_button_text'         => sanitize_text_field(Arr::get($settings,'share_button_settings.share_button_text', __('Share', 'wp-social-reviews'))),
                    'share_button_position'     => Arr::get($settings,'share_button_settings.share_button_position', 'header'),
                ),
                'pagination_settings' => array(
                    'pagination_type' => Arr::get($settings,'pagination_settings.pagination_type', 'none'),
                    'load_more_button_text' => sanitize_text_field(Arr::get($settings, 'pagination_settings.load_more_button_text', __('Load More', 'wp-social-reviews'))),
                    'paginate'        => (int) Arr::get($settings,'pagination_settings.paginate', 6),
                ),
            ),
        );
    }
}