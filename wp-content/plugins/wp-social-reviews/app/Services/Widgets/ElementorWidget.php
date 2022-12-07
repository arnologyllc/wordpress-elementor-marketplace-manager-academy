<?php

namespace WPSocialReviews\App\Services\Widgets;
use Elementor\Plugin as Elementor;

class ElementorWidget
{

    public function __construct()
    {
        add_action( 'elementor/widgets/register', array($this, 'init_widgets') );
        add_action( 'elementor/init', [ $this, 'elementor_init' ] );
    }

    public function elementor_init() {
        // Add element category in panel
        Elementor::instance()->elements_manager->add_category(
            'wp-social-reviews',
            [
                'title' => __( 'WP Social Ninja', 'wp-social-reviews' ),
                'icon' => 'font',
            ],
            1
        );
    }

    public function init_widgets()
    {
        $this->enqueueAssets();
        $widgets_manager = Elementor::instance()->widgets_manager;

        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/ReviewsWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/ReviewsWidget.php';
            $widgets_manager->register( new ReviewsWidget() );
        }

        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/YoutubeWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/YoutubeWidget.php';
            $widgets_manager->register( new YoutubeWidget() );
        }

        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/InstagramWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/InstagramWidget.php';
            $widgets_manager->register( new InstagramWidget() );
        }

        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/TwitterWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/TwitterWidget.php';
            $widgets_manager->register( new TwitterWidget() );
        }

        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/FacebookFeedWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/FacebookFeedWidget.php';
            $widgets_manager->register( new FacebookFeedWidget() );
        }
    }


    public function enqueueAssets()
    {
        wp_register_style(
            'wp_social_ninja_reviews',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_reviews.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_yt',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_yt.css',
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
            'wp_social_ninja_tw',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tw.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );

        wp_register_style(
            'wp_social_ninja_fb',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_fb.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );
    }
}
