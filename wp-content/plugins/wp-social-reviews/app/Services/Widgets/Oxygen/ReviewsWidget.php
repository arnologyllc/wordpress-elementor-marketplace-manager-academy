<?php
namespace WPSocialReviews\App\Services\Widgets\Oxygen;
use WPSocialReviews\App\Services\Widgets\Helper;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;

class ReviewsWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "Social Reviews", 'wp-social-reviews' );
    }

    function slug() {
        return "reviews_widget";
    }

    function accordion_button_place() {
        return "reviews";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * Reviews template list
         *****************************/
        $platforms = ['twitter', 'youtube', 'instagram'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Reviews Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_reviews',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header/Business info
         *****************************/
        $bi_section = $this->addControlSection( "wpsr_bi_section", __("Business Info/Header", "wp-social-reviews"), "assets/icon.png", $this );
        $bi_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=>  '.wpsr-business-info',
                    "property" 			=> 'background-color'
                )
            )
        );

        /*****************************
         * Header/Business write a review btn
         *****************************/
        $review_bi_war_btn = $bi_section->addControlSection( "wpsr_review_bi_war_section", __("Write a review button", "wp-social-reviews"), "assets/icon.png", $this );
        $review_bi_war_btn->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-business-info .wpsr-business-info-right .wpsr-write-review',
                    "property" 			=> 'background-color'
                )
            )
        );
        $review_bi_war_btn->addPreset(
            "padding",
            "wpsr_reviews_bi_war_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-business-info .wpsr-business-info-right .wpsr-write-review'
        )->whiteList();


        $review_bi_sp = $bi_section->addControlSection( "wpsr_review_bi_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $review_bi_sp->addPreset(
            "padding",
            "wpsr_reviews_bi_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-business-info'
        )->whiteList();

        $review_bi_sp->addPreset(
            "margin",
            "wpsr_reviews_bi_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-business-info'
        )->whiteList();

        $review_bi_border = $bi_section->addControlSection( "wpsr_review_bi_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $review_bi_border->addPreset(
            "border",
            "wpsr_reviews_bi_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-business-info'
        )->whiteList();

        $review_bi_border->addPreset(
            "border-radius",
            "wpsr_reviews_bi_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-business-info'
        )->whiteList();

        /*****************************
         * Reviewer Name
         *****************************/
        $reviewer_name_section = $this->addControlSection( "wpsr_reviewer_name_section", __("Reviewer Name", "wp-social-reviews"), "assets/icon.png", $this );
        $reviewer_name_section->typographySection( __('Typography'), '.wpsr-review-template .wpsr-review-info a .wpsr-reviewer-name', $this );
        $reviewer_name_section->addPreset(
            "padding",
            "wpsr_reviewer_name_section_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-review-template .wpsr-review-info a .wpsr-reviewer-name'
        )->whiteList();

        /*****************************
         * Review Title
         *****************************/
        $review_title_section = $this->addControlSection( "wpsr_review_title_section", __("Review Title", "wp-social-reviews"), "assets/icon.png", $this );
        $review_title_section->typographySection( __('Typography'), '.wpsr-review-title', $this );
        $review_title_section->addPreset(
            "padding",
            "wpsr_review_title_section_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-review-title'
        )->whiteList();

        /*****************************
         * Review Date
         *****************************/
        $review_date_section = $this->addControlSection( "wpsr_review_date_section", __("Review Date", "wp-social-reviews"), "assets/icon.png", $this );
        $review_date_section->typographySection( __('Typography'), '.wpsr-review-template .wpsr-review-date', $this );
        $review_date_section->addPreset(
            "padding",
            "wpsr_review_date_section_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-review-template .wpsr-review-date'
        )->whiteList();

        /*****************************
         * Review Text
         *****************************/
        $review_text_section = $this->addControlSection( "wpsr_review_text_section", __("Review Text", "wp-social-reviews"), "assets/icon.png", $this );
        $review_text_section->typographySection( __('Typography'), '.wpsr-review-template .wpsr-review-content p', $this );
        $review_text_section->addPreset(
            "padding",
            "wpsr_review_text_section_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-review-template .wpsr-review-content p'
        )->whiteList();

        /*****************************
         * Platform Name
         *****************************/
        $review_pn_section = $this->addControlSection( "wpsr_review_platform_name_section", __("Platform Name", "wp-social-reviews"), "assets/icon.png", $this );
        $review_pn_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color', 'wp-social-reviews'),
                    "selector" 			=> '.wpsr-review-platform span',
                    "property" 			=> 'background-color'
                )
            )
        );
        $review_pn_section->typographySection( __('Typography'), '.wpsr-review-platform span', $this );
        $review_pn_section->addPreset(
            "padding",
            "wpsr_review_platform_name_section_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-review-platform span'
        )->whiteList();

        /*****************************
         * Pagination
         *****************************/
        $pagination_section = $this->addControlSection( "wpsr_reviews_pagination_section", __("Pagination", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section->typographySection( __('Typography'), '.wpsr_more span', $this );
        $pagination_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=>  '.wpsr_more span',
                    "property" 			=> 'background-color'
                )
            )
        );

        $pagination_section->addPreset(
            "padding",
            "wpsr_reviews_pagination_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr_more span'
        )->whiteList();

        $pagination_section->addPreset(
            "margin",
            "wpsr_reviews_pagination_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr_more span'
        )->whiteList();

        $pagination_section_border = $pagination_section->addControlSection( "wpsr_reviews_pagination_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section_border->addPreset(
            "border",
            "wpsr_reviews_pagination_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr_more span'
        )->whiteList();

        $pagination_section_border->addPreset(
            "border-radius",
            "wpsr_reviews_pagination_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr_more span'
        )->whiteList();

        /*****************************
         * Review Box
         *****************************/
        $review_box_section = $this->addControlSection( "wpsr_review_box_section", __("Review Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-review-template';
        $review_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> $selector,
                    "property" 			=> 'background-color'
                )
            )
        );
        $review_box_sp = $review_box_section->addControlSection( "wpsr_review_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $review_box_sp->addPreset(
            "padding",
            "wpsr_reviews_box_padding",
            __("Padding", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $review_box_sp->addPreset(
            "margin",
            "wpsr_reviews_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $review_box_border = $review_box_section->addControlSection( "wpsr_review_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $review_box_border->addPreset(
            "border",
            "wpsr_reviews_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $review_box_border->addPreset(
            "border-radius",
            "wpsr_reviews_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            $selector
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_reviews'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }


        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_reviews'] .'" platform="reviews"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_reviews'] .'" platform="reviews"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();

        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_reviews',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_reviews.css',
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
new ReviewsWidget();