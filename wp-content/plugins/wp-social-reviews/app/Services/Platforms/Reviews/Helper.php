<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\App\Models\Review;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper as GlobalHelper;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    public static function getConnectedAccountsBusinessInfo($platforms)
    {
        $business_info = [];
        foreach ($platforms as $index => $platform){
            $infos = get_option('wpsr_reviews_'.$platform.'_business_info');
            if( $infos ){
                $business_info += get_option('wpsr_reviews_'.$platform.'_business_info');
//                if (count($infos) > 1) {
//                    foreach ($infos as $k => $v) {
//                        $business_info[$k.$index] = $v;
//                    }
//                } else {
//                    $values = array_values($infos)[0];
//                    $key = array_keys($infos)[0];
//                    $business_info[$key . $index] = $values;
//                }
            }
        }
        return $business_info;
    }

    public static function getNotificationMessage($businessInfo = [], $key = '')
    {
        $downloadedReviews = Arr::get($businessInfo, 'total_fetched_reviews');
        $businessName = Arr::get($businessInfo, $key.'.name');

        $message = __('Reviews fetched successfully!!', 'wp-social-reviews');
        if ($downloadedReviews && $businessName && $downloadedReviews > 0) {
            $message = __($downloadedReviews. ' reviews fetched successfully from '. $businessName .'!!', 'wp-social-reviews');
        }

        else if($downloadedReviews && $downloadedReviews > 0) {
            $message = __($downloadedReviews. ' reviews fetched successfully!!', 'wp-social-reviews');
        }

        else if (empty($downloadedReviews) || $downloadedReviews < 1) {
            $message = __('Reviews fetched failed, Please try again!!', 'wp-social-reviews');
        }
        return $message;
    }

    public static function formattedTemplateMeta($settings = array())
    {
        $platform = Arr::get($settings, 'platform', []);

        $template = in_array('testimonial', $platform) ? 'testimonial1' : 'grid1';
        $timestamp = in_array('testimonial', $platform) ? 'false' : 'true';
	    $selectedIncList = Arr::get($settings, 'selectedIncList', []);
	    $selectedExcList = Arr::get($settings, 'selectedExcList', []);
	    $filterByTitle   = Arr::get($settings, 'filterByTitle', 'all');

		if (empty($selectedExcList) && empty($selectedIncList)) {
			$filterByTitle = 'all';
		}

        // support old minimum rating values 11/6
        if((Arr::get($settings, 'starFilterVal') === 11) || (!in_array('booking.com', $platform) && Arr::get($settings, 'starFilterVal') >= 6)) {
            $settings['starFilterVal']  = -1;
        }

        extract(static::getCarouselSettings($settings));

        return array (
            //source
            'platform'       => $platform,

            //template
            'platformType'   => Arr::get($settings, 'platformType', 'single'),
            'template'       => Arr::get($settings, 'template', $template),
            'templateType'   => Arr::get($settings, 'templateType',  'grid'),
            'column'         => Arr::get($settings, 'column', '4'),
            'responsive_column_number'  => array(
                'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column', '4')),
                'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','4'),
                'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
            ),
            //settings
            'reviewer_name'  => Arr::get($settings, 'reviewer_name', 'true'),
            'author_position'    => Arr::get($settings, 'author_position', 'true'),
            'author_company_name'   => Arr::get($settings, 'author_company_name', 'false'),
            'website_logo'   => Arr::get($settings, 'website_logo', 'true'),
            'rating_style'   => Arr::get($settings, 'rating_style', 'default'),
            'reviewer_image' => Arr::get($settings, 'reviewer_image', 'true'),
            'timestamp'      => Arr::get($settings, 'timestamp', $timestamp),
            'reviewerrating' => Arr::get($settings, 'reviewerrating', 'true'),

            'platform_label' => sanitize_text_field(Arr::get($settings, 'platform_label', __('On Site', 'wp-social-reviews'))),

            'equal_height'      => Arr::get($settings, 'equal_height', 'false'),
            'equalHeightLen'    => (int)Arr::get($settings, 'equalHeightLen', '250'),
            'content_length'    => (int)Arr::get($settings, 'content_length', 10),
            'contentLanguage'   => Arr::get($settings, 'contentLanguage', 'original'),
            'contentType'       => Arr::get($settings, 'contentType', 'excerpt'),

            'display_review_title'         => Arr::get($settings, 'display_review_title', 'true'),
            'isReviewerText'               => Arr::get($settings, 'isReviewerText', 'true'),
            'isPlatformIcon'               => Arr::get($settings, 'isPlatformIcon', 'true'),
            'current_template_type'        => Arr::get($settings, 'current_template_type', 'grid'),

            //carousel
            'carousel_settings' => array(
                'autoplay'                     => Arr::get($settings, 'carousel_settings.autoplay', $autoplay),
                'autoplay_speed'               => (int)Arr::get($settings,'carousel_settings.autoplay_speed', $autoplay_speed),
                'slides_to_show'               => (int)Arr::get($settings,'carousel_settings.slides_to_show', $slides_to_show),
                'slides_to_scroll'             => (int)Arr::get($settings, 'carousel_settings.slides_to_scroll', $slides_to_scroll),
                'navigation'                   => Arr::get($settings,'carousel_settings.navigation', $navigation),
            ),

            //filters
            'totalReviewsVal'              => (int)Arr::get($settings, 'totalReviewsVal', '50'),
            'totalReviewsNumber'           => array(
                'desktop'   => (int)Arr::get($settings, 'totalReviewsNumber.desktop', Arr::get($settings, 'totalReviewsVal', '50')),
                'mobile'    => (int)Arr::get($settings, 'totalReviewsNumber.mobile', Arr::get($settings, 'totalReviewsVal', '50'))
            ),
            'starFilterVal'                => (int)Arr::get($settings, 'starFilterVal', -1),
            'filterByTitle'                => $filterByTitle,
            'selectedIncList'              => $selectedIncList,
            'selectedExcList'              => $selectedExcList,
            'includes_inputs'              => sanitize_text_field(Arr::get($settings, 'includes_inputs', '')),
            'excludes_inputs'              => sanitize_text_field(Arr::get($settings, 'excludes_inputs', '')),
            'order'                        => Arr::get($settings, 'order', 'desc'),
            'hide_empty_reviews'           => Arr::get($settings, 'hide_empty_reviews', false),
            'selectedBusinesses'           => Arr::get($settings, 'selectedBusinesses', []),
            'selectedCategories'           => Arr::get($settings, 'selectedCategories', []),

            //header
            'show_header'                  => Arr::get($settings,'show_header', 'false'),
            'display_header_business_logo' => Arr::get($settings, 'display_header_business_logo', true),
            'display_header_business_name' => Arr::get($settings,'display_header_business_name', true),
            'display_header_rating'        => Arr::get($settings,'display_header_rating', true),
            'display_header_reviews'       => Arr::get($settings,'display_header_reviews', true),
            'display_header_write_review'  => Arr::get($settings,'display_header_write_review', true),
            'custom_write_review_text'     => sanitize_text_field(Arr::get($settings,'custom_write_review_text', __('Write a Review','wp-social-reviews'))),
            'custom_title_text'                 => sanitize_text_field(Arr::get($settings,'custom_title_text', '')),
            'custom_number_of_reviews_text'     => sanitize_text_field(Arr::get($settings,'custom_number_of_reviews_text', __('Based on {total_reviews} Reviews', 'wp-social-reviews'))),
            'display_tp_brand'             => Arr::get($settings, 'display_tp_brand', 'false'),

            //pagination
            'pagination_type'         => Arr::get($settings, 'pagination_type', 'none'),
            'load_more_button_text'   => sanitize_text_field(Arr::get($settings, 'load_more_button_text', __('Load More', 'wp-social-reviews'))),
            'paginate'                => (int)Arr::get($settings,'paginate', '6'),

            //Badge Settings
	        'badge_settings' => array (
		        'template'                  => Arr::get($settings,'badge_settings.template', 'badge1'),
		        'badge_position'            => Arr::get($settings,'badge_settings.badge_position', 'default'),
		        'display_platform_icon'     => Arr::get($settings,'badge_settings.display_platform_icon', 'true'),
		        'custom_title'              => sanitize_text_field(Arr::get($settings,'badge_settings.custom_title', __('Rating', 'wp-social-reviews'))),
                'custom_num_of_reviews_text'=> sanitize_text_field(Arr::get($settings, 'badge_settings.custom_num_of_reviews_text', __('Read our {reviews_count} Reviews', 'wp-social-reviews'))),
                'display_reviews_on_click'  => Arr::get($settings,'badge_settings.display_reviews_on_click', 'true'),
	        ),

	        //Notification Settings
            'notification_settings' => array(
                'template'                  => Arr::get($settings,'notification_settings.template', 'notification1'),
                'notification_position'     => Arr::get($settings,'notification_settings.notification_position', 'float_left_bottom'),
                'display_reviews_on_click'  => Arr::get($settings,'notification_settings.display_reviews_on_click', 'true'),
                'page_list'                 => Arr::get($settings,'notification_settings.page_list', array('-1')),
                'exclude_page_list'         => Arr::get($settings,'notification_settings.exclude_page_list', array()),
                'post_types'                => Arr::get($settings,'notification_settings.post_types', array()),
                'hide_on_desktop'           => Arr::get($settings,'notification_settings.hide_on_desktop', 'false'),
                'hide_on_mobile'            => Arr::get($settings,'notification_settings.hide_on_mobile', 'false'),
                'notification_priority'     => Arr::get($settings,'notification_settings.notification_priority', 0),
                'display_close_button'      => Arr::get($settings,'notification_settings.display_close_button', 'true'),
                'display_date'              => Arr::get($settings,'notification_settings.display_date', 'true'),
                'custom_notification_text'  => sanitize_text_field(Arr::get($settings,'notification_settings.custom_notification_text', __('Just left us a {review_rating} star review', 'wp-social-reviews'))),
                'initial_delay'             => (int) Arr::get($settings,'notification_settings.initial_delay', 6000),
                'notification_delay'        => (int) Arr::get($settings,'notification_settings.notification_delay', 5000),
                'delay_for'                 => (int) Arr::get($settings,'notification_settings.delay_for', 5000),
                'display_read_all_reviews_btn'  => Arr::get($settings,'notification_settings.display_read_all_reviews_btn', 'false'),
                'read_all_reviews_btn_url'  => sanitize_url(Arr::get($settings,'notification_settings.read_all_reviews_btn_url', '#')),
            ),
            'enable_schema'         => Arr::get($settings,'enable_schema', 'false'),
            'schema_settings' => array (
                'business_logo'              => Arr::get($settings,'schema_settings.business_logo', ''),
                'business_name'              => sanitize_text_field(Arr::get($settings,'schema_settings.business_name', '')),
                'business_type'              => sanitize_text_field(Arr::get($settings,'schema_settings.business_type', '')),
                'business_telephone'         => sanitize_text_field(Arr::get($settings,'schema_settings.business_telephone', '')),
                'business_average_rating'    => (int) Arr::get($settings,'schema_settings.business_average_rating', ''),
                'business_total_rating'      => (int) Arr::get($settings,'schema_settings.business_total_rating', ''),
            ),

	        //styles
            'feed_settings'=> array(
                'enable_style'         => Arr::get($settings,'feed_settings.enable_style', 'false'),
            ),
            'template_width'               => Arr::get($settings,'template_width', ''),
            'template_height'              => Arr::get($settings,'template_height', ''),
        );
    }

    public static function getCarouselSettings($settings)
    {
        $carousel_settings = array(
            'autoplay'                     => Arr::get($settings, 'autoplay', 'false'),
            'autoplay_speed'               => (int)Arr::get($settings,'autoplay_speed', '3000'),
            'slides_to_show'               => (int)Arr::get($settings,'slides_to_show', '3'),
            'slides_to_scroll'             => (int)Arr::get($settings, 'slides_to_scroll', '3'),
            'navigation'                   => Arr::get($settings,'navigation', 'dot'),
        );

        return $carousel_settings;
    }

    public static function validPlatforms($platforms = array())
    {
        $activePlatforms = apply_filters('wpsocialreviews/available_valid_reviews_platforms', []);
        //$activePlatforms = apply_filters('wpsocialreviews/push_testimonial_platform', $activePlatforms);
        //add custom with platforms if custom reviews exists
        $isCustomReviewsExists = Review::where('platform_name', 'custom')
                                       ->count();

        if ($isCustomReviewsExists) {
            $activePlatforms['custom'] = __('Custom', 'wp-social-reviews');
        }

        if (!empty($platforms)) {
            $activePlatforms = array_intersect($platforms, array_keys($activePlatforms));
        }

        return $activePlatforms;
    }

    public static function getBusinessInfoByPlatforms($platforms)
    {
        $multi_business_info = [];
        $platform_urls       = [];
        $avg_rating          = 0;
        $total_rating        = 0;
        $connected_business_info = Helper::getConnectedAccountsBusinessInfo($platforms);

        $value = array_values($connected_business_info);
        $platformNames = array_column($value, 'platform_name');

        $isBooking = false;
        if(in_array('booking.com', $platformNames)) {
            if(count(array_unique($platformNames)) === 1 && end($platformNames) === 'booking.com') {
                $isBooking = true;
            }
        }

        $platforms = 0;
        foreach ($connected_business_info as $index => $business_info) {
            $place_id = Arr::get($business_info, 'place_id');
            $platform_urls[$place_id] = [
                'platform_name' => Arr::get($business_info, 'platform_name'),
                'name'          => Arr::get($business_info, 'name'),
                'url'           => Arr::get($business_info, 'url'),
                'average_rating'=> Arr::get($business_info, 'average_rating'),
                'total_rating'  => Arr::get($business_info, 'total_rating')
            ];

            $multi_business_info['platforms']  = $platform_urls;

            if(Arr::get($business_info, 'total_rating')) {
                $total_rating += $business_info['total_rating'];
                $multi_business_info['total_rating'] = $total_rating;
            }

            $average_rating = Arr::get($business_info, 'average_rating');
            if ($average_rating) {
                $platforms++;

                if(Arr::get($business_info, 'platform_name') === 'booking.com' && !$isBooking) {
                    $avg_rating += ((float)$average_rating/2);
                } else {
                    $avg_rating += $average_rating;
                }
                $multi_business_info['average_rating'] = $platform_urls && $avg_rating ? $avg_rating / $platforms : $avg_rating;
            }
        }
        return $multi_business_info;
    }

    public static function getSelectedBusinessInfoByPlatforms($platforms, $selectedBusinesses)
    {
        $multi_business_info = self::getBusinessInfoByPlatforms($platforms);
        if(!empty($selectedBusinesses) && !empty($multi_business_info['platforms'])) {
            $multi_business_info['average_rating'] = 0;
            $multi_business_info['total_rating'] = 0;
            $avg_rating          = 0;
            $total_rating        = 0;
            $platforms = 0;

            $allPlatforms = [];
            foreach($selectedBusinesses as $key => $selected) {
                $platformName = isset($multi_business_info['platforms'][$selected]['platform_name']) ? $multi_business_info['platforms'][$selected]['platform_name'] : '';
                $allPlatforms[] = $platformName;
            }

            $isBooking = false;
            if(in_array('booking.com', $allPlatforms)) {
                if(count(array_unique($allPlatforms)) === 1 && end($allPlatforms) === 'booking.com') {
                    $isBooking = true;
                }
            }

            foreach ($multi_business_info['platforms'] as $businessId => $business) {
                if(in_array($businessId, $selectedBusinesses)) {
                    $average_rating = Arr::get($business, 'average_rating');
                    if($average_rating) {
                        $platforms++;
                        if (Arr::get($business, 'platform_name') === 'booking.com' && !$isBooking) {
                            $avg_rating += ((float)$average_rating / 2);
                        } else {
                            $avg_rating += $average_rating;
                        }
                        $multi_business_info['average_rating'] = $avg_rating ? $avg_rating / $platforms : $avg_rating;
                    }
                    $total_rating                          += $business['total_rating'];
                    $multi_business_info['total_rating']   = $total_rating;
                } else {
                    unset($multi_business_info['platforms'][$businessId] );
                }
            }
        }
        return $multi_business_info;
    }

    public static function platformDynamicClassName($business_info)
    {
        $count = [];
        $platforms = Arr::get($business_info, 'platforms');
        if(empty($platforms)){
            return;
        }

        foreach ($platforms as $index => $platform) {
            $platformName = Arr::get($platform, 'platform_name');
            if(isset($count[$platformName]) && $count[$platformName]){
                continue;
            }
            $count[$platformName] = 1;
        }
        $total_platforms = count($count);

        if($total_platforms === 1){
            $class = array_keys($count)[0];
        } else {
            $class = 'wpsr-has-multiple-reviews-platform';
        }
        return $class;
    }

    /**
     * Generate rating SVG icon based on rating value
     *
     * @param $rating
     *
     * @return string
     * @since 1.0.0
     */
    public static function generateRatingIcon($rating)
    {
        $icons = '';
        foreach (array(1, 2, 3, 4, 5) as $val) {
            $score = $rating - $val;
            if ($score >= 0) {
                $icons .= '<span class="wpsr-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1792 1792"><path
                                d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path></svg></span>';
            } elseif ($score > -1 && $score < 0) {
                $icons .= '<span class="wpsr-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1792 1792"><path
                                d="M1250 957l257-250-356-52-66-10-30-60-159-322v963l59 31 318 168-60-355-12-66zm452-262l-363 354 86 500q5 33-6 51.5t-34 18.5q-17 0-40-12l-449-236-449 236q-23 12-40 12-23 0-34-18.5t-6-51.5l86-500-364-354q-32-32-23-59.5t54-34.5l502-73 225-455q20-41 49-41 28 0 49 41l225 455 502 73q45 7 54 34.5t-24 59.5z"></path></svg></span>';
            } else {
                $icons .= '<span class="wpsr-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1792 1792"><path
                                d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path></svg></span>';
            }
        }

        return $icons;
    }

    public static function platformIcon($platform_name = '', $size = '')
    {
        $img_size = $size === 'small' ? '-'.$size : '';
        return apply_filters('wpsocialreviews/' . $platform_name . '_reviews_platform_icon',
            WPSOCIALREVIEWS_URL . 'assets/images/icon/icon-' . $platform_name . $img_size.'.png');
    }

    public static function removeSpecialChars($text)
    {
        $text = str_replace("&#x27;", "'", $text);
        $text = html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
        $text = htmlspecialchars_decode($text, ENT_QUOTES);
        $text = wp_specialchars_decode($text);
        return $text;
    }

	public static function getPlatformsWithCategories()
	{
		return apply_filters('wpsocialreviews/platforms_with_categories', ['fluent_forms', 'custom', 'testimonial']);
	}

    public static function hasReviewApproved()
    {
        global $wpdb;
        $table_name = $wpdb->prefix .'wpsr_reviews';
        $has_column = GlobalHelper::hasColumn($table_name, 'review_approved');

        return $has_column;
    }

    public static function is_tp($platform_name)
    {
        $trust = substr($platform_name, 0, 5);
        return ($trust === 'trust');
    }
}
