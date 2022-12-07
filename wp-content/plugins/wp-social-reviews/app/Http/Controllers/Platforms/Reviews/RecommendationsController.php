<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms\Reviews;

use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\App\Models\Review;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Http\Requests\ReviewRequest;
use WPSocialReviews\Framework\Support\Arr;

class RecommendationsController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');

        $search  = $request->get('search');
        $filter  = $request->get('filter') === 'all' ? '' : $request->get('filter');
        $orderBy = $request->get('order_by') ? $request->get('order_by') : '';

        if($type === 'testimonial') {
            $filter = $type;
        }

        $reviews = Review::searchBy($search)->where('platform_name', 'like', '%'.$filter.'%');

        if($orderBy) {
            $reviews = $reviews->orderBy('review_time', $orderBy);
        } else {
            $reviews = $reviews->orderBy('id', 'desc');
        }

        if($type === 'review') {
            $reviews = $reviews->where('platform_name', '!=', 'testimonial');
        }

        $reviews = $reviews->paginate();

        $totalReviews = $type === 'testimonial' ? Review::where('platform_name', $filter)->get() : Review::all();

        $totalReviews = count($totalReviews);

        //find all available platforms for templating
        $valid_platforms = apply_filters('wpsocialreviews/available_valid_reviews_platforms', []);
        $hasCustomReview = Review::where('platform_name', 'custom')->count();

        if ($hasCustomReview) {
            $valid_platforms['custom'] = __('Custom', 'wp-social-reviews');
        }

        return [
            'all_valid_platforms'   => $valid_platforms,
            'items'                 => $reviews,
            'total_items'           => $totalReviews
        ];
    }

	public function create(ReviewRequest $request)
	{
        $review_fields = $request->get('review');
		$review_fields = wp_unslash($review_fields);
        $review = $this->sanitize($review_fields);

		$review['recommendation_type'] = 'positive';
        $review['review_approved'] = 1;

        $createdReview = Review::create($review);

		do_action('wpsocialreviews/custom_review_created', $createdReview);

		return [
			'message' => __('Review has been successfully created', 'wp-social-reviews'),
			'review'  => $createdReview
		];
	}

    public function duplicate(Request $request, $id)
    {
        $review = Review::find($id)->toArray();

        $review['review_title'] = '(Duplicate)' . $review['review_title'] . ' (#' . $review['id'] . ')';

        $createdReview = Review::create($review);

        return [
            'message' => __('Review has been successfully created', 'wp-social-reviews'),
            'review'  => $createdReview
        ];
    }

	public function update(ReviewRequest $request, $reviewId)
	{
        $updateData = $request->get('review');
		$updateData = wp_unslash($updateData);
        $updateData = $this->sanitize($updateData);

        $review = Review::findOrFail($reviewId);

		$review->fill($updateData);
		$review->save();

		do_action('wpsocialreviews/custom_review_updated', $review);

		return [
			'message' => __('Review has been successfully updated', 'wp-social-reviews'),
			'review'  => $review
		];
	}

    public function sanitize($fields)
    {
        $sanitizeRules = [
            'reviewer_name' => 'sanitize_text_field',
            'reviewer_url'  => 'sanitize_url',
            'review_title'  => 'sanitize_text_field',
            'reviewer_text' => 'wp_kses_post',
            'category'      => 'sanitize_text_field',
            'review_time'   => 'sanitize_text_field',
            'platform_name' => 'sanitize_text_field',
            'reviewer_img'  => 'sanitize_url',
            'fields.author_company'         => 'sanitize_text_field',
            'fields.author_position'        => 'sanitize_text_field',
            'fields.author_website_logo'    => 'sanitize_url',
            'fields.author_website_url'     => 'sanitize_url'
        ];

        $review = [];
        if($fields && is_array($fields)) {
            foreach ($fields as $dataKey => $dataItem) {
                if(is_array($fields[$dataKey]) && count($fields[$dataKey]) > 1) {
                    foreach ($fields[$dataKey] as $subKey => $subItem) {
                        $key = $dataKey.'.'.$subKey;
                        $sanitizeFunc = Arr::get($sanitizeRules, $key, 'sanitize_text_field');
                        $review[$dataKey][$subKey] = $sanitizeFunc($subItem);
                    }
                } else {
                    $sanitizeFunc = Arr::get($sanitizeRules, $dataKey, 'sanitize_text_field');
                    $review[$dataKey] = $sanitizeFunc($dataItem);
                }
            }
        }

        return $review;
    }

    public function delete(Request $request, $id)
    {
        Review::where('id', $id)->delete();
        do_action('wpsocialreviews/custom_review_deleted', $id);

        return [
            'message' => __('Review has been successfully deleted', 'wp-social-reviews')
        ];
    }
}