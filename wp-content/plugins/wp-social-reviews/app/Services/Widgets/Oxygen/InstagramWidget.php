<?php
namespace WPSocialReviews\App\Services\Widgets\Oxygen;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Widgets\Helper;

class InstagramWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "Instagram Feeds", 'wp-social-reviews' );
    }

    function slug() {
        return "instagram_widget";
    }

    function accordion_button_place() {
        return "instagram";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * template list
         *****************************/
        $platforms = ['instagram'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_instagram',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header
         *****************************/
        $ig_header_section = $this->addControlSection( "wpsr_ig_header_section", __("Header", "wp-social-reviews"), "assets/icon.png", $this );

        /*****************************
         * Header username
         *****************************/
        $ig_header_un = $ig_header_section->addControlSection( "wpsr_ig_header_username_section", __("Username", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_un->addStyleControls(
           array(
               array(
                   "name" 				=> __('Color', "wp-social-reviews"),
                   "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-name a',
                   "property" 			=> 'color',
               ),
               array(
                   "name" 				=> __('Font Size', "wp-social-reviews"),
                   "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-name a',
                   "property" 			=> 'font-size',
                   'control_type' 		=> 'slider-measurebox'
               ),
               array(
                   "name" 				=> __('Font Weight', "wp-social-reviews"),
                   "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-name a',
                   "property" 			=> 'font-weight',
               ),
               array(
                   "name" 				=> __('Line Height', "wp-social-reviews"),
                   "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-name a',
                   "property" 			=> 'line-height',
               ),
               array(
                   "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                   "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-name',
                   "property" 			=> 'margin-bottom',
                   "control_type" 		=> 'slider-measurebox',
                   'unit' 				=> 'px'
               )
           )
        );

        /*****************************
         * Header statistics
         *****************************/
        $ig_header_stat = $ig_header_section->addControlSection( "wpsr_ig_header_stat_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_stat->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Number Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item strong',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Spacing Between Item', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'margin-right',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header fullname
         *****************************/
        $ig_header_fn = $ig_header_section->addControlSection( "wpsr_ig_header_fullname_section", __("Fullname", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_fn->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header description
         *****************************/
        $ig_header_des = $ig_header_section->addControlSection( "wpsr_ig_header_des_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_des->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header follow btn
         *****************************/
        $ig_header_fb = $ig_header_section->addControlSection( "wpsr_ig_header_fb_section", __("Follow Button", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_fb_fz = $ig_header_fb->addStyleControl(
            array(
                "name" 				=> __('Font Size', "wp-social-reviews"),
                "selector" 			=> '.wpsr-ig-follow-btn a',
                "property" 			=> 'font-size',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $ig_header_fb_fz->setRange('5', '100', '1');
        $ig_header_fb_fz->setUnits('px', 'px,%,em');
        $ig_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-follow-btn a',
                    "property" 			=> 'color'
                )
            )
        );
        $ig_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-follow-btn a',
                    "property" 			=> 'background-color'
                )
            )
        );
        $ig_header_fb->addPreset(
            "padding",
            "wpsr_ig_header_fb_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-ig-follow-btn a'
        )->whiteList();

        $ig_header_fb->addPreset(
            "border",
            "wpsr_ig_header_fb_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-ig-follow-btn a'
        )->whiteList();
        $ig_header_fb->addPreset(
            "border-radius",
            "wpsr_ig_header_fb_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-ig-follow-btn a'
        )->whiteList();

        /*****************************
         * Header Box
         *****************************/
        $ig_header_box = $ig_header_section->addControlSection( "wpsr_ig_header_box_section", __("Box", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_header_box->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-header .wpsr-ig-header-inner',
                    "property" 			=> 'background-color'
                )
            )
        );

        $ig_header_box->addPreset(
            "padding",
            "wpsr_ig_header_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-ig-header .wpsr-ig-header-inner'
        )->whiteList();

        $ig_header_box->addPreset(
            "margin",
            "wpsr_ig_header_box_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-ig-header .wpsr-ig-header-inner'
        )->whiteList();

        $ig_header_box->addPreset(
            "border",
            "wpsr_ig_header_box_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-ig-header .wpsr-ig-header-inner'
        )->whiteList();

        $ig_header_box->addPreset(
            "border-radius",
            "wpsr_ig_header_box_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-ig-header .wpsr-ig-header-inner'
        )->whiteList();


        /*****************************
         * Content
         *****************************/
        $ig_content_section = $this->addControlSection( "wpsr_ig_content_section", __("Content", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_content_section->typographySection( __('Typography'), '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p', $this );
        $ig_content_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Hashtag Color', 'wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p a',
                    "property" 			=> 'color'
                )
            )
        );
        $ig_content_section->addPreset(
            "padding",
            "wpsr_ig_content_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p'
        )->whiteList();

        /*****************************
         * Statistics
         *****************************/
        $ig_statistics_section = $this->addControlSection( "wpsr_ig_statistics_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_statistics_section->typographySection( __('Typography'), '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span', $this );
        $ig_statistics_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', 'wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span',
                    "property" 			=> 'color'
                )
            )
        );
        $ig_statistics_gap = $ig_statistics_section->addStyleControl(
            array(
                "name" 				=> __('Spacing Between Item', "wp-social-reviews"),
                "selector" 			=> '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic',
                "property" 			=> 'margin-right',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $ig_statistics_gap->setRange('5', '100', '1');
        $ig_statistics_gap->setUnits('px', 'px,%,em');

        $ig_statistics_section->addPreset(
            "margin",
            "wpsr_ig_statistics_margin",
            __("Margin", "wp-social-reviews"),
            '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span'
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
        $ig_box_section = $this->addControlSection( "wpsr_ig_box_section", __("Item Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-ig-post';
        $ig_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-ig-post, .wpsr-ig-post .wpsr-ig-post-info',
                    "property" 			=> 'background-color'
                )
            )
        );
        $ig_box_sp = $ig_box_section->addControlSection( "wpsr_ig_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_box_sp->addPreset(
            "padding",
            "ig_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-ig-post .wpsr-ig-post-info'
        )->whiteList();

        $ig_box_sp->addPreset(
            "margin",
            "ig_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $ig_box_border = $ig_box_section->addControlSection( "wpsr_ig_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $ig_box_border->addPreset(
            "border",
            "ig_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $ig_box_border->addPreset(
            "border-radius",
            "ig_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            $selector
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_instagram'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }

        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_instagram'] .'" platform="instagram"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_instagram'] .'" platform="instagram"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();
        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_ig',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_ig.css',
                array(),
                WPSOCIALREVIEWS_VERSION
            );
            wp_enqueue_script('wp-social-review');
            add_action('wp_footer', array(new ShortcodeHandler(), 'loadLocalizeScripts'), 99);
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
new InstagramWidget();
