<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\App\Models\Review;
use WPSocialReviews\App\Services\Platforms\Feeds\Facebook\FacebookFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\Youtube\YoutubeFeed;
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\App\Services\Helper as GlobalHelper;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;
use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\TwitterFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\InstagramFeed;

use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\GlobalSettings;

class ShortcodeHandler
{
    private $feedJson;
    private $popupSettings;
    private $additionalSettings;
    private $uniqueId = null;
    private $scripts = [];
    public $platform = '';

    public function addShortcode()
    {
        add_shortcode('wp_social_ninja', array($this, 'makeShortcode'));
        add_action('wp_enqueue_scripts', array($this, 'registerScripts'), 999);
        add_action('wp_social_ninja_add_layout_script', array($this, 'enqueueScripts'));
    }

    public function makeShortcode($args = [], $content = null, $tag = '')
    {
        $args = shortcode_atts(array(
            'id'       => '',
            'platform' => ''
        ), $args);

        if (!$args['id']) {
            return '';
        }
        if (empty($args['platform']) || empty($args['id'])) {
            return __('Please, set a template platform name or template id on your shortcode', 'wp-social-reviews');
        }

        $templateId = absint($args['id']);
        $platform = sanitize_text_field($args['platform']);

        if (!in_array($platform, GlobalHelper::shortcodeAllowedPlatforms())) {
            return __('Provided platform name is not valid.', 'wp-social-reviews');
        }

        $this->platform = $args['platform'];

        if (!did_action('wp_enqueue_scripts')) {
            $this->registerStyles();
        }

        $this->enqueueStyles([$this->platform]);

        $platformName = $args['platform'] === 'facebook_feed' ? 'Facebook' : $args['platform'];
        $methodName = str_replace('_', ucfirst($platformName), 'render_Template');

        return $this->{$methodName}($templateId, $platform);

    }

    public function templateMeta($templateId, $platform)
    {
        $encodedMeta = get_post_meta($templateId, '_wpsr_template_config', true);
        $template_meta = json_decode($encodedMeta, true);
        if (!$template_meta || empty($template_meta)) {
            return ['error_message' => __('No template is available for this shortcode!!', 'wp-social-reviews')];
        }
        $error_message = __('Please set a template platform name on your shortcode', 'wp-social-reviews');
        if ($platform === 'reviews' || $platform === 'testimonial') {
            $template_meta = Helper::formattedTemplateMeta($template_meta);
            if (empty($template_meta['platform'])) {
                return [
                    'error_message' => $error_message
                ];
            }
        } elseif ($platform === 'twitter') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatTwitterConfig($configs, []);
        } elseif ($platform === 'youtube') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatYoutubeConfig($configs, []);
        } elseif ($platform === 'instagram') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatInstagramConfig($configs, []);
        } elseif ($platform === 'facebook_feed') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatFacebookConfig($configs, []);
        }

        if (($platform !== 'reviews' && $platform !== 'testimonial') && !Arr::get($template_meta, 'feed_settings.platform')) {
            return [
                'error_message' => $error_message
            ];
        }

        return $template_meta;
    }

    public function reviewsTemplatePath($template = '')
    {
        $templateMapping = [
            'grid1' => 'public.reviews-templates.template1',
            'grid2' => 'public.reviews-templates.template2',
            'grid3' => 'public.reviews-templates.template3',
            'grid4' => 'public.reviews-templates.template4',
            'grid5' => 'public.reviews-templates.template5',
        ];

        if (!isset($templateMapping[$template])) {
            return [
                'error_message' => __('You need to upgrade to pro to use this template!', 'wp-social-reviews')
            ];
        }

        return $templateMapping[$template];
    }

    public function renderTestimonialTemplate($templateId, $platform)
    {
        return $this->renderReviewsTemplate($templateId, $platform);
    }

    public function renderReviewsTemplate($templateId, $platform)
    {
        $app = App::getInstance();
        $template_meta = $this->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }
        $platforms = Arr::get($template_meta, 'platform', []);
        $badge_settings = Arr::get($template_meta, 'badge_settings', []);
        $selectedBusinesses = Arr::get($template_meta, 'selectedBusinesses', []);
        $business_info = Helper::getSelectedBusinessInfoByPlatforms($platforms, $selectedBusinesses);
        $validTemplatePlatforms = Helper::validPlatforms($platforms);
        $templateType = Arr::get($template_meta, 'templateType');

        $translations = GlobalSettings::getTranslations();

        $reviews = array();
        $totalReviews = 0;
        if (!empty($validTemplatePlatforms)) {
            $data = Review::paginatedReviews($validTemplatePlatforms, $template_meta);
            $reviews = $data['reviews'];
            $totalReviews = $data['total_reviews'];
        }

        $template = Arr::get($template_meta, 'template', '');
        if (empty($template) || empty($reviews)) {
            return __('Sorry! We could not get any reviews', 'wp-social-reviews');
        }

        $html = '';
        if ($templateType === 'badge') {
            if (empty($business_info)) {
                return $html;
            }
            $html .= apply_filters('wpsocialreviews/add_reviews_badge_template', $templateId, $templateType,
                $business_info, $badge_settings);
            if ($badge_settings['display_reviews_on_click'] === 'false') {
                return $html;
            }
        }

        if ($templateType === 'notification') {
            $html .= apply_filters('wpsocialreviews/add_reviews_notification_template', $templateId, $template_meta,
                $reviews);
            $this->enqueueNotificationScripts();
        }

        $hookType = $templateType;
        if ($hookType == 'slider') {
            $hookType = 'carousel';
        }

        do_action('wp_social_review_loading_layout_' . $hookType, $templateId, $template_meta);

        //if (Arr::get($template_meta, 'pagination_type') == 'load_more') {
        $this->enqueueScripts();
        //}

        do_action('wpsocialreviews/load_template_assets', $templateId);


        $html .= $app->view->make('public.reviews-templates.header', array(
            'template_meta' => $template_meta,
            'templateType'  => $templateType,
            'reviews'       => $reviews,
            'business_info' => $business_info,
            'templateId'    => $templateId,
            'translations'  => $translations
        ));


        $templates = ['grid1', 'grid2', 'grid3', 'grid4', 'grid5'];
        if (!in_array($template, $templates) && defined('WPSOCIALREVIEWS_PRO')) {
            $html .= apply_filters('wpsocialreviews/add_reviews_template', $template, $reviews, $template_meta);
        } else {
            $templatePath = $this->reviewsTemplatePath($template);
            if (!empty($templatePath['error_message'])) {
                return $templatePath['error_message'] . '<br/>';
            }
            $html .= $app->view->make($templatePath, array(
                'reviews' => $reviews,
                'template_meta' => $template_meta,
            ));
        }

        $html .= $app->view->make('public.reviews-templates.footer', array(
            'templateId'    => $templateId,
            'totalReviews'  => $totalReviews,
            'template_meta' => $template_meta,
            'templateType'  => $templateType,
            'reviews'       => $reviews,
            'business_info' => $business_info,
            'translations'  => $translations
        ));

        return $html;
    }

    public function renderTwitterTemplate($templateId, $platform)
    {
        $app = App::getInstance();
        $template_meta = $this->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new TwitterFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $this->formatFeedSettings($feed, $platform);

        $error_message = Arr::get($feed, 'error_message');
        if ($error_message) {
            return $error_message;
        }

        //pagination settings
        $pagination_settings = $this->formatPaginationSettings($feed, $platform);

        if (Arr::get($settings['feed_settings'], 'advance_settings.show_image_video_popup') === 'true') {
            $this->makePopupModal($settings['dynamic'], $settings['header'], $settings['feed_settings'], $templateId, $platform);
        }

        if (Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type') != 'none') {
            $this->enqueueScripts();
        }

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        if ($layout) {
            do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);
        }


        if (Arr::get($settings, 'feed_settings.advance_settings.show_image_video_popup') == 'true') {
            $this->enqueuePopupScripts();
        }

        $template_body_data = array(
            'templateId'    => $templateId,
            'feeds'         => $settings['dynamic'],
            'template_meta' => $settings['feed_settings'],
            'paginate'      => $pagination_settings['paginate'],
            'total'         => $pagination_settings['total'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
        );

        $translations = GlobalSettings::getTranslations();

        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';
        $html .= $app->view->make('public.feeds-templates.twitter.header', array(
            'templateId'      => $templateId,
            'header'          => $settings['header'],
            'feed_settings'   => $settings['feed_settings'],
            'column_gaps'     => $settings['column_gaps'],
            'layout_type'     => $settings['layout_type'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'translations'    => $translations
        ));
        if ($settings['layout_type'] !== 'standard' && defined('WPSOCIALREVIEWS_PRO')) {
            $html .= apply_filters('wpsocialreviews/add_twitter_template', $template_body_data);
        } else {
            $html .= $app->view->make('public.feeds-templates.twitter.template1', $template_body_data);
        }
        $html .= $app->view->make('public.feeds-templates.twitter.footer', array(
            'templateId'      => $templateId,
            'header'          => $settings['header'],
            'feed_settings'   => $settings['feed_settings'],
            'column_gaps'     => $settings['column_gaps'],
            'layout_type'     => $settings['layout_type'],
            'paginate'        => $pagination_settings['paginate'],
            'total'           => $pagination_settings['total'],
            'pagination_type' => $pagination_settings['pagination_type']
        ));

        return $html;
    }

    public function renderYoutubeTemplate($templateId, $platform)
    {
        $app = App::getInstance();
        $template_meta = $this->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new YoutubeFeed())->getTemplateMeta($template_meta, $templateId);
        $feed_info = Arr::get($feed, 'feed_info', []);
        $settings = $this->formatFeedSettings($feed);


        $error_message = Arr::get($settings['dynamic'], 'error_message');
        if (Arr::get($error_message, 'error_message')) {
            return $error_message['error_message'];
        } elseif ($error_message) {
            return $error_message;
        }

        //pagination settings
        $pagination_settings = $this->formatPaginationSettings($feed);

        $template = Arr::get($settings['feed_settings'], 'template', '');
        // render template 1, template 2, template 3 from template 1
        $template = !defined('WPSOCIALREVIEWS_PRO') && ($template === 'template2' || $template === 'template3') ? 'template1' : $template;

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        if ($layout) {
            do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);
        }

        $this->enqueuePopupScripts();

        //if (Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type') != 'none') {
            $this->enqueueScripts();
       // }

        $translations = GlobalSettings::getTranslations();

        do_action('wpsocialreviews/load_template_assets', $templateId);


        $html = '';
        $html .= $app->view->make('public.feeds-templates.youtube.header', array(
            'template'        => $template,
            'templateId'      => $templateId,
            'header'          => $settings['header'],
            'feeds'           => $settings['feeds'],
            'feed_settings'   => $settings['feed_settings'],
            'paginate'        => $pagination_settings['paginate'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'total'           => $pagination_settings['total'],
            'translations'    => $translations
        ));
        $html .= $app->view->make('public.feeds-templates.youtube.template1', array(
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'feed_info'     => $feed_info,
            'template_meta' => $settings['feed_settings'],
            'total'         => $pagination_settings['total'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
        ));
        $html .= $app->view->make('public.feeds-templates.youtube.footer', array(
            'templateId'      => $templateId,
            'header'          => $settings['header'],
            'feed_settings'   => $settings['feed_settings'],
            'column_gaps'     => $settings['column_gaps'],
            'layout_type'     => $settings['layout_type'],
            'paginate'        => $pagination_settings['paginate'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'total'           => $pagination_settings['total'],
        ));

        return $html;
    }

    public function renderFacebookTemplate($templateId, $platform)
    {
        if (defined('LSCWP_V')) {
            do_action('litespeed_tag_add', 'wpsn_purge_facebook_feed');
        }
        $app = App::getInstance();
        $template_meta = $this->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new FacebookFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $this->formatFeedSettings($feed);

        $error_message = Arr::get($settings['dynamic'], 'error_message');
        if (Arr::get($error_message, 'error_message')) {
            return $error_message['error_message'];
        } elseif ($error_message) {
            return $error_message;
        }

        if (sizeof(Arr::get($settings, 'feeds')) === 0) {
            return '<p>' . __('Posts are not available!', 'wp-social-reviews') . '</p>';
        }

        //template mapping
        $templateMapping = [
            'template1' => 'public.feeds-templates.facebook.template1',
        ];

        $template = Arr::get($settings['feed_settings'], 'template', '');
        if (!isset($templateMapping[$template])) {
            return '<p>' . __('No Templates found!! Please save and try again', 'wp-social-reviews') . '</p>';
        }

        $file = $templateMapping[$template];

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);

        //pagination settings
        $pagination_settings = $this->formatPaginationSettings($feed);

        $translations = GlobalSettings::getTranslations();

        if (Arr::get($settings['feed_settings'], 'post_settings.display_mode') === 'popup') {
            $feeds = $settings['feeds'];
            foreach ($feeds as $index => $feed) {
                /* translators: %s: Human-readable time difference. */
                $feeds[$index]['time_ago'] = sprintf(__('%s ago'), human_time_diff(strtotime($feed['updated_time'])));
            }
            $this->makePopupModal($feeds, $settings['header'], $settings['feed_settings'], $templateId, $platform);
            $this->enqueuePopupScripts();
        }

        // if(Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type') != 'none') {
        $this->enqueueScripts();
        //}
        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';

        $html .= $app->view->make('public.feeds-templates.facebook.header', array(
            'templateId'    => $templateId,
            'template'      => $template,
            'header'        => $settings['header'],
            'feed_settings' => $settings['feed_settings'],
            'layout_type'   => $settings['layout_type'],
            'column_gaps'   => $settings['column_gaps'],
            'translations'  => $translations
        ));

        $html .= $app->view->make($file, array(
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'template_meta' => $settings['feed_settings'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
            'translations'  => $translations
        ));

        $html .= $app->view->make('public.feeds-templates.facebook.footer', array(
            'templateId'      => $templateId,
            'feeds'           => $settings['feeds'],
            'feed_settings'   => $settings['feed_settings'],
            'layout_type'     => $settings['layout_type'],
            'column_gaps'     => $settings['column_gaps'],
            'paginate'        => $pagination_settings['paginate'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'header'          => $settings['header'],
            'total'           => $pagination_settings['total'],
        ));

        return $html;
    }

    public function renderInstagramTemplate($templateId, $platform)
    {

        if (defined('LSCWP_V')) {
            do_action('litespeed_tag_add', 'wpsn_purge_instagram');
        }

        $app = App::getInstance();
        $template_meta = $this->templateMeta($templateId, $platform);
        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new InstagramFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $this->formatFeedSettings($feed);

        $error_message = Arr::get($settings['dynamic'], 'error_message');
        if (Arr::get($error_message, 'error_message')) {
            return $error_message['error_message'];
        } elseif ($error_message) {
            return $error_message;
        }

        //template mapping
        $templateMapping = [
            'template1' => 'public.feeds-templates.instagram.template1',
            'template2' => 'public.feeds-templates.instagram.template2',
        ];
        $template = Arr::get($settings['feed_settings'], 'template', '');
        if (!isset($templateMapping[$template])) {
            return '<p>' . __('No Templates found!! Please save and try again', 'wp-social-reviews') . '</p>';
        }
        $file = $templateMapping[$template];

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);


        //pagination settings
        $pagination_settings = $this->formatPaginationSettings($feed);
        $translations = GlobalSettings::getTranslations();

        if (Arr::get($settings['feed_settings'], 'post_settings.display_mode') === 'popup') {
            $feeds = $settings['feeds'];
            $hasMulti = false;
            foreach ($feeds as $index => $feed) {
                /* translators: %s: Human-readable time difference. */
                $feeds[$index]['time_ago'] = sprintf(__('%s ago'), human_time_diff(strtotime($feed['timestamp'])));
                if (isset($feed['comments'])) {
                    foreach ($feed['comments'] as $commentIndex => $comment) {
                        $feeds[$index]['comments'][$commentIndex]['time_ago'] = sprintf(__('%s ago'), human_time_diff(strtotime($comment['timestamp'])));
                    }
                }

                if (!$hasMulti && isset($feed['children'])) {
                    $hasMulti = true;
                }
            }
            $this->makePopupModal($feeds, $settings['header'], $settings['feed_settings'], $templateId, $platform);
            $this->enqueuePopupScripts();
            if ($hasMulti) {
                do_action('wp_social_review_loading_layout_carousel', $templateId, $settings);
            }
        }

        if (Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type') != 'none' || Arr::get($settings['feed_settings'], 'post_settings.display_mode') === 'popup') {
            $this->enqueueScripts();
        }

        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';
        $html .= $app->view->make('public.feeds-templates.instagram.header', array(
            'templateId'    => $templateId,
            'template'      => $template,
            'header'        => $settings['header'],
            'feed_settings' => $settings['feed_settings'],
            'layout_type'   => $settings['layout_type'],
            'column_gaps'   => $settings['column_gaps'],
            'translations'  => $translations
        ));
        $html .= $app->view->make($file, array(
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'template_meta' => $settings['feed_settings'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
        ));
        $html .= $app->view->make('public.feeds-templates.instagram.footer', array(
            'templateId'      => $templateId,
            'feeds'           => $settings['feeds'],
            'feed_settings'   => $settings['feed_settings'],
            'layout_type'     => $settings['layout_type'],
            'column_gaps'     => $settings['column_gaps'],
            'paginate'        => $pagination_settings['paginate'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'total'           => $pagination_settings['total'],
        ));

        return $html;
    }

    public function formatFeedSettings($feed = [], $platform = '')
    {
        $feed_settings = Arr::get($feed, 'feed_settings', []);
        $filterSettings = Arr::get($feed_settings, 'filters', []);
        $dynamic = Arr::get($feed, 'dynamic', $feed);
        $feeds = Arr::get($dynamic, 'items', []);

        if ($platform === 'twitter') {
            $header = Arr::get($feed, 'header', []);
            $layout_type = Arr::get($feed_settings, 'layout_type', 'standard');
        } else {
            $header = Arr::get($dynamic, 'header', []);
            $layout_type = Arr::get($feed_settings, 'layout_type', 'grid');
        }

        $column_gaps = Arr::get($feed_settings, 'column_gaps', 'default');

        return [
            'feeds'           => $feeds,
            'header'          => $header,
            'feed_settings'   => $feed_settings,
            'filter_settings' => $filterSettings,
            'layout_type'     => $layout_type,
            'column_gaps'     => $layout_type !== 'carousel' ? $column_gaps : null,
            'dynamic'         => $dynamic,
        ];
    }

    public function formatPaginationSettings($feed = [], $platform = '')
    {
        $settings = $this->formatFeedSettings($feed);
        $sinceId = 0;
        $paginate = intval(Arr::get($settings['feed_settings'], 'pagination_settings.paginate', 6));
        $maxId = ($sinceId + $paginate) - 1;
        if ($platform === 'twitter') {
            $totalFeed = is_array($settings['dynamic']) ? count($settings['dynamic']) : 0;
        } else {
            $totalFeed = is_array($settings['feeds']) ? count($settings['feeds']) : 0;
        }

        $numOfFeeds = Arr::get($settings, 'filter_settings.total_posts_number');
        $totalFilterFeed = wp_is_mobile() ? Arr::get($numOfFeeds, 'mobile') : Arr::get($numOfFeeds, 'desktop');
        $total = (int)($totalFilterFeed && $totalFeed < $totalFilterFeed) ? $totalFeed : $totalFilterFeed;

        $pagination_type = Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type', 'none');

        if ($settings['layout_type'] === 'carousel' || $pagination_type === 'none') {
            $maxId = $totalFeed;
        }

        return [
            'sinceId'         => $sinceId,
            'maxId'           => $maxId,
            'paginate'        => $paginate,
            'total'           => $total,
            'pagination_type' => $pagination_type,
        ];
    }

    public function loadPopupScripts()
    {
        foreach ($this->scripts as $script) {
            $platform = Arr::get($script, 'platform_name');
            $platform = $platform === 'facebook_feed' ? 'FacebookFeed' : $platform;
            $prefix = 'WPSR_';
            $frontEndJson = str_replace('_', $prefix . ucfirst($platform), '_FrontEndJson');
            $popupSettings = str_replace('_', $prefix . ucfirst($platform), '_PopupSettings');
            $additionalSettings = str_replace('_', $prefix . ucfirst($platform), '_AdditionalSettings');
            ?>
            <script type="text/javascript" id="wpsr-popup-script">
                if (!window.<?php echo esc_attr($frontEndJson); ?>) {
                    window.<?php echo esc_attr($frontEndJson); ?> = {};
                }
                if (!window.<?php echo esc_attr($popupSettings); ?>) {
                    window.<?php echo esc_attr($popupSettings); ?> = {};
                }
                if (!window.<?php echo esc_attr($additionalSettings); ?>) {
                    window.<?php echo esc_attr($additionalSettings); ?> = {};
                }

                window.<?php echo esc_attr($frontEndJson); ?>["<?php echo esc_attr($script['uniqueId']); ?>"] = <?php echo GlobalHelper::printInternalString($script['feedJson']); ?>;
                window.<?php echo esc_attr($popupSettings); ?>["<?php echo esc_attr($script['uniqueId']); ?>"] = <?php echo GlobalHelper::printInternalString($script['popupSettings']); ?>;
                window.<?php echo esc_attr($additionalSettings); ?>["<?php echo esc_attr($script['uniqueId']); ?>"] = <?php echo GlobalHelper::printInternalString($script['additionalSettings']); ?>;
            </script>
            <?php
        }
    }

    public function makePopupModal($feeds = [], $header = [], $feed_settings = [], $templateId = null, $platform = '')
    {
        $popupSettings = Arr::get($feed_settings, 'popup_settings', []);
        $headerSettings = Arr::get($feed_settings, 'header_settings', []);

        //set all data, settings for popup
        $additionalSettings = array(
            'header_settings' => $headerSettings
        );

        if ($platform === 'instagram') {
            $additionalSettings['assets_url'] = WPSOCIALREVIEWS_URL . 'assets';
            $additionalSettings['user_avatar'] = Arr::get($header, 'user_avatar');
            $additionalSettings['feed_type'] = Arr::get($feed_settings, 'source_settings.feed_type');
            $additionalSettings['hash_tags'] = Arr::get($feed_settings, 'source_settings.hash_tags');
        }

        if ($platform === 'facebook_feed') {
            $additionalSettings['assets_url'] = WPSOCIALREVIEWS_URL . 'assets';
            $additionalSettings['feed_type'] = Arr::get($feed_settings, 'source_settings.feed_type');
        }

        $this->feedJson = json_encode($feeds);
        $this->popupSettings = json_encode($popupSettings);
        $this->additionalSettings = json_encode($additionalSettings);
        $this->uniqueId = $templateId;
        $this->scripts[] = $this->setPopupModalData($platform);
        add_action('wp_footer', array($this, 'loadPopupScripts'), 99);
    }

    public function setPopupModalData($platform)
    {
        return [
            'platform_name'      => $platform,
            'uniqueId'           => intval($this->uniqueId),
            'feedJson'           => $this->feedJson,
            'popupSettings'      => $this->popupSettings,
            'additionalSettings' => $this->additionalSettings,
        ];
    }

    /**
     *  Enqueue All Front-End Assets
     *
     * @param
     */
    public function registerScripts()
    {

        wp_register_script('wp-social-review', WPSOCIALREVIEWS_URL . 'assets/js/wp-social-review.js',
            array('jquery'), WPSOCIALREVIEWS_VERSION, true);

        wp_register_script('social-ninja-modal', WPSOCIALREVIEWS_URL . 'assets/js/social-ninja-modal.js',
            array('jquery'), WPSOCIALREVIEWS_VERSION, true);

        wp_register_script('wpsn-notification', WPSOCIALREVIEWS_URL . 'assets/js/wpsn-notification.js',
            array('jquery'), WPSOCIALREVIEWS_VERSION, true);


        $this->registerStyles();

        global $post;
        if ((is_a($post, 'WP_Post') && $shortcodeIds = get_post_meta($post->ID, '_wpsn_ids', true))) {
            $this->enqueueStyles($shortcodeIds);
        }
    }

    public function registerStyles()
    {
        wp_register_style(
            'wp_social_ninja_reviews',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_reviews.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_testimonial',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_testimonial.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_ig',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_ig.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_fb',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_fb.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_tw',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tw.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_yt',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_yt.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );
    }

    public function enqueueStyles($platformNames = [])
    {
        if (!$platformNames) {
            return false;
        }
        $maps = [
            'twitter'       => 'tw',
            'youtube'       => 'yt',
            'instagram'     => 'ig',
            'facebook_feed' => 'fb',
            'reviews'       => 'reviews',
            'testimonial'       => 'testimonial'
        ];

        $styles = [];
        foreach ($platformNames as $platform) {
            if (isset($maps[$platform])) {
                $styles[$maps[$platform]] = $maps[$platform];
            } else {
                $styles['reviews'] = 'reviews';
            }
        }

        if (!$styles) {
            return false;
        }

        $styles = array_keys($styles);

        foreach ($styles as $style) {
            wp_enqueue_style('wp_social_ninja_' . $style);
        }
    }

    public function loadLocalizeScripts()
    {
        static $jsLoaded;

        if ($jsLoaded) {
            return;
        }

        $translations = GlobalSettings::getTranslations();
        $params = apply_filters('wpsocialreviews/frontend_vars', array(
            'ajax_url'   => admin_url('admin-ajax.php'),
            'wpsr_nonce' => wp_create_nonce('wpsr-ajax-nonce'),
            'has_pro'    => defined('WPSOCIALREVIEWS_PRO'),
            'read_more'  => Arr::get($translations, 'read_more'),
            'read_less'  => Arr::get($translations, 'read_less'),
            'view_on_fb' => Arr::get($translations, 'view_on_fb'),
            'view_on_ig' => Arr::get($translations, 'view_on_ig'),
            'likes'      => Arr::get($translations, 'likes'),
        ));
        ?>
        <script type="text/javascript" id="wpsr-localize-script">
            window.wpsr_ajax_params = <?php echo json_encode($params); ?>;
        </script>
        <?php
        $jsLoaded = true;
    }

    public function enqueueScripts()
    {
        static $jsLoaded;

        if ($jsLoaded) {
            return;
        }

        wp_enqueue_script('wp-social-review');
        add_action('wp_footer', array($this, 'loadLocalizeScripts'), 99);
        $jsLoaded = true;
    }

    public function enqueueNotificationScripts()
    {
        wp_enqueue_script('wpsn-notification');
    }

    public function localizePopupScripts()
    {
        static $jsLoaded;

        if ($jsLoaded) {
            return;
        }
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
        );
        ?>
        <script type="text/javascript" id="wpsr-localize-popup-script">
            window.wpsr_popup_params = <?php echo json_encode($params); ?>;
        </script>
        <?php
        $jsLoaded = true;
    }

    public function enqueuePopupScripts()
    {
        wp_enqueue_script('social-ninja-modal');
        add_action('wp_footer', array($this, 'localizePopupScripts'), 99);
    }

    public function handleLoadMoreAjax()
    {
        $templateId = absint(Arr::get($_REQUEST, 'template_id'));
        $platform = sanitize_text_field(Arr::get($_REQUEST, 'platform'));
        $page = absint(Arr::get($_REQUEST, 'page', 2));

        if ($platform == 'youtube') {
            $content = (new YoutubeTemplateHandler())->getPaginatedFeedHtml($templateId, $page);
        } else if ($platform == 'twitter') {
            $content = (new TwitterTemplateHandler())->getPaginatedFeedHtml($templateId, $page);
        } else if ($platform == 'facebook_feed') {
            $content = (new FacebookFeedTemplateHandler())->getPaginatedFeedHtml($templateId, $page);
        } else if ($platform == 'reviews') {
            $content = (new ReviewsTemplateHandler())->getPaginatedFeedHtml($templateId, $page);
        } else {
            $content = apply_filters('wpsr_feed_items_by_page_' . $platform, '', $templateId, $page);
        }

        wp_send_json([
            'content' => $content
        ]);
        die();
    }
}
