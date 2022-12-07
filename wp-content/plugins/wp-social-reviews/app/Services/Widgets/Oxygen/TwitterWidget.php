<?php
namespace WPSocialReviews\App\Services\Widgets\Oxygen;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Widgets\Helper;

class TwitterWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "Twitter Feeds", 'wp-social-reviews' );
    }

    function slug() {
        return "twitter_widget";
    }

    function accordion_button_place() {
        return "twitter";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * template list
         *****************************/
        $platforms = ['twitter'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_twitter',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header
         *****************************/
        $tw_header_section = $this->addControlSection( "wpsr_tw_header_section", __("Header", "wp-social-reviews"), "assets/icon.png", $this );

        /*****************************
         * Header fullname
         *****************************/
        $tw_header_fn = $tw_header_section->addControlSection( "wpsr_tw_header_fullname_section", __("Fullname", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_fn->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header username
         *****************************/
        $tw_header_un = $tw_header_section->addControlSection( "wpsr_tw_header_username_section", __("Username", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header description
         *****************************/
        $tw_header_des = $tw_header_section->addControlSection( "wpsr_tw_header_des_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_des->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Link Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header location
         *****************************/
        $tw_header_location = $tw_header_section->addControlSection( "wpsr_tw_header_location_section", __("Location", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_location->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header statistics
         *****************************/
        $tw_header_stat = $tw_header_section->addControlSection( "wpsr_tw_header_stat_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_stat->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Number Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Spacing Between Item', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item',
                    "property" 			=> 'margin-right',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                ),
                array(
                    "name" 				=> __('Top Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics',
                    "property" 			=> 'margin-top',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );


        /*****************************
         * Header follow btn
         *****************************/
        $tw_header_fb = $tw_header_section->addControlSection( "wpsr_tw_header_fb_section", __("Follow Button", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_fb_fz = $tw_header_fb->addStyleControl(
            array(
                "name" 				=> __('Font Size', "wp-social-reviews"),
                "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn',
                "property" 			=> 'font-size',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $tw_header_fb_fz->setRange('5', '100', '1');
        $tw_header_fb_fz->setUnits('px', 'px,%,em');
        $tw_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn',
                    "property" 			=> 'color'
                )
            )
        );
        $tw_header_fb->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn',
                    "property" 			=> 'background-color'
                )
            )
        );
        $tw_header_fb->addPreset(
            "padding",
            "wpsr_tw_header_fb_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn'
        )->whiteList();
        $tw_header_fb->addPreset(
            "border",
            "wpsr_tw_header_fb_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn'
        )->whiteList();
        $tw_header_fb->addPreset(
            "border-radius",
            "wpsr_tw_header_fb_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn'
        )->whiteList();

        /*****************************
         * Header Box
         *****************************/
        $tw_header_box = $tw_header_section->addControlSection( "wpsr_tw_header_box_section", __("Box", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_header_box->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper',
                    "property" 			=> 'background-color'
                )
            )
        );
        $tw_header_box->addPreset(
            "padding",
            "wpsr_tw_header_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper'
        )->whiteList();
        $tw_header_box->addPreset(
            "margin",
            "wpsr_tw_header_box_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper'
        )->whiteList();
        $tw_header_box->addPreset(
            "border",
            "wpsr_tw_header_box_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper'
        )->whiteList();
        $tw_header_box->addPreset(
            "border-radius",
            "wpsr_tw_header_box_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper'
        )->whiteList();

        /*****************************
         * Name
         *****************************/
        $tw_name_section = $this->addControlSection( "wpsr_tw_name_section", __("Name", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_name_section->typographySection( __('Typography'), '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name', $this );
        $tw_name_section->addPreset(
            "padding",
            "wpsr_tw_name_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name'
        )->whiteList();

        /*****************************
         * Meta
         *****************************/
        $tw_meta_section = $this->addControlSection( "wpsr_tw_meta_section", __("Meta", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_meta_section->typographySection( __('Typography'), '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-author-username-time a', $this );
        $tw_meta_gap = $tw_meta_section->addStyleControl(
            array(
                "name" 				=> __('Spacing Between Item', "wp-social-reviews"),
                "selector" 			=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-author-username-time a.wpsr-tweet-time',
                "property" 			=> 'padding-left',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $tw_meta_gap->setRange('5', '100', '1');
        $tw_meta_gap->setUnits('px', 'px,%,em');

        $tw_meta_section->addPreset(
            "padding",
            "wpsr_tw_meta_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-author-username-time a'
        )->whiteList();

        /*****************************
         * description
         *****************************/
        $tw_des_section = $this->addControlSection( "wpsr_tw_description_section", __("Content", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_des_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Hashtag Color', 'wp-social-reviews'),
                    "selector" 			=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p a',
                    "property" 			=> 'color'
                )
            )
        );
        $tw_des_section->typographySection( __('Typography'), '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p', $this );
        $tw_des_section->addPreset(
            "padding",
            "wpsr_tw_description_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p'
        )->whiteList();


        /*****************************
         * Actions
         *****************************/
        $tw_actions_section = $this->addControlSection( "wpsr_tw_actions_section", __("Actions", "wp-social-reviews"), "assets/icon.png", $this );

        $tw_actions_typo = $tw_actions_section->addControlSection( "wpsr_tw_actions_typo", __("Typography", "p-social-reviews"), "assets/icon.png", $this );
        $tw_actions_typo->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color'),
                    "selector" 			=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a',
                    "property" 			=> 'color'
                ),
                array(
                    "name" 				=> __('Font Size'),
                    "selector" 			=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a',
                    'control_type' 		=> 'slider-measurebox',
                    "property" 			=> 'font-size',
                    'unit' 			=> 'px',
                    'min' 				=> 5,
                    'max' 				=> 100
                )
            )
        );


        $tw_actions_gap = $tw_actions_section->addStyleControl(
            array(
                "name" 				=> __('Spacing Between Item', "wp-social-reviews"),
                "selector" 			=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a',
                "property" 			=> 'margin-right',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $tw_actions_gap->setRange('5', '100', '1');
        $tw_actions_gap->setUnits('px', 'px,%,em');

        $tw_actions_section->addPreset(
            "margin",
            "wpsr_tw_actions_margin",
            __("Margin", "wp-social-reviews"),
            '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions'
        )->whiteList();

        /*****************************
         * Pagination
         *****************************/
        $pagination_section = $this->addControlSection( "wpsr_tw_pagination_section", __("Pagination", "wp-social-reviews"), "assets/icon.png", $this );
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
            "wpsr_tw_pagination_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section->addPreset(
            "margin",
            "wpsr_tw_pagination_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border = $pagination_section->addControlSection( "wpsr_tw_pagination_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section_border->addPreset(
            "border",
            "wpsr_tw_pagination_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border->addPreset(
            "border-radius",
            "wpsr_tw_pagination_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        /*****************************
         * Box
         *****************************/
        $tw_box_section = $this->addControlSection( "wpsr_tw_box_section", __("Item Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-twitter-feed-wrapper .wpsr-twitter-tweet';
        $tw_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> $selector,
                    "property" 			=> 'background-color'
                )
            )
        );
        $tw_box_sp = $tw_box_section->addControlSection( "wpsr_tw_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_box_sp->addPreset(
            "padding",
            "tw_box_padding",
            __("Padding", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tw_box_sp->addPreset(
            "margin",
            "tw_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tw_box_border = $tw_box_section->addControlSection( "wpsr_tw_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $tw_box_border->addPreset(
            "border",
            "tw_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tw_box_border->addPreset(
            "border-radius",
            "tw_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            $selector
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_twitter'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }

        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_twitter'] .'" platform="twitter"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_twitter'] .'" platform="twitter"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();
        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_tw',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tw.css',
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
new TwitterWidget();