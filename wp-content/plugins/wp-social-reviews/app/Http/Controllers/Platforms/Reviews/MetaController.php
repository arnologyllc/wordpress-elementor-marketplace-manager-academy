<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Reviews;

use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\App;
use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Models\Review;
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\App\Services\Helper as GlobalHelper;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Reviews\Config as ReviewConfig;

class MetaController extends Controller
{
    public function index($templateId)
    {
        $reviewConfig = new ReviewConfig();

        $templateDetails    = get_post($templateId);
        $templateMeta       = get_post_meta($templateId, '_wpsr_template_config', true);
        $feed_template_style_meta = get_post_meta($templateId, '_wpsr_template_styles_config', true);

        $decodedMeta        = json_decode($templateMeta, true);
        $formattedMeta      = Helper::formattedTemplateMeta($decodedMeta);
        $currentPlatforms   = Arr::get($formattedMeta, 'platform', array());

        $reviewsData        = Review::collectReviewsAndBusinessInfo($formattedMeta, $templateId);
        $allBusinessInfo    = Helper::getBusinessInfoByPlatforms($currentPlatforms);
		$categories         = Review::getCategories();
        $pages           = GlobalHelper::getPagesList();
        $postTypes       = GlobalHelper::getPostTypes();
        $formattedMeta['styles_config']    = $reviewConfig->formatStylesConfig(json_decode($feed_template_style_meta, true), $templateId);

        $translations = GlobalSettings::getTranslations();

        return [
            'message'            => 'success',
            'template_id'        => $templateId,
            'business_info'      => Review::formatBusinessInfo($reviewsData),
            'all_reviews'        => $reviewsData['all_reviews'],
            'filtered_reviews'   => $reviewsData['filtered_reviews'],
            'template_details'   => $templateDetails,
            'template_meta'      => $formattedMeta,
            'pages'              => $pages,
            'post_types'         => $postTypes,
            'all_business_info'  => $allBusinessInfo,
	        'categories'         => $categories,
            'translations'       => $translations,
            'elements'           => $reviewConfig->getStyleElement(),
        ];
    }

    public function update(Request $request, $templateId)
    {
        $templateMeta = wp_unslash($request->get('template_meta'));
        $templateMeta = json_decode($templateMeta, true);
        if(defined('WPSOCIALREVIEWS_PRO_VERSION')){
            (new \WPSocialReviewsPro\Classes\TemplateCssHandler())->saveCss($templateMeta, $templateId);
        }

        do_action('wpsocialreviews/template_meta_data', $templateId, $templateMeta);
        $formattedMeta      = Helper::formattedTemplateMeta($templateMeta);

        $postData = [];
        if($formattedMeta['templateType'] === 'notification') {
            unset($formattedMeta['badge_settings']);
            if (isset($formattedMeta['notification_settings'])) {
                $menuOrder = $formattedMeta['notification_settings']['notification_priority'];
                $db = App::getInstance('db');

                $db->table('posts')->where('ID', $templateId)
                    ->update([
                        'menu_order' => absint($menuOrder)
                    ]);
            }
        } else {
            unset($formattedMeta['notification_settings']);
        }

        $unsetKeys = ['styles_config', 'styles', 'responsive_styles'];
        foreach ($unsetKeys as $key){
            if(Arr::get($templateMeta, $key, false)){
                unset($templateMeta[$key]);
            }
        }

        $encodedMeta = json_encode($formattedMeta, JSON_UNESCAPED_UNICODE);
        update_post_meta($templateId, '_wpsr_template_config', $encodedMeta);

        $platforms = Arr::get($formattedMeta, 'platform', []);
        $platforms = implode(',', $platforms);

        $postData = [
            'ID'            => $templateId,
            'post_content'  => $platforms
        ];

        wp_update_post($postData);
        $updatedMeta = get_post_meta($templateId, '_wpsr_template_config', true);
        $decodedMeta = json_decode($updatedMeta);

        return [
            'message'       => __("Template saved successfully!!", 'wp-social-reviews'),
            'template_id'   => $templateId,
            'template_meta' => $decodedMeta,
        ];
    }

    public function edit(Request $request, $templateId)
    {
        $templateMeta = wp_unslash($request->get('template_meta'));
        $templateMeta = json_decode($templateMeta, true);
	    $currentPlatforms  = $templateMeta['platform'];
	    if (empty($templateMeta['platform'])) {
		    $templateMeta['filterByTitle']   = 'all';
		    $templateMeta['selectedExcList'] = [];
		    $templateMeta['selectedIncList'] = [];
	    }
        
        if((Arr::get($templateMeta, 'starFilterVal') === 11) || (!in_array('booking.com', $currentPlatforms) && Arr::get($templateMeta, 'starFilterVal') >= 6)) {
            $templateMeta['starFilterVal']  = -1;
        }

        $templateDetails    = get_post($templateId);
        $reviewsData        = Review::collectReviewsAndBusinessInfo($templateMeta, $templateId);
        $templateMeta       = Review::modifyIncludeAndExclude($templateMeta, $reviewsData);
        $allBusinessInfo    = Helper::getBusinessInfoByPlatforms($currentPlatforms);
        
        return [
            'message'            => 'success',
            'template_id'        => $templateId,
            'filtered_reviews'   => $reviewsData['filtered_reviews'],
            'all_reviews'        => $reviewsData['all_reviews'],
            'business_info'      => Review::formatBusinessInfo($reviewsData),
            'template_details'   => $templateDetails,
            'template_meta'      => $templateMeta,
            'all_business_info'  => $allBusinessInfo
        ];
    }
}