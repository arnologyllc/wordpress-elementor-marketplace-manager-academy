<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\App\Models\Review;

trait ReviewsTrait
{
    public function validReviewsPlatforms($platforms = array())
    {
        $activePlatforms = apply_filters('wpsocialreviews/available_valid_reviews_platforms', []);

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
}