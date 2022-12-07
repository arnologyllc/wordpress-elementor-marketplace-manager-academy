<?php

namespace WPSocialReviews\App\Services\Widgets\Beaver;

class BeaverWidget
{

    public function __construct()
    {
        add_action( 'init', array($this, 'setup_hooks') );
    }

    public function setup_hooks() {
        if ( ! class_exists( 'FLBuilder' ) ) {
            return;
        }

        // Load custom modules.
        $this->init_widgets();
    }

    public function init_widgets()
    {
        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Reviews/ReviewsWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Reviews/ReviewsWidget.php';
        }
        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/YouTube/YouTubeWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/YouTube/YouTubeWidget.php';
        }
        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Instagram/InstagramWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Instagram/InstagramWidget.php';
        }
        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Facebook/FacebookWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Facebook/FacebookWidget.php';
        }
        if ( file_exists( WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Twitter/TwitterWidget.php' ) ) {
            require_once WPSOCIALREVIEWS_DIR.'app/Services/Widgets/Beaver/Twitter/TwitterWidget.php';
        }
    }

}
