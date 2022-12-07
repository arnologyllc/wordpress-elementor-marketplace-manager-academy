<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\App\Models\Review;
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\App\Services\Helper as GlobalHelper;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\GlobalSettings;

class ReviewsTemplateHandler
{

    /**
     *
     * Render parent opening div for the review item
     *
     * @param $template_meta
     *
     * @since 3.7.0
     *
     **/
    public function renderTemplateItemParentWrapper($template_meta = []){
        $app = App::getInstance();

        $desktop_column = Arr::get($template_meta, 'responsive_column_number.desktop');
        $tablet_column = Arr::get($template_meta, 'responsive_column_number.tablet');
        $mobile_column = Arr::get($template_meta, 'responsive_column_number.mobile');

        $classes = ($template_meta['templateType'] === 'slider' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : 'wpsr-col-' . esc_attr($desktop_column) . ' wpsr-col-sm-' . esc_attr($tablet_column) . ' wpsr-col-xs-' . esc_attr($mobile_column);
        $app->view->render('public.reviews-templates.elements.item-parent-wrapper', array(
            'classes' => $classes,
        ));
    }

    /**
     *
     * Render parent closing div for the review item
     *
     * @since 3.7.0
     *
     **/
    public function renderTemplateItemParentWrapperEnd(){
       echo '</div>';
    }

    /**
     *
     * Render Reviewer Image HTML
     *
     * @param $reviewer_image_meta
     * @param $reviewer_url
     * @param $reviewer_img
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewerImageHtml($reviewer_image_meta = false, $reviewer_url = '', $reviewer_img = '', $reviewer_name = '')
    {
        if ($reviewer_image_meta === 'false') {
            return;
        }

        $app = App::getInstance();

        $attrs = [
            'class'  => 'class="wpsr-reviewer-image-url"',
            'target' => !empty($reviewer_url) ? 'target="_blank"': '',
            'rel'    => !empty($reviewer_url) ? 'rel="noopener noreferrer nofollow"' : '',
            'href'   => !empty($reviewer_url) ? 'href="'.esc_url($reviewer_url).'"' : '',
        ];

        $app->view->render('public.reviews-templates.elements.reviewer-image', array(
            'attrs'               => $attrs,
            'reviewer_image_meta' => $reviewer_image_meta,
            'reviewer_url'        => $reviewer_url,
            'reviewer_img'        => $reviewer_img,
            'reviewer_name'       => $reviewer_name,
        ));
    }

    /**
     *
     * Render Reviewer Platform HTML
     *
     * @param $display_platform_icon
     * @param $platform_name
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewPlatformHtml($display_platform_icon = '', $display_tp_brand = '', $platform_name = '')
    {
        if (empty($display_platform_icon) || $display_platform_icon === 'false' || $platform_name === 'custom' || $platform_name === 'fluent_forms') {
            return;
        }

        if($display_tp_brand == 'false' && Helper::is_tp($platform_name)) {
            return;
        }

        $app = App::getInstance();
        $app->view->render('public.reviews-templates.elements.review-platform', array(
            'platform_name' => $platform_name
        ));
    }

    /**
     *
     * Render Reviewer Name HTML
     *
     * @param $display_reviewer_name
     * @param $reviewer_url
     * @param $reviewer_name
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewerNameHtml($display_reviewer_name, $reviewer_url, $reviewer_name)
    {
        if ($display_reviewer_name === 'false') {
            return;
        }

        $attrs = [
            'class'  => 'class="wpsr-reviewer-name-url"',
            'target' => !empty($reviewer_url) ? 'target="_blank"': '',
            'rel'    => !empty($reviewer_url) ? 'rel="noopener noreferrer"' : '',
            'href'   => !empty($reviewer_url) ? 'href="'.esc_url($reviewer_url).'"' : '',
        ];

        $app = App::getInstance();
        $app->view->render('public.reviews-templates.elements.reviewer-name', array(
            'attrs'  => $attrs,
            'reviewer_url' => $reviewer_url,
            'reviewer_name' => $reviewer_name,
        ));
    }

    /**
     *
     * Render Reviewer Rating HTML
     *
     * @param $display_reviewer_rating
     * @param $rating_style
     * @param $rating
     * @param $platform_name
     * @param $recommendation_type
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewerRatingHtml($display_reviewer_rating,
                                             $rating_style,
                                             $rating,
                                             $platform_name,
                                             $recommendation_type)
    {
        if ($display_reviewer_rating === 'false') {
            return;
        }

        $app = App::getInstance();
        $app->view->render('public.reviews-templates.elements.reviewer-rating', array(
            'rating_style'        => $rating_style,
            'rating'              => $rating,
            'platform_name'       => $platform_name,
            'recommendation_type' => $recommendation_type
        ));
    }

    /**
     *
     * Render Review Date HTML
     *
     * @param $display_review_date
     * @param $review_time
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewDateHtml($display_review_date, $review_time)
    {
        if ($display_review_date === 'false') {
            return;
        }
        
        $app = App::getInstance();
        $app->view->render('public.reviews-templates.elements.review-date', array(
            'review_time' => $review_time
        ));
    }

    public function renderReviewTitleHtml($display_review_title = 'false', $review_title = '', $platform_name = '')
    {
        if ($display_review_title === 'true' && strlen($review_title) && !str_contains($review_title, $platform_name."_")) {
            $app = App::getInstance();
            $app->view->render('public.reviews-templates.elements.review-title', array(
                'review_title' => $review_title
            ));
        }
    }

    /**
     *
     * Render Review Content HTML
     *
     * @param $display_review_text
     * @param $content_length
     * @param $contentType
     * @param $reviewer_text
     * @param $reviewer_url
     *
     * @since 1.0.0
     *
     **/
    public function renderReviewContentHtml($display_review_text, $content_length, $contentType, $reviewer_text, $contentLanguage)
    {
        if ($display_review_text === 'false' || (strlen($reviewer_text) === 0)) {
            return;
        }

        $allowed_tags = GlobalHelper::allowedHtmlTags();

        $translated_by_google = strpos($reviewer_text, '(Translated by Google)');
        $original = strpos($reviewer_text, '(Original)');

        if($original){
            $contentOriginalArray = explode('(Original)', $reviewer_text);
            if($contentLanguage === 'translated_by_google'){
                $reviewer_text = str_replace('(Translated by Google)', '', $contentOriginalArray[0]);
            } elseif ($contentLanguage === 'original'){
                $reviewer_text = $contentOriginalArray[1];
            }
        }
        if($translated_by_google){
           $contentGoogleArray = explode('(Translated by Google)', $reviewer_text);
           if($contentLanguage === 'translated_by_google'){
               $reviewer_text = $contentGoogleArray[1];
           } elseif ($contentLanguage === 'original'){
               $reviewer_text = $contentGoogleArray[0];
           }
        }

        $app = App::getInstance();
        $app->view->render('public.reviews-templates.elements.review-content', array(
            'content_length'      => $content_length,
            'contentType'         => $contentType,
            'reviewer_text'       => $reviewer_text,
            'allowed_tags'        => $allowed_tags
        ));
    }

    /**
     *
     * Retrieve reviews load more data
     *
     * @since 1.2.4
     *
     **/
    public function getPaginatedFeedHtml($templateId, $page)
    {
        $app = App::getInstance();
        $shortcodeHandler = new ShortcodeHandler();

        $template_meta = $shortcodeHandler->templateMeta($templateId, 'reviews');

        if ($template_meta) {
            $reviews = array();
            $platforms = isset($template_meta['platform']) ? $template_meta['platform'] : [];
            $validTemplatePlatforms = Helper::validPlatforms($platforms);
            if (!empty($validTemplatePlatforms)) {
                $data = Review::paginatedReviews($validTemplatePlatforms, $template_meta, $page);
                $reviews = $data['reviews'];
            }

            $template = $template_meta['template'];
            $templates = ['grid1', 'grid2', 'grid3', 'grid4', 'grid5'];

            if (!in_array($template, $templates)) {
                return (string)apply_filters('wpsocialreviews/add_reviews_template', $template, $reviews, $template_meta);
            }

            $templatePath = $shortcodeHandler->reviewsTemplatePath($template);
            return (string) $app->view->make($templatePath, array(
                'reviews'       => $reviews,
                'template_meta' => $template_meta,
            ));
        }

    }
}