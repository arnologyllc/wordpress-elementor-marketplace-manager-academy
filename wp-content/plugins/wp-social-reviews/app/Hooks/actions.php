<?php

/**
 * All registered action's handlers should be in app\Hooks\Handlers,
 * addAction is similar to add_action and addCustomAction is just a
 * wrapper over add_action which will add a prefix to the hook name
 * using the plugin slug to make it unique in all wordpress plugins,
 * ex: $app->addCustomAction('foo', ['FooHandler', 'handleFoo']) is
 * equivalent to add_action('slug-foo', ['FooHandler', 'handleFoo']).
 */

/**
 * @var $app \WPSocialReviews\Framework\Foundation\Application
 */

// Init the platform on plugin load

(new \WPSocialReviews\App\Hooks\Handlers\PlatformHandler())->register();

$app->addAction('wp_social_reviews_loaded', 'ActivateCronEvent@activate');
$app->addAction('admin_menu', 'AdminMenuHandler@addMenus');
$app->addAction('admin_enqueue_scripts', 'AdminMenuHandler@enqueueAssets');
$app->addAction('admin_init', function () {
    $disablePages = [
        'wpsocialninja.php',
    ];
    if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
        remove_all_actions('admin_notices');
    }
});

add_action('save_post', function ($postId, $post) use ($app) {
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $ctTemplateId = get_post_meta($postId, 'ct_other_template', true);
    if ($ids = \WPSocialReviews\App\Services\Helper::getShortCodeIds($post->post_content)) {
        $shortcodeIds = array_values($ids);
        $templates = $app->db->table('posts')
            ->select(['post_content'])
            ->whereIn('ID', $shortcodeIds)
            ->where('post_type', 'wp_social_reviews')
            ->get();
        $items = [];
        foreach ($templates as $template) {
            $platform = $template->post_content;
            if(!$platform) {
                continue;
            }
            if(defined('FL_BUILDER_VERSION')){
                $platform = str_replace('empty_', '', $platform);
            }
            $platform = substr($platform, 0, 20);
            $items[$platform] = $platform;
        }
        $items = array_values($items);
        update_post_meta($postId, '_wpsn_ids', $items);
    } elseif($ctTemplateId && (is_a($post, 'WP_Post'))) {
        $ctTemplateMeta = get_post_meta($ctTemplateId, '_wpsn_ids', true);
        $ctTemplateMeta = array_values($ctTemplateMeta);
        update_post_meta($postId, '_wpsn_ids', $ctTemplateMeta);
    } else {
        delete_post_meta($postId, '_wpsn_ids');
    }
}, 10, 2);

add_action('init', function () {
    (new \WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler())->addShortcode();
    (new \WPSocialReviews\App\Hooks\Handlers\ChatHandler())->chatRegister();
    (new \WPSocialReviews\App\Hooks\Handlers\NotificationHandler())->notificationRegister();
});

/*
 * Common Ajax Hook for Load More Feeds
 */

$app->addAction('wp_ajax_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
$app->addAction('wp_ajax_nopriv_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');


// Register the widget
add_action('widgets_init', function () {
    register_widget('WPSocialReviews\App\Services\SidebarWidgets');
});

/**
 * Gutenberg blocks register
 */
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'wpsr-gutenberg-block',
        WPSOCIALREVIEWS_URL . 'assets/js/wpsr-shortcode-block.js',
        array('wp-blocks', 'wp-i18n', 'wp-polyfill', 'wp-element', 'wp-components', 'wp-editor'),
        WPSOCIALREVIEWS_VERSION
    );

    $defaults = array(
        'numberposts'      => -1,
        'orderby'          => 'id',
        'order'            => 'DESC',
        'post_type'        => 'wp_social_reviews',
    );
    $reviews = [
        'yelp',
        'facebook',
        'booking.com',
        'aliexpress',
        'amazon',
        'tripadvisor',
        'airbnb',
        'google',
        'fluent_forms',
        'custom'
    ];

    $reviews = apply_filters('wpsocialreviews/reviews_slugs', $reviews);

    $templates = get_posts($defaults);
    $formatted = array();
    foreach ($templates as $template) {
        $platforms = get_post_meta($template->ID, '_wpsr_template_config', true);
        $platforms = json_decode($platforms, true);
        $platform_name = 'reviews';

        if (is_array($platforms) && isset($platforms['platform'])) {
            $platform_name = sizeof($platforms['platform']) > 1 ? 'reviews' :  'reviews';
        }

        if (in_array($platform_name, $reviews)) {
            $platform_name = 'reviews';
        }

        if( isset($platforms['feed_settings']['platform']) ){
            $platform_name =  $platforms['feed_settings']['platform'];
        }

        $formatted[] = array(
            'id' => $template->ID,
            'title' => $template->post_title . ' (' . $template->ID . ')',
            'platform' => $platform_name
        );
    }

    array_unshift($formatted, (object)[
        'id' => '0',
        'platform' => 'reviews',
        'title' => __('-- Select a template --', 'wp-social-reviews')
    ]);

    wp_localize_script('wpsr-gutenberg-block', 'wpsr_block_vars', [
        'logo'  => WPSOCIALREVIEWS_URL . 'assets/images/icon/wp_social_ninja.png',
        'templates' => $formatted
    ]);

    wp_enqueue_style(
        'wpsr-gutenberg-block',
        WPSOCIALREVIEWS_URL . 'assets/css/social-review-gutenblock.css',
        array('wp-edit-blocks')
    );
});

/*******
 *
 * Reviews templates action hooks
 *
 *******/
$app->addAction('wpsocialreviews/reviews_template_item_wrappers_before', 'ReviewsTemplateHandler@renderTemplateItemParentWrapper');
$app->addAction('wpsocialreviews/reviews_template_item_wrappers_after', 'ReviewsTemplateHandler@renderTemplateItemParentWrapperEnd');
$app->addAction('wpsocialreviews/reviewer_image', 'ReviewsTemplateHandler@renderReviewerImageHtml', 10, 4);
$app->addAction('wpsocialreviews/review_platform', 'ReviewsTemplateHandler@renderReviewPlatformHtml', 10, 3);
$app->addAction('wpsocialreviews/reviewer_name', 'ReviewsTemplateHandler@renderReviewerNameHtml', 10, 3);
$app->addAction('wpsocialreviews/reviewer_rating', 'ReviewsTemplateHandler@renderReviewerRatingHtml', 10, 5);
$app->addAction('wpsocialreviews/review_date', 'ReviewsTemplateHandler@renderReviewDateHtml', 10, 2);
$app->addAction('wpsocialreviews/review_content', 'ReviewsTemplateHandler@renderReviewContentHtml', 10, 5);
$app->addAction('wpsocialreviews/review_title', 'ReviewsTemplateHandler@renderReviewTitleHtml', 10, 3);

//reviews templates ajax load more
/*******
 *
 * Twitter feed templates action hooks
 *
 *******/
$app->addAction('wpsocialreviews/tweet_author_info', 'TwitterTemplateHandler@renderTweetAuthorNameHtml', 5, 2);
$app->addAction('wpsocialreviews/tweet_author_info', 'TwitterTemplateHandler@renderTweetAuthorVerifiedIconHtml', 10, 2);
$app->addAction('wpsocialreviews/tweet_author_username', 'TwitterTemplateHandler@renderTweetAuthorUsernameHtml', 10, 2);
$app->addAction('wpsocialreviews/tweet_time', 'TwitterTemplateHandler@renderTweetTimeHtml', 10, 2);
$app->addAction('wpsocialreviews/tweet_author_avatar', 'TwitterTemplateHandler@renderTweetAuthorAvatarHtml', 10, 2);
$app->addAction('wpsocialreviews/tweet_retweeted_status', 'TwitterTemplateHandler@renderTweetRetweetedStatusHtml');
$app->addAction('wpsocialreviews/tweet_content', 'TwitterTemplateHandler@renderTweetContentHtml', 10, 4);
$app->addAction('wpsocialreviews/tweet_quoted_status', 'TwitterTemplateHandler@renderQuotedTweetStatusHtml', 10, 4);
$app->addAction('wpsocialreviews/tweet_image', 'TwitterTemplateHandler@renderTweetImageHtml', 10, 4);
$app->addAction('wpsocialreviews/tweet_video', 'TwitterTemplateHandler@renderTweetVideoHtml', 10, 4);
$app->addAction('wpsocialreviews/tweet_actions', 'TwitterTemplateHandler@renderTweetActionReply', 5, 2);
$app->addAction('wpsocialreviews/tweet_actions', 'TwitterTemplateHandler@renderTweetActionRetweetCount', 10, 2);
$app->addAction('wpsocialreviews/tweet_actions', 'TwitterTemplateHandler@renderTweetActionFavoriteCount', 15, 2);

/*******
 *
 * Youtube feed templates action hooks
 *
 *******/
$app->addAction('wpsocialreviews/youtube_feed_template_item_wrapper_before', 'YoutubeTemplateHandler@renderTemplateItemWrapper');
$app->addAction('wpsocialreviews/youtube_channel_banner', 'YoutubeTemplateHandler@renderChannelBanner', 10, 2);
$app->addAction('wpsocialreviews/youtube_channel_logo', 'YoutubeTemplateHandler@renderChannelLogo', 10, 2);
$app->addAction('wpsocialreviews/youtube_channel_name', 'YoutubeTemplateHandler@renderChannelName', 10, 2);
$app->addAction('wpsocialreviews/youtube_feed_preview_image', 'YoutubeTemplateHandler@renderPreviewImage', 10, 5);
$app->addAction('wpsocialreviews/youtube_feed_title', 'YoutubeTemplateHandler@renderTitle', 10, 4);

/**
 * Retrieve youtube popup-box data
 *
 * @since  1.2.5
 */
$app->addAction('wp_ajax_nopriv_wpsr_youtube_popup_feed', 'YoutubeTemplateHandler@renderPopupFeed');
$app->addAction('wp_ajax_wpsr_youtube_popup_feed', 'YoutubeTemplateHandler@renderPopupFeed');

/*******
 *
 * Instagram feed templates action hooks
 *
 *******/
$app->addAction('wpsocialreviews/instagram_feed_template_item_wrapper_before', 'InstagramTemplateHandler@renderTemplateItemWrapper');
$app->addAction('wpsocialreviews/instagram_post_media', 'InstagramTemplateHandler@renderPostMedia', 10, 3);
$app->addAction('wpsocialreviews/instagram_post_caption', 'InstagramTemplateHandler@renderPostCaption', 10, 2);
$app->addAction('wpsocialreviews/instagram_icon', 'InstagramTemplateHandler@renderIcon');

/*******
 *
 * Facebook feed templates action hooks
 *
 *******/
$app->addAction('wpsocialreviews/facebook_feed_template_item_wrapper_before', 'FacebookFeedTemplateHandler@renderTemplateItemWrapper');
$app->addAction('wpsocialreviews/facebook_feed_author', 'FacebookFeedTemplateHandler@renderFeedAuthor', 10, 2);
$app->addAction('wpsocialreviews/facebook_feed_description', 'FacebookFeedTemplateHandler@renderFeedDescription', 10, 2);
$app->addAction('wpsocialreviews/facebook_feed_media', 'FacebookFeedTemplateHandler@renderFeedMedia', 10, 2);
$app->addAction('wpsocialreviews/facebook_feed_summary_card', 'FacebookFeedTemplateHandler@renderFeedSummaryCard', 10, 2);
$app->addAction('wpsocialreviews/facebook_feed_date', 'FacebookFeedTemplateHandler@renderFeedDate');




/*
 * Cron Job Init
 */
$app->addAction('wpsr_cron_job', 'SchedulerHandler@handle');

/*
 * Elementor Widget Init
 */
if (defined('ELEMENTOR_VERSION')) {
    new WPSocialReviews\App\Services\Widgets\ElementorWidget();
}

/*
 * Oxygen Widget Init
 */
if (class_exists('OxyEl') ) {
    if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Oxygen/OxygenWidget.php' ) ) {
        new WPSocialReviews\App\Services\Widgets\Oxygen\OxygenWidget();
    }
}

/*
 * Beaver Builder Widget Init
 */
if ( class_exists( 'FLBuilder' ) ) {
    new WPSocialReviews\App\Services\Widgets\Beaver\BeaverWidget();
}

if(defined('LSCWP_V')){
    add_action('litespeed_init', function (){
        if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'wpsocialreviews') !== false){
            defined( 'LITESPEED_ESI_OFF' ) || define( 'LITESPEED_ESI_OFF', true );
        }
    });
}

