<?php
namespace WPSocialReviews\App\Services\Widgets\Oxygen;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Widgets\Helper;

class FacebookWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "Facebook Feeds", 'wp-social-reviews' );
    }

    function slug() {
        return "facebook_widget";
    }

    function accordion_button_place() {
        return "facebook";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * template list
         *****************************/
        $platforms = ['facebook_feed'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_facebook',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header
         *****************************/
        $fb_header_section = $this->addControlSection( "wpsr_fb_header_section", __("Header", "wp-social-reviews"), "assets/icon.png", $this );

        /*****************************
         * Header username
         *****************************/
        $fb_header_un = $fb_header_section->addControlSection( "wpsr_fb_header_username_section", __("Username", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_header_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header description
         *****************************/
        $fb_header_des = $fb_header_section->addControlSection( "wpsr_fb_header_des_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_header_des->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header statistics
         *****************************/
        $fb_header_stat = $fb_header_section->addControlSection( "wpsr_fb_header_stat_section", __("Likes Counter", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_header_stat->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header Box
         *****************************/
        $fb_header_box = $fb_header_section->addControlSection( "wpsr_fb_header_box_section", __("Box", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_header_box->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper',
                    "property" 			=> 'background-color'
                )
            )
        );

        $fb_header_box->addPreset(
            "padding",
            "wpsr_fb_header_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper'
        )->whiteList();

        $fb_header_box->addPreset(
            "margin",
            "wpsr_fb_header_box_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper'
        )->whiteList();

        $fb_header_box->addPreset(
            "border",
            "wpsr_fb_header_box_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper'
        )->whiteList();

        $fb_header_box->addPreset(
            "border-radius",
            "wpsr_fb_header_box_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper'
        )->whiteList();


        /*****************************
         * Content
         *****************************/
        $fb_content_section = $this->addControlSection( "wpsr_fb_content_section", __("Content", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_content_section->typographySection( __('Typography'), '.wpsr-fb-feed-item .wpsr-fb-feed-content', $this );
        $fb_content_section->addPreset(
            "padding",
            "wpsr_ig_content_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-fb-feed-item .wpsr-fb-feed-content'
        )->whiteList();

        $fb_author_section = $fb_content_section->addControlSection( "wpsr_fb_author_section", __("Author", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_author_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        $fb_date_section = $fb_content_section->addControlSection( "wpsr_fb_date_section", __("Date", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_date_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        $fb_post_title_section = $fb_content_section->addControlSection( "wpsr_fb_post_title_section", __("Post Title", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_post_title_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        $fb_summary_un = $fb_content_section->addControlSection( "wpsr_fb_summary_section", __("Summary Card", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_summary_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Domain Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Domain Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Domain Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Domain Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Domain Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );
        $fb_summary_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Title Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Title Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Title Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Title Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Title Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );
        $fb_summary_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Description Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Description Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Description Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Description Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Description Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         *like/share btn
         *****************************/
        $fb_likes_share_section = $this->addControlSection( "wpsr_fb_follow_share_section", __("Like/Share Button", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_likes_share_section_fz = $fb_likes_share_section->addStyleControl(
            array(
                "name" 				=> __('Font Size', "wp-social-reviews"),
                "selector" 			=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                "property" 			=> 'font-size',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $fb_likes_share_section_fz->setRange('5', '100', '1');
        $fb_likes_share_section_fz->setUnits('px', 'px,%,em');

        $fb_likes_share_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                    "property" 			=> 'color'
                )
            )
        );
        $fb_likes_share_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                    "property" 			=> 'background-color'
                )
            )
        );
        $fb_likes_share_section->addPreset(
            "padding",
            "wpsr_ig_header_fb_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a'
        )->whiteList();

        $fb_likes_share_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Icon Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a svg',
                    "property" 			=> 'height',
                ),
                array(
                    "name" 				=> __('Icon Width', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a svg',
                    "property" 			=> 'width',
                ),
            )
        );

        /*****************************
         * Pagination
         *****************************/
        $pagination_section = $this->addControlSection( "wpsr_fb_pagination_section", __("Pagination", "wp-social-reviews"), "assets/icon.png", $this );
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

        $pagination_section_border = $pagination_section->addControlSection( "wpsr_fb_pagination_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
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
        $fb_box_section = $this->addControlSection( "wpsr_fb_box_section", __("Item Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-fb-feed-item .wpsr-fb-feed-inner';
        $fb_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> $selector,
                    "property" 			=> 'background-color'
                )
            )
        );
        $fb_box_sp = $fb_box_section->addControlSection( "wpsr_fb_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_box_sp->addPreset(
            "padding",
            "fb_box_padding",
            __("Padding", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $fb_box_sp->addPreset(
            "margin",
            "fb_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $fb_box_border = $fb_box_section->addControlSection( "wpsr_fb_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $fb_box_border->addPreset(
            "border",
            "fb_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $fb_box_border->addPreset(
            "border-radius",
            "fb_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            $selector
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_facebook'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }

        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_facebook'] .'" platform="facebook_feed"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_facebook'] .'" platform="facebook_feed"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();
        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_fb',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_fb.css',
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
new FacebookWidget();