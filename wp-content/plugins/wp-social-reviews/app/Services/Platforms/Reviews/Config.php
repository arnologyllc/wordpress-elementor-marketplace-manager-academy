<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Config
{
    public function __construct()
    {

    }

    public function getStyleElement()
    {
        return array(
            'header' => array(
                'title' => __('Header', 'wp-social-reviews'),
                'key'  => 'header',
                array(
                    'title'     => __('Title', 'wp-social-reviews'),
                    'key'      => 'rating_title',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Rating Number', 'wp-social-reviews'),
                    'key'      => 'rating_number',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Rating Text', 'wp-social-reviews'),
                    'key'      => 'rating_text',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Write a Review Button', 'wp-social-reviews'),
                    'key'      => 'review_button',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Box', 'wp-social-reviews'),
                    'key'      => 'business_info_wrapper',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
            'name' => array(
                'title' => __('Reviewer Name', 'wp-social-reviews'),
                'key'  => 'reviewer_name',
                array(
                    'key'      => 'reviewer',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'reviewer_name_wrapper',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Top', 'wp-social-reviews'),
                    ),
                ),
            ),
            'position' => array(
                'title' => __('Author Position', 'wp-social-reviews'),
                'key'  => 'author_position',
                array(
                    'key'      => 'author_position',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
            'review_date' => array(
                'title' => __('Review Date', 'wp-social-reviews'),
                'key'  => 'review_date',
                array(
                    'key'      => 'review_date',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Top', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
            'review_title' => array(
                'title' => __('Title', 'wp-social-reviews'),
                'key'  => 'review_title',
                array(
                    'key'      => 'review_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
            'content' => array(
                'title' => __('Content', 'wp-social-reviews'),
                'key'  => 'content',
                array(
                    'key'      => 'content',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Top', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'read_more_less' => array(
                'title' => __('Read More/Less', 'wp-social-reviews'),
                'key'  => 'read_more_less',
                array(
                    'key'      => 'read_more_less',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                )
            ),
            'platform' => array(
                'title' => __('Platform Name', 'wp-social-reviews'),
                'key'  => 'platform',
                array(
                    'key'      => 'platform',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'badge' => array(
                'title' => __('Badge', 'wp-social-reviews'),
                'key'  => 'badge',
                array(
                    'title'      => __('Rating Title', 'wp-social-reviews'),
                    'key'      => 'badge_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Rating Number', 'wp-social-reviews'),
                    'key'      => 'badge_rating_number',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Total Reviews', 'wp-social-reviews'),
                    'key'      => 'badge_total_reviews',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Box', 'wp-social-reviews'),
                    'key'      => 'badge_wrapper_box',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'notification' => array(
                'title' => __('Notification', 'wp-social-reviews'),
                'key'  => 'notification',
                array(
                    'title'      => __('Close Icon', 'wp-social-reviews'),
                    'key'      => 'notification_close_icon',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Icon Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'fill_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Reviewer Name', 'wp-social-reviews'),
                    'key'      => 'notification_reviewer_name',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Notification Title', 'wp-social-reviews'),
                    'key'      => 'notification_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Review Time', 'wp-social-reviews'),
                    'key'      => 'notification_review_time',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'      => __('Box', 'wp-social-reviews'),
                    'key'      => 'notification_wrapper_box',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'pagination' => array(
                'title' => __('Pagination', 'wp-social-reviews'),
                'key'  => 'pagination',
                array(
                    'key'      => 'pagination',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                ),
            ),
            'review_box' => array(
                'title' => __('Review Box', 'wp-social-reviews'),
                'key'  => 'review_box',
                array(
                    'key'      => 'review_box',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
        );
    }

    public function formatStylesConfig($settings = [], $postId = null)
    {
        $prefix = '.wpsr-reviews-'.$postId;
        $badgePrefix = '.wpsr-reviews-badge-'.$postId;
        $notificationPrefix = '.wpsr-reviews-notification-'.$postId;
        return [
            'styles' => array(
                'rating_title' => array(
                    'selector' => $prefix . ' .wpsr-business-info .wpsr-business-info-left .wpsr-business-info-logo span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.rating_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.rating_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.rating_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.rating_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.rating_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.rating_title.typography.text_decoration', ''),
                    ),
                ),
                'rating_number' => array(
                    'selector' => $prefix . ' .wpsr-business-info .wpsr-rating-and-count .wpsr-total-rating, .wpsr-business-info .wpsr-rating-and-count .wpsr-total-reviews span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.rating_number.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.rating_number.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_number.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_number.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_number.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_number.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_number.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_number.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_number.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_number.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.rating_number.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.rating_number.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.rating_number.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.rating_number.typography.text_decoration', ''),
                    ),
                ),
                'rating_text' => array(
                    'selector' => $prefix . ' .wpsr-business-info .wpsr-rating-and-count .wpsr-total-reviews',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.rating_text.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.rating_text.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_text.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_text.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_text.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_text.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_text.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.rating_text.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.rating_text.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.rating_text.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.rating_text.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.rating_text.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.rating_text.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.rating_text.typography.text_decoration', ''),
                    ),
                ),
                'review_button' => array(
                    'selector' => $prefix .' .wpsr-container .wpsr-business-info .wpsr-business-info-right a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.review_button.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.review_button.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.review_button.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_button.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_button.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.review_button.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_button.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_button.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.review_button.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_button.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_button.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.review_button.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.review_button.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.review_button.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.review_button.typography.text_decoration', ''),
                    ),
                ),
                'business_info_wrapper' => array(
                    'selector' => $prefix.' .wpsr-fixed-height .wpsr-business-info',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.business_info_wrapper.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.business_info_wrapper.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.business_info_wrapper.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.business_info_wrapper.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.business_info_wrapper.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.business_info_wrapper.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.business_info_wrapper.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.business_info_wrapper.border.border_color', ''),
                    ),
                ),
                'reviewer' => array(
                    'selector' => $prefix.' .wpsr-review-template .wpsr-review-info .wpsr-reviewer-name-url .wpsr-reviewer-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.reviewer.color.text_color', '')
                    ),
                    'slider'  => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.reviewer.slider.top.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.reviewer.slider.top.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.reviewer.slider.top.mobile', 0),
                        ),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.reviewer.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.reviewer.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.reviewer.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.reviewer.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.reviewer.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.reviewer.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.reviewer.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.reviewer.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.reviewer.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.reviewer.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.reviewer.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.reviewer.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.reviewer.typography.text_decoration', ''),
                    ),
                ),
                'author_position' => array(
                    'selector' => $prefix.' .wpsr-testimonial-template-one .wpsr-review-header .wpsr-review-info .wpsr-reviewer-position',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.author_position.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.author_position.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author_position.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author_position.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.author_position.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author_position.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author_position.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.author_position.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author_position.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author_position.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.author_position.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.author_position.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.author_position.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.author_position.typography.text_decoration', ''),
                    ),
                ),
                'review_title' => array(
                    'selector' => $prefix.' .wpsr-review-template .wpsr-review-title',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.review_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.review_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.review_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.review_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.review_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.review_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.review_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.review_title.typography.text_decoration', ''),
                    ),
                ),
                'reviewer_name_wrapper' => array(
                    'selector' => $prefix.' .wpsr-review-header .wpsr-review-info a',
                    'slider'  => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.reviewer_name_wrapper.slider.top.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.reviewer_name_wrapper.slider.top.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.reviewer_name_wrapper.slider.top.mobile', 0),
                        ),
                    ),
                ),
                'platform' => array(
                    'selector' => $prefix.' .wpsr-review-platform span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.platform.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.platform.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.platform.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.platform.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.platform.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.platform.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.platform.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.platform.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.platform.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.platform.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.platform.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.platform.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.platform.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.platform.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.platform.typography.text_decoration', ''),
                    ),
                ),
                'read_more_less' => array(
                    'selector' => $prefix. ' .wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.read_more_less.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.read_more_less.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.read_more_less.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.read_more_less.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.read_more_less.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.read_more_less.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.read_more_less.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.read_more_less.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.read_more_less.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.read_more_less.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.read_more_less.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.read_more_less.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.read_more_less.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.read_more_less.typography.text_decoration', ''),
                    ),
                ),
                'content' => array(
                    'selector' => $prefix. ' .wpsr-review-template .wpsr-review-content p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.content.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.content.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.content.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.content.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.content.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.content.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.content.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.content.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.content.slider.top.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.content.slider.top.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.content.slider.top.mobile', 0),
                        ),
                    ),
                ),
                'review_date' => array(
                    'selector' => $prefix .' .wpsr-review-template .wpsr-review-date',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.review_date.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.review_date.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_date.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_date.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.review_date.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_date.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_date.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.review_date.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_date.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_date.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.review_date.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.review_date.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.review_date.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.review_date.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.review_date.slider.top.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.review_date.slider.top.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.review_date.slider.top.mobile', 0),
                        ),
                    ),

                ),
                'review_box' => array(
                    'selector' => $prefix.' .wpsr-review-template',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.review_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.review_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.review_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.review_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.review_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.review_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.review_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.review_box.border.border_color', ''),
                    ),

                ),
                'badge_title' => array(
                    'selector' => $badgePrefix.' .wpsr-reviews-badge-wrapper-inner .wpsr-business-info-logo span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.badge_title.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.badge_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.badge_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.badge_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.badge_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.badge_title.typography.text_decoration', ''),
                    ),
                ),
                'badge_rating_number' => array(
                    'selector' => $badgePrefix.' .wpsr-rating-and-count .wpsr-total-rating',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.badge_rating_number.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.badge_rating_number.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_rating_number.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_rating_number.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_rating_number.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_rating_number.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_rating_number.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_rating_number.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_rating_number.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_rating_number.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.badge_rating_number.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.badge_rating_number.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.badge_rating_number.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.badge_rating_number.typography.text_decoration', ''),
                    ),
                ),
                'badge_total_reviews' => array(
                    'selector' => $badgePrefix.' .wpsr-reviews-badge-btn .wpsr-rating-and-count .wpsr-total-reviews',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.badge_total_reviews.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.badge_total_reviews.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_total_reviews.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_total_reviews.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_total_reviews.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_total_reviews.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_total_reviews.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.badge_total_reviews.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_total_reviews.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_total_reviews.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.badge_total_reviews.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.badge_total_reviews.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.badge_total_reviews.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.badge_total_reviews.typography.text_decoration', ''),
                    ),
                ),
                'badge_wrapper_box' => array(
                    'selector' => $badgePrefix.' .wpsr-reviews-badge-btn, .wpsr-reviews-badge-html',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.badge_wrapper_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.badge_wrapper_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.badge_wrapper_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.badge_wrapper_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.badge_wrapper_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.badge_wrapper_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.badge_wrapper_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.badge_wrapper_box.border.border_color', ''),
                    ),

                ),
                'notification_close_icon' => array(
                    'selector' => $notificationPrefix.'.wpsr-reviews-notification-card-wrapper .wpsr-close svg path',
                    'color'  => array(
                        'fill_color' => Arr::get($settings,'styles.notification_close_icon.color.fill_color', ''),
                    ),
                ),
                'notification_reviewer_name' => array(
                    'selector' => $notificationPrefix.' .wpsr-reviews-notification-card .wpsr-notification-content-wrapper .wpsr-review-header .reviewer-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.notification_reviewer_name.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.notification_reviewer_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_reviewer_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_reviewer_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_reviewer_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_reviewer_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_reviewer_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_reviewer_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_reviewer_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_reviewer_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.notification_reviewer_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.notification_reviewer_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.notification_reviewer_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.notification_reviewer_name.typography.text_decoration', ''),
                    ),
                ),
                'notification_title' => array(
                    'selector' => $notificationPrefix.' .wpsr-reviews-notification-card .wpsr-notification-content-wrapper .wpsr-review-header p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.notification_title.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.notification_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.notification_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.notification_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.notification_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.notification_title.typography.text_decoration', ''),
                    ),
                ),
                'notification_review_time' => array(
                    'selector' => $notificationPrefix.' .wpsr-reviews-notification-card .wpsr-notification-content-wrapper .wpsr-notification-footer .review-time',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.notification_review_time.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.notification_review_time.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_review_time.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_review_time.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_review_time.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_review_time.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_review_time.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.notification_review_time.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_review_time.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_review_time.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.notification_review_time.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.notification_review_time.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.notification_review_time.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.notification_review_time.typography.text_decoration', ''),
                    ),
                ),
                'notification_wrapper_box' => array(
                    'selector' => $notificationPrefix.'.wpsr-reviews-notification-card-wrapper.active',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.notification_wrapper_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.notification_wrapper_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.notification_wrapper_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.notification_wrapper_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.notification_wrapper_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.notification_wrapper_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.notification_wrapper_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.notification_wrapper_box.border.border_color', ''),
                    ),

                ),
                'pagination' => array(
                    'selector' => $prefix.' .wpsr-reviews-loadmore span',
                    'color'  => array(
                        'color' => Arr::get($settings,'styles.pagination.color.color', ''),
                        'background_color' => Arr::get($settings,'styles.pagination.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.pagination.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.pagination.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.pagination.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.pagination.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.pagination.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.pagination.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.pagination.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.pagination.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.pagination.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.pagination.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.pagination.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.pagination.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.pagination.border.border_color', ''),
                    ),

                ),
            ),
        ];
    }
}
