<?php
namespace WPSocialReviews\App\Services\Widgets\Oxygen;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Widgets\Helper;

class YouTubeWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "YouTube Feeds", 'wp-social-reviews' );
    }

    function slug() {
        return "youtube_widget";
    }

    function accordion_button_place() {
        return "youtube";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * template list
         *****************************/
        $platforms = ['youtube'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_youtube',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header
         *****************************/
        $yt_header_section = $this->addControlSection( "wpsr_yt_header_section", __("Header", "wp-social-reviews"), "assets/icon.png", $this );

        /*****************************
         * Header Channel Name
         *****************************/
        $yt_header_cn = $yt_header_section->addControlSection( "wpsr_yt_header_cn_section", __("Channel Name", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_header_cn->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-name',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header statistics
         *****************************/
        $yt_header_stat = $yt_header_section->addControlSection( "wpsr_yt_header_stat_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_header_stat->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header description
         *****************************/
        $yt_header_des = $yt_header_section->addControlSection( "wpsr_yt_header_des_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_header_des->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header follow btn
         *****************************/
        $yt_header_fb = $yt_header_section->addControlSection( "wpsr_yt_header_fb_section", __("Subscribe Button", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_header_fb_fz = $yt_header_fb->addStyleControl(
            array(
                "name" 				=> __('Font Size', "wp-social-reviews"),
                "selector" 			=> '.wpsr-yt-header-subscribe-btn a',
                "property" 			=> 'font-size',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $yt_header_fb_fz->setRange('5', '100', '1');
        $yt_header_fb_fz->setUnits('px', 'px,%,em');
        $yt_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-yt-header-subscribe-btn a',
                    "property" 			=> 'color'
                )
            )
        );
        $yt_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-yt-header-subscribe-btn a',
                    "property" 			=> 'background-color'
                )
            )
        );
        $yt_header_fb->addPreset(
            "padding",
            "wpsr_yt_header_fb_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-yt-header-subscribe-btn a'
        )->whiteList();

        $yt_header_fb->addPreset(
            "border",
            "wpsr_yt_header_fb_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-yt-header-subscribe-btn a'
        )->whiteList();
        $yt_header_fb->addPreset(
            "border-radius",
            "wpsr_yt_header_fb_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-yt-header-subscribe-btn a'
        )->whiteList();

        /*****************************
         * Header Box
         *****************************/
        $yt_header_box = $yt_header_section->addControlSection( "wpsr_yt_header_box_section", __("Box", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_header_box->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-yt-header .wpsr-yt-header-inner',
                    "property" 			=> 'background-color'
                )
            )
        );

        $yt_header_box->addPreset(
            "padding",
            "wpsr_yt_header_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-yt-header .wpsr-yt-header-inner'
        )->whiteList();

        $yt_header_box->addPreset(
            "margin",
            "wpsr_yt_header_box_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-yt-header .wpsr-yt-header-inner'
        )->whiteList();

        $yt_header_box->addPreset(
            "border",
            "wpsr_yt_header_box_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-yt-header .wpsr-yt-header-inner'
        )->whiteList();

        $yt_header_box->addPreset(
            "border-radius",
            "wpsr_yt_header_box_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-yt-header .wpsr-yt-header-inner'
        )->whiteList();

        /*****************************
         * Title
         *****************************/
        $yt_title_section = $this->addControlSection( "wpsr_yt_title_section", __("Title", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_title_section->typographySection( __('Typography'), '.wpsr-yt-video-info h3, .wpsr-yt-video-info h3 a', $this );
        $yt_title_section->addPreset(
            "padding",
            "wpsr_yt_title_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-yt-video-info h3 a'
        )->whiteList();

        /*****************************
         * Statistics
         *****************************/
        $yt_statistics_section = $this->addControlSection( "wpsr_yt_statistics_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_statistics_section->typographySection( __('Typography'), '.wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item', $this );

        $yt_statistics_section->addPreset(
            "margin",
            "wpsr_yt_statistics_margin",
            __("Margin", "wp-social-reviews"),
            '.wpsr-yt-video-statistic-item'
        )->whiteList();

        /*****************************
         * description
         *****************************/
        $yt_des_section = $this->addControlSection( "wpsr_yt_description_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_des_section->typographySection( __('Typography'), '.wpsr-yt-video-description', $this );
        $yt_des_section->addPreset(
            "padding",
            "wpsr_yt_description_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-yt-video-description'
        )->whiteList();

        /*****************************
         * Pagination
         *****************************/
        $pagination_section = $this->addControlSection( "wpsr_ig_pagination_section", __("Pagination", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section->typographySection( __('Typography'), '.wpsr_more', $this );
        $pagination_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=>  '.wpsr_more',
                    "property" 			=> 'background-color'
                )
            )
        );

        $pagination_section->addPreset(
            "padding",
            "wpsr_ig_pagination_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section->addPreset(
            "margin",
            "wpsr_ig_pagination_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border = $pagination_section->addControlSection( "wpsr_ig_pagination_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section_border->addPreset(
            "border",
            "wpsr_ig_pagination_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border->addPreset(
            "border-radius",
            "wpsr_ig_pagination_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();
        
        /*****************************
         * Box
         *****************************/
        $yt_box_section = $this->addControlSection( "wpsr_yt_box_section", __("Item Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-yt-video';
        $yt_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-yt-video-info',
                    "property" 			=> 'background-color'
                )
            )
        );
        $yt_box_sp = $yt_box_section->addControlSection( "wpsr_yt_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_box_sp->addPreset(
            "padding",
            "yt_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-yt-video .wpsr-yt-video-info'
        )->whiteList();

        $yt_box_sp->addPreset(
            "margin",
            "yt_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $yt_box_border = $yt_box_section->addControlSection( "wpsr_yt_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $yt_box_border->addPreset(
            "border",
            "yt_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $yt_box_border->addPreset(
            "border-radius",
            "yt_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-yt-video, .wpsr-yt-video-info'
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_youtube'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }

        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_youtube'] .'" platform="youtube"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_youtube'] .'" platform="youtube"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();
        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_yt',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_yt.css',
                array(),
                WPSOCIALREVIEWS_VERSION
            );
            wp_enqueue_script('wp-social-review');
            $shortcodeHandler = new ShortcodeHandler();
            add_action('wp_footer', array($shortcodeHandler, 'loadLocalizeScripts'), 99);
            add_action('wp_footer', array($shortcodeHandler, 'localizePopupScripts'), 99);

            if(defined('WPSOCIALREVIEWS_PRO')){
                wp_enqueue_style(
                    'swiper',
                    WPSOCIALREVIEWS_PRO_URL . 'assets/libs/swiper/swiper-bundle.min.css',
                    array(),
                    WPSOCIALREVIEWS_VERSION
                );
            }
        }
    }

    function enablePresets() {
        return true;
    }

    function enableFullPresets() {
        return true;
    }

    function customCSS( $options, $selector ) {

    }
}
new YouTubeWidget();