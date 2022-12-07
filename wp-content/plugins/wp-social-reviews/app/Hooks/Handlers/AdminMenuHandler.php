<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\App\App;
use WPSocialReviews\App\Hooks\Handlers\ActivationHandler;
use WPSocialReviews\App\Services\Helper;
use WPSocialReviews\Framework\Support\Arr;

/**
 * Register Menu and Admin Pages
 * @since 1.0.0
 */
class AdminMenuHandler
{
    /**
     *
     * Add Menu and sub menu for the admin page
     * @return string
     * @since 1.0.0
     *
     **/
    public function addMenus()
    {
        $permission = Helper::getAccessPermission();
        if (!current_user_can($permission)) {
            return;
        }

        $title = __('WP Social Ninja', 'wp-social-reviews');

        global $submenu;
        add_menu_page(
            $title,
            $title,
            $permission,
            'wpsocialninja.php',
            array($this, 'render'),
            $this->getIcon(),
            25
        );

        if(defined('WPSOCIALREVIEWS_PRO')) {
            $license = get_option('__wpsr_license');
            if (Arr::get($license, 'status') != 'valid') {
                $submenu['wpsocialninja.php']['activate_license'] = array(
                    '<span style="color:#f39c12;">Activate License</span>',
                    $permission,
                    'admin.php?page=wpsocialninja.php#/settings/license-management',
                );
            }
        }

        $submenu['wpsocialninja.php']['platforms'] = array(
            __('Platforms', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/',
        );

        $submenu['wpsocialninja.php']['reviews'] = array(
            __('Reviews', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/reviews',
        );
        $submenu['wpsocialninja.php']['testimonials'] = array(
            __('Testimonials', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/testimonials',
        );
        $submenu['wpsocialninja.php']['templates'] = array(
            __('Templates', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/templates',
        );
        $submenu['wpsocialninja.php']['notification_templates'] = array(
            __('Notification Popups', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/notifications',
        );
        $submenu['wpsocialninja.php']['chat_widgets'] = array(
            __('Chat Widgets', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/chat-widgets',
        );
        if (!defined('WPSOCIALREVIEWS_PRO')) {
            $submenu['wpsocialninja.php']['upgrade_to_pro'] = array(
                '<span style="color: #f9e112;">Upgrade To Pro</span>',
                $permission,
                'https://wpsocialninja.com/?utm_source=wp_site&utm_medium=plugin&utm_campaign=upgrade',
            );
        }
        $submenu['wpsocialninja.php']['settings'] = array(
            __('Settings', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/settings/twitter-settings',
        );
        $submenu['wpsocialninja.php']['tools'] = array(
            __('Tools', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/tools/export-reviews',
        );
        $submenu['wpsocialninja.php']['support'] = array(
            __('Support', 'wp-social-reviews'),
            $permission,
            'admin.php?page=wpsocialninja.php#/support',
        );
    }

    /**
     *
     * 3rd party developer can render admin app from here
     * @return string
     * @since 1.0.0
     *
     **/
    public function render()
    {
        echo "<div id='wpsocialreviewsapp'></div>";
        $this->checkForDbMigration();
    }

    public function checkForDbMigration()
    {
        $older_version = get_option('_wp_social_ninja_version', '3.5.0');
        if (version_compare($older_version, '3.6.1', '<=')) {
            (new ActivationHandler)->handle();
        }
    }

    /**
     *
     * SVG icon for menu
     * @return string
     * @since 1.0.0
     *
     **/
    public function getIcon()
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65.69 68.73"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M65.69,32.84A32.89,32.89,0,1,0,53.1,58.68l1.59.35c4.31.93,8.18,6.32,11,9.7V33.06h0C65.68,33,65.69,32.92,65.69,32.84ZM48.2,30.08l-5.83,6s0,.06,0,.11l1.41,8.43a3.3,3.3,0,0,1-.4,2.68,1.62,1.62,0,0,1-1.33.58,4,4,0,0,1-1.81-.55l-7.22-4a.14.14,0,0,0-.13,0l-7.23,4a3.89,3.89,0,0,1-1.83.56,1.65,1.65,0,0,1-1.34-.58A3.51,3.51,0,0,1,22,44.62l1.36-8.43s0-.08,0-.11l-5.84-5.89s0-.05-.05-.05h0c-.93-1-1.33-1.95-1.06-2.76a2.74,2.74,0,0,1,2.45-1.59l8.07-1.26a.35.35,0,0,0,.11-.08l3.6-7.67c.61-1.26,1.38-2,2.21-2s1.62.7,2.21,2l3.63,7.64c0,.06,0,.08.1.08l8.08,1.2a2.78,2.78,0,0,1,2.45,1.59A2.93,2.93,0,0,1,48.2,30.08Z"/></g></g></svg>';
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     *
     * Enqueue all js file which are needed for admin side
     * @since 1.0.0
     *
     **/
    public function enqueueAssets()
    {
        if (isset($_GET['page']) && $_GET['page'] == 'wpsocialninja.php') {
            $app = App::getInstance();

            add_action('wp_print_scripts', function () {
                $isSkip = apply_filters('wpsr_skip_no_conflict', false);

                if ($isSkip) {
                    return;
                }

                global $wp_scripts;
                if (!$wp_scripts) {
                    return;
                }

                $themeUrl = content_url('themes');
                $pluginUrl = plugins_url();
                foreach ($wp_scripts->queue as $script) {
                    if (empty($wp_scripts->registered[$script])) {
                        continue;
                    }

                    $src = $wp_scripts->registered[$script]->src;
                    $isMatched = strpos($src, $pluginUrl) !== false && !strpos($src, 'wp-social') !== false;
                    if (!$isMatched) {
                        continue;
                    }
                    wp_dequeue_script($wp_scripts->registered[$script]->handle);
                }

            }, 1);

            if (function_exists('wp_enqueue_editor')) {
                wp_enqueue_editor();
                wp_enqueue_script('thickbox');
            }

            if (function_exists('wp_enqueue_media')) {
                add_filter('user_can_richedit', '__return_true');
                wp_enqueue_media();
            }

            wp_enqueue_script('wpsocialreviews_boot', WPSOCIALREVIEWS_URL . 'assets/js/social-review-boot.js',
                array('jquery'), WPSOCIALREVIEWS_VERSION, true);
            // 3rd party developers can now add their scripts here
            do_action('wpsocialreviews/booting_admin_app');
            wp_enqueue_script('wpsocialreviews_admin_app', WPSOCIALREVIEWS_URL . 'assets/js/social-review-admin.js',
                array('wpsocialreviews_boot'), WPSOCIALREVIEWS_VERSION, true);

            wp_enqueue_script('jquery-masonry');
            wp_enqueue_script('imagesloaded');

            wp_enqueue_style('wpsocialreviews_admin_app', WPSOCIALREVIEWS_URL . 'assets/css/social-review-admin.css',
                array(), WPSOCIALREVIEWS_VERSION);

            $wpsocialreviewsAdminVars = apply_filters('wpsocialreviews/admin_app_vars', array(
                'i18n'                    => array(
                    'All Collections' => __('All Collections', 'wp-social-reviews')
                ),
                'wpsr_admin_nonce'        => wp_create_nonce('wpsr_admin_nonce'),
                'assets_url'              => WPSOCIALREVIEWS_URL . 'assets',
                'has_pro'                 => defined('WPSOCIALREVIEWS_PRO') && WPSOCIALREVIEWS_PRO,
                'ajaxurl'                 => admin_url('admin-ajax.php'),
                'custom_image_upload_url' => admin_url('admin-ajax.php?action=wpsr_upload_image'),
                'twitter_authorize_url'   => 'https://wpsocialninja.com/api/twitter/process.php?return_url=' . admin_url('admin.php?page=wpsocialninja.php'),
                'admin_page_url'          => admin_url('admin.php?page=wpsocialninja.php'),
                'admin_url'               => admin_url('admin.php'),
                'slug'                    => $slug = $app->config->get('app.slug'),
                'nonce'                   => wp_create_nonce($slug),
                'rest'                    => $this->getRestInfo($app),
                'has_fluent_form'         => defined('FLUENTFORM_VERSION'),
                'brand_icons'             => [
                    'facebook'     => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-facebook-small.png',
                    'google'       => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-google-small.png',
                    'twitter'      => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-twitter.png',
                    'instagram'    => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-instagram-small.png',
                    'youtube'      => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-youtube.png',
                    'airbnb'       => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-airbnb-small.png',
                    'yelp'         => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-yelp-small.png',
                    'tripadvisor'  => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-tripadvisor-small.png',
                    'amazon'       => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-amazon-small.png',
                    'aliexpress'   => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-aliexpress-small.png',
                    'booking.com'  => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-booking.com-small.png',
                    'fluent_forms' => WPSOCIALREVIEWS_URL . 'assets/images/icon/fluentform.png',
                    'woocommerce'  => WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-woocommerce-small.png',
                    'custom'       => WPSOCIALREVIEWS_URL . 'assets/images/icon/wp-social-icon.png',
                    'testimonial'       => WPSOCIALREVIEWS_URL . 'assets/images/icon/testimonial-icon-small.png',
                ],
                'tp_slug'                 => '_not_defined_yet_',
                'tp_title'                 => ' ',
            ));

            $wpsocialreviewsAdminVars['platforms_cards'] = $this->getPlatformsInfo();
            $wpsocialreviewsAdminVars['reviews_settings_platforms'] = $this->getReviewsSettingsMenu();

            wp_localize_script('wpsocialreviews_boot', 'WPSocialReviewsAdmin', $wpsocialreviewsAdminVars);
        }
    }

    protected function getRestInfo($app)
    {
        $ns = $app->config->get('app.rest_namespace');
        $v = $app->config->get('app.rest_version');

        return [
            'base_url'  => esc_url_raw(rest_url()),
            'url'       => rest_url($ns . '/' . $v),
            'nonce'     => wp_create_nonce('wp_rest'),
            'namespace' => $ns,
            'version'   => $v,
        ];
    }

    private function getPlatformsInfo()
    {
        $assetBase = WPSOCIALREVIEWS_URL . 'assets/images/icon/';
        $promoteBase = WPSOCIALREVIEWS_URL . 'assets/images/promotion/';

        return apply_filters('wpsocialreviews/platforms_info', [
            [
                'id'                 => 1,
                'platform'           => 'google',
                'image'              => $assetBase . 'icon-google-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => 'https://developers.google.com/places/web-service/get-api-key',
                'sourceUrl'          => 'https://developers.google.com/places/place-id',
                'exampleURL'         => '',
                'count'              => 0,
                'docs'               => 'https://wpsocialninja.com/docs/google-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
            ],
            [
                'id'                 => 2,
                'platform'           => 'airbnb',
                'image'              => $assetBase . 'icon-airbnb-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => '',
                'sourceUrl'          => '',
                'exampleURL'         => 'https://www.airbnb.com/rooms/48837541',
                'count'              => 0,
                'docs'               => 'https://wpsocialninja.com/docs/airbnb-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'experiences'        => false,
                'promotion'          => [
                    'title' => __('Airbnb Reviews', 'wp-social-reviews'),
                    'description' => __('Display Airbnb reviews & engage with your customers post purchasing to hook your site visitors instantly.', 'wp-social-reviews'),
                    'img' => $promoteBase . 'airbnb.png',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 3,
                'platform'           => 'yelp',
                'image'              => $assetBase . 'icon-yelp-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => 'https://www.yelp.com/developers/v3/manage_app',
                'sourceUrl'          => 'https://www.yelp.com',
                'exampleURL'         => '',
                'count'              => 0,
                'docs'               => 'https://wpsocialninja.com/docs/yelp-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('Yelp Reviews', 'wp-social-reviews'),
                    'description' => __('Display Yelp reviews on your website & take on board your potential customers to kickstart your business.', 'wp-social-reviews'),
                    'video' => 'https://www.youtube.com/embed/QCjc7oagmGA',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 5,
                'platform'           => 'tripadvisor',
                'image'              => $assetBase . 'icon-tripadvisor-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => '#',
                'sourceUrl'          => '#',
                'exampleURL'         => 'https://www.tripadvisor.com/Attraction_Review-g2368232-d10238477-Reviews-Nilachal-Bandarban_Chittagong_Division.html',
                'docs'               => 'https://wpsocialninja.com/docs/tripadvisor-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('Tripadvisor Reviews', 'wp-social-reviews'),
                    'description' => __('Add Tripadvisor reviews anywhere on your website to improve your brand’s social media marketing.', 'wp-social-reviews'),
                    'img' => $promoteBase . 'tripadvisor.png',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 6,
                'platform'           => 'amazon',
                'image'              => $assetBase . 'icon-amazon-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => '#',
                'sourceUrl'          => '#',
                'exampleURL'         => 'https://www.amazon.com/Oculus-Rift-PC-Powered-Gaming-Headset-pc/dp/B07PTMKYS7/',
                'docs'               => 'https://wpsocialninja.com/docs/amazon-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('Amazon Reviews', 'wp-social-reviews'),
                    'description' => __('Fetch & exhibit Amazon reviews on your website & reach out to larger audiences for better brand exposure.', 'wp-social-reviews'),
                    'video' => 'https://www.youtube.com/embed/9LOgzpxQ_NM',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 7,
                'platform'           => 'aliexpress',
                'image'              => $assetBase . 'icon-aliexpress-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => '#',
                'sourceUrl'          => '#',
                'exampleURL'         => 'https://www.aliexpress.com/item/1005002637989036.html',
                'docs'               => 'https://wpsocialninja.com/docs/aliexpress-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('AliExpress Reviews', 'wp-social-reviews'),
                    'description' => __('Show the best AliExpress reviews on your website to promote your brand with a detailed customization option.', 'wp-social-reviews'),
                    'video' => 'https://www.youtube.com/embed/uWeALyqO42I',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 8,
                'platform'           => 'booking.com',
                'image'              => $assetBase . 'icon-booking.com-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Place',
                'apiUrl'             => '#',
                'sourceUrl'          => '#',
                'exampleURL'         => 'https://www.booking.com/hotel/it/restart-accomodations-rome.en-gb.html',
                'docs'               => 'https://wpsocialninja.com/docs/booking-com-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('Booking.com Reviews', 'wp-social-reviews'),
                    'description' => __('Fetch & display your Booking.com reviews to connect with your audiences without wasting any time.', 'wp-social-reviews'),
                    'img' => $promoteBase . 'booking.png',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ],
            [
                'id'                 => 9,
                'platform'           => 'facebook',
                'image'              => $assetBase . 'icon-facebook-small.png',
                'apiKey'             => '',
                'sourceId'           => '',
                'message'            => '',
                'reviewsinfo'        => [],
                'sourceText'         => 'Page',
                'apiUrl'             => '#',
                'sourceUrl'          => '#',
                'exampleURL'         => '',
                'count'              => 0,
                'docs'               => 'https://wpsocialninja.com/docs/facebook-configuration-social-reviews-wp-social-ninja/',
                'privacy'            => 'https://wpsocialninja.com/privacy-policy/',
                'termsAndConditions' => 'https://wpsocialninja.com/terms-conditions/',
                'promotion'          => [
                    'title' => __('Facebook Reviews', 'wp-social-reviews'),
                    'description' => __('Showcase Facebook reviews on your WordPress website & prove your business credibility to another level.', 'wp-social-reviews'),
                    'video' => 'https://www.youtube.com/embed/88yM4eACxLU',
                    'proPurchaseUrl' => 'https://wpsocialninja.com/?utm_source=wp_site&amp;utm_medium=plugin&amp;utm_campaign=upgrade',
                    'features' => $this->reviewsFeatureList()
                ]
            ]
        ]);
    }

    private function reviewsFeatureList()
    {
        return [
            __('Grid/Slider/Masonry/Badge layout variation', 'wp-social-reviews'),
            __('9+ templates', 'wp-social-reviews'),
            __('Connect multiple businesses', 'wp-social-reviews'),
            __('Combine multiple platform', 'wp-social-reviews'),
            __('Popular page builder widget ready', 'wp-social-reviews'),
            __('Shortcode integration', 'wp-social-reviews'),
            __('Responsive query', 'wp-social-reviews'),
            __('Filter by minimum rating', 'wp-social-reviews'),
            __('Include/exclude specific reviews', 'wp-social-reviews'),
            __('Extensive Style Option', 'wp-social-reviews'),
            __('Automatically syncing reviews', 'wp-social-reviews'),
            __('Manually syncing reviews', 'wp-social-reviews'),
            __('Shorten longer reviews', 'wp-social-reviews'),
            __('In-depth header settings', 'wp-social-reviews'),
            __('Call to Action button', 'wp-social-reviews'),
            __('Schema snippet', 'wp-social-reviews'),
            __('Ajax Load More Pagination', 'wp-social-reviews'),
        ];
    }

    private function getReviewsSettingsMenu()
    {
        $assetBase = WPSOCIALREVIEWS_URL . 'assets/images/icon/';

        return apply_filters('wpsocialreviews/settings_review_platforms', [
            [
                'route' => 'google-settings',
                'title' => 'Google My Business Settings',
                'icon'  => $assetBase . 'icon-google-small.png'
            ],
            [
                'route' => 'airbnb-settings',
                'title' => 'Airbnb Settings',
                'icon'  => $assetBase . 'icon-airbnb-small.png'
            ],
            [
                'route' => 'tripadvisor-settings',
                'title' => 'Tripadvisor Settings',
                'icon'  => $assetBase . 'icon-tripadvisor-small.png'
            ],
            [
                'route' => 'amazon-settings',
                'title' => 'Amazon Settings',
                'icon'  => $assetBase . 'icon-amazon-small.png'
            ],
            [
                'route' => 'aliexpress-settings',
                'title' => 'AliExpress Settings',
                'icon'  => $assetBase . 'icon-aliexpress-small.png'
            ],
            [
                'route' => 'booking.com-settings',
                'title' => 'Booking.com Settings',
                'icon'  => $assetBase . 'icon-booking.com-small.png'
            ],
            [
                'route' => 'yelp-settings',
                'title' => 'Yelp Settings',
                'icon'  => $assetBase . 'icon-yelp-small.png'
            ],
            [
                'route' => 'facebook-settings',
                'title' => 'Facebook Settings',
                'icon'  => $assetBase . 'icon-facebook-small.png'
            ],
            [
                'route' => 'fluent-forms-settings',
                'title' => 'Fluent Forms Settings',
                'icon'  => $assetBase . 'fluentform.png'
            ]
        ]);
    }
}
