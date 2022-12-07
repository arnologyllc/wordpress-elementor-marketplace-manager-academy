<?php

namespace WPSocialReviews\App\Models;

use WPSocialReviews\App\Models\Model;
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Models\Traits\SearchableScope;

class Review extends Model
{
    use SearchableScope;
    protected $table = 'wpsr_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'integer',
        'fields' => 'json'
    ];

    protected $fillable = [
        'fields',
        'platform_name',
        'review_title',
        'reviewer_name',
        'reviewer_text',
        'review_time',
        'review_id',
        'reviewer_id',
        'rating',
        'reviewer_url',
        'reviewer_img',
        'review_approved',
        'recommendation_type',
        'source_id',
	    'category'
    ];

    /**
     * $searchable Columns in table to search
     * @var array
     */
    protected $searchable = [
        'id',
        'platform_name',
        'review_title',
        'reviewer_name',
        'reviewer_text',
        'review_time',
        'rating',
	    'category'
    ];

    public static function collectReviewsAndBusinessInfo($settings = array(), $templateId = null)
    {
        $selectedBusinesses = Arr::get($settings, 'selectedBusinesses', []);
        $platforms       = Arr::get($settings, 'platform', []);

        $activePlatforms = apply_filters('wpsocialreviews/available_valid_reviews_platforms', ['testimonial' => 'Testimonial']);

        if (empty($platforms)) {
            $platforms = array();
        }

        $validTemplatePlatforms = array_intersect($platforms, array_keys($activePlatforms));

        //add custom with platforms if custom reviews exists
        $isCustomReviewsExists = self::where('platform_name', 'custom')->count();
        if ($isCustomReviewsExists && in_array("custom", $platforms)) {
            $index                          = array_search('custom', $platforms);
            $validTemplatePlatforms[$index] = 'custom';
        }

        $filteredReviews = array();
        $allReviews      = array();
        $businessInfo    = array();

        if (!empty($validTemplatePlatforms)) {
            $filteredReviews = self::filteredReviewsQuery($validTemplatePlatforms, $settings)->get();
            $allReviews      = self::whereIn('platform_name', $validTemplatePlatforms)->get();
            $businessInfo    = Helper::getSelectedBusinessInfoByPlatforms($validTemplatePlatforms, $selectedBusinesses);
        }

        return array(
            'filtered_reviews' => $filteredReviews,
            'all_reviews'      => $allReviews,
            'business_info'    => $businessInfo
        );
    }

    //all filtered reviews
    public static function filteredReviewsQuery($platforms, $filters)
    {
        $includeIds = Arr::get($filters, 'selectedIncList', []);
        $excludeIds = Arr::get($filters, 'selectedExcList', []);

        $starFilterVal = Arr::get($filters, 'starFilterVal', -1);
        $filterByTitle = Arr::get($filters, 'filterByTitle', 'all');
        $order         = Arr::get($filters, 'order', 'desc');
        $hideEmptyReviews = Arr::get($filters, 'hide_empty_reviews', false);
        $selectedBusinesses     = Arr::get($filters, 'selectedBusinesses', array());

		$categories = Arr::get($filters, 'selectedCategories', array());
	    $platformsWithCategories = array();

		if (count($categories)) {
			$platformsWithCategories = array_intersect($platforms, Helper::getPlatformsWithCategories());
			$platforms = array_diff($platforms, $platformsWithCategories);
		}

        $reviews = self::whereIn('platform_name', $platforms);

        $has_column = Helper::hasReviewApproved();
        if($has_column && (in_array('fluent_forms', $platforms) || in_array('testimonial', $platforms))){
            $reviews = $reviews->where('review_approved', '1');
        }

	    if (count($platformsWithCategories)) {
		    $reviews->orWhere(function ($query) use ($platformsWithCategories, $categories) {
			    $query->whereIn('platform_name', $platformsWithCategories)->whereIn('category', $categories);
		    });
	    }

        if ($order === 'random' ) {
            if($filters['pagination_type'] === 'none') {
                $reviews = $reviews->inRandomOrder();
            }
            else {
                $reviews = $reviews->inRandomOrder('1234');
            }
        } else {
	        $reviews = $reviews->orderBy('review_time', $order);
        }

        //filter by star rating
        if($starFilterVal !== -1) {
            $reviews = $reviews->where('rating', '>=', $filters['starFilterVal']);
        }

        //filter by empty reviews
        if($hideEmptyReviews) {
            $reviews->where('reviewer_text', '!=', '');
        }

        //filter by included or excluded
        if ($filterByTitle === 'include' && count($includeIds)) {
            $reviews = $reviews->whereIn('id', $includeIds);
        }
        if ($filterByTitle === 'exclude' && count($excludeIds)) {
            $reviews = $reviews->whereNotIn('id', $excludeIds);
        }

        if(!empty($selectedBusinesses)) {
            $reviews = $reviews->whereIn('source_id', $selectedBusinesses);
        }

        //filter by words
        $reviews = static::filterReviewsByWords($reviews, $filters);

        //filtered by total reviews
        $totalReviews = Arr::get($filters, 'totalReviewsNumber');
        $numOfReviews = wp_is_mobile() ? Arr::get($totalReviews, 'mobile') : Arr::get($totalReviews, 'desktop');
        if($numOfReviews > 0) {
            $reviews = $reviews->limit((int)$numOfReviews);
        }

//        $multiBusinessInfo = Helper::getBusinessInfoByPlatforms($platforms);

//        $freq = array();
//        foreach ($selectedBusinesses as $businessId) {
//            $platform = Arr::get($multi_business_info, 'platforms.' . $businessId . '.platform_name', '');
//            if (!empty($platform)) {
//                if (isset($freq[$platform])) {
//                    $freq[$platform]++;
//                } else {
//                    $freq[$platform] = 1;
//                }
//            }
//            else {
//                unset($selectedBusinesses[$businessId]);
//            }
//        }

//        $selected = [];
//        $notSelected = [];
//        foreach ($platforms as $platform) {
//            if(isset($freq[$platform]) && $freq[$platform]>=1) {
//                $selected[] = $platform;
//            } else {
//                $notSelected[] = $platform;
//            }
//        }

//        if(!empty($notSelected)) {
//            $query1 = $reviews->where('platform_name', $notSelected);
//        }
//
//        if(!empty($selectedBusinesses)) {
//            $query2 = $reviews->where('source_id', $selectedBusinesses);
//        }


        return $reviews;
    }

    public static function filterReviewsByWords($reviews, $filters)
    {
        //filter by words
        $includesWords = $excludesWords = [];
        if (!empty($filters['includes_inputs'])) {
            $includesWords = array_map('trim', explode(",", $filters['includes_inputs']));
        }

        //only have excludes inputs
        if (!empty($filters['excludes_inputs'])) {
            $excludesWords = array_map('trim', explode(",", $filters['excludes_inputs']));
        }

        $existsInBoth = array_intersect($includesWords, $excludesWords);
        foreach($existsInBoth as $word) {
            if(in_array($word, $includesWords) && in_array($word, $excludesWords)) {
                $includesWords = array_diff($includesWords, [$word]);
                $excludesWords = array_diff($excludesWords, [$word]);
            }
        }

        $excludesWords = array_merge($excludesWords, $existsInBoth);
        $includesWords = array_merge($includesWords, []);

        if (!empty($includesWords)) {
            $reviews->where(function ($query) use ($includesWords) {
                foreach($includesWords as $word) {
                    $query->orWhere('reviewer_text', 'like', '%'.$word.'%');
                }
            });
        }

        //only have excludes inputs
        if (!empty($excludesWords)) {
            $reviews->where(function ($query) use ($excludesWords) {
                foreach($excludesWords as $word) {
                    $query->where('reviewer_text', 'not like', '%'.$word.'%');
                }
            });
        }
        return $reviews;
    }

    public static function paginatedReviews($platforms, $filters = array(), $page = 1)
    {
        $paginate = (int)Arr::get($filters, 'paginate', 6);
        $offset   = ($paginate * $page) - $paginate;

        $paginationType = Arr::get($filters, 'pagination_type', '');
        $templateType   = Arr::get($filters, 'templateType', 'grid');

        $filterReviewsQuery = self::filteredReviewsQuery($platforms, $filters);
        $totalFilterReviews       = count($filterReviewsQuery->get());

        // activate pagination
        if ($paginationType === 'load_more' && $templateType !== 'slider') {
            if ($totalFilterReviews > 0) {
                if ($totalFilterReviews < $paginate) {
                    $paginate = $totalFilterReviews;
                } else {
                    $reviewsNow = $page * $paginate;
                    if ($reviewsNow > $totalFilterReviews) {
                        $extraReviews = ($reviewsNow - $totalFilterReviews);
                        $paginate     = $paginate - $extraReviews;
                    }
                }
            }

            $filterReviewsQuery = $filterReviewsQuery->offset($offset)
                                                     ->limit($paginate);
        }

        $reviews = $filterReviewsQuery->get();
        return array(
            'total_reviews' => $totalFilterReviews,
            'reviews'       => $reviews
        );
    }

    public static function modifyIncludeAndExclude($templateMeta, $reviewsData)
    {
        if ($templateMeta['filterByTitle'] !== 'all' && !empty($reviewsData['filtered_reviews'])) {
            $reviewIds = array_column(json_decode($reviewsData['all_reviews'], true),"id");
            $reviewsLists = array();
            if ($templateMeta['filterByTitle'] === 'include') {
                $reviewsLists = $templateMeta['selectedIncList'];
                $commonLists = array_intersect($reviewsLists,$reviewIds);
                $templateMeta['selectedIncList'] = $commonLists;
            } else if ($templateMeta['filterByTitle'] === 'exclude') {
                $reviewsLists = $templateMeta['selectedExcList'];
                $commonLists = array_intersect($reviewsLists,$reviewIds);
                $templateMeta['selectedExcList'] = $commonLists;
            }
        } else {
            $templateMeta['selectedExcList'] = [];
            $templateMeta['selectedIncList'] = [];
        }

        return $templateMeta;
    }

    public static function formatBusinessInfo($reviewsData)
    {
        $platforms_data = array();
        $platforms = Arr::get($reviewsData, 'business_info.platforms', []);
        if(!empty($platforms)) {
            foreach ($platforms as $key => $info) {
                $platforms_data[][$key] = $info;
            }
            $reviewsData['business_info']['platforms'] = $platforms_data;
        }
        return $reviewsData['business_info'];
    }

	public static function getCategories()
	{
		$categories = static::select('category')->whereNotNull('category')->groupBy('category')->lists('category')->toArray();

		return array_filter($categories);
	}
}
