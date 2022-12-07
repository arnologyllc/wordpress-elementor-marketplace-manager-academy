<?php

namespace WPSocialReviews\App\Http\Requests;

use WPSocialReviews\Framework\Foundation\RequestGuard;

class ReviewRequest extends RequestGuard
{
    public function rules()
    {
        return [
            'review.reviewer_name' => 'required',
            'review.reviewer_text' => 'required',
            'review.rating'        => 'required|numeric|integer|min:1|max:5',
            'review.review_time'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'review.reviewer_name.required' => 'The name field is required.',
            'review.reviewer_text.required' => 'The text field is required.',
            'review.rating.min'             => 'The rating must be at least 1.',
            'review.review_time.required'   => 'The date field is required.'
        ];
    }
}
