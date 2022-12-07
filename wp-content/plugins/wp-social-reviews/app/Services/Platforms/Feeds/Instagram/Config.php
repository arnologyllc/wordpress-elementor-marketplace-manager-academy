<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

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
                    'title'     => __('User Name', 'wp-social-reviews'),
                    'key'      => 'user_name',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'wp-social-reviews'),
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
                array(
                    'title'     => __('Statistics', 'wp-social-reviews'),
                    'key'      => 'account_statistics_number',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Number Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'account_statistics',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Between Item', 'wp-social-reviews'),
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
                array(
                    'title'     => __('Full Name', 'wp-social-reviews'),
                    'key'      => 'full_name',
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
                    'title'     => __('Description', 'wp-social-reviews'),
                    'key'      => 'account_description',
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
                    'title'     => __('Follow Button', 'wp-social-reviews'),
                    'key'      => 'follow_button',
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
                            'title'      => __('Button Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Box', 'wp-social-reviews'),
                    'key'      => 'account_info_wrapper',
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
            'content' => array(
                'title' => __('Content', 'wp-social-reviews'),
                'key'  => 'content',
                array(
                    'key'      => 'hashtag',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Hashtag Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'content',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
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
            'statistics' => array(
                'title' => __('Statistics', 'wp-social-reviews'),
                'key'  => 'statistics',
                array(
                    'key'      => 'statistics_icon',
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
                    'key'      => 'statistics',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
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
                    'key'      => 'statistics_wrapper',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Between Item', 'wp-social-reviews'),
                    ),
                ),
            ),
            'popup' => array(
                'title' => __('Popup Box', 'wp-social-reviews'),
                'key'  => 'popup_box',
                array(
                    'title'     => __('User Name', 'wp-social-reviews'),
                    'key'      => 'popup_user_info_name',
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
                    'title'     => __('Post Description', 'wp-social-reviews'),
                    'key'      => 'popup_post_description',
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
                    'title'     => __('Post Time', 'wp-social-reviews'),
                    'key'      => 'popup_post_time',
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
                    'title'     => __('Call to action', 'wp-social-reviews'),
                    'key'      => 'popup_call_to_action',
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
            'content_box' => array(
                'title' => __('Review Box', 'wp-social-reviews'),
                'key'  => 'content_box',
                array(
                    'key'      => 'content_box',
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
        $prefix = '.wpsr-ig-feed-template-'.$postId;
        $popupPrefix = '.wpsr-ig-feed-popup-box-'.$postId;
        return [
            'styles' => array(
                'user_name' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-name a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.user_name.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.user_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.user_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.user_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.user_name.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.user_name.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.user_name.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.user_name.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'account_statistics_number' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item strong',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.account_statistics_number.color.text_color', '')
                    ),
                ),
                'account_statistics' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.account_statistics.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.account_statistics.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_statistics.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_statistics.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.account_statistics.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_statistics.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_statistics.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.account_statistics.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_statistics.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_statistics.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.account_statistics.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.account_statistics.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.account_statistics.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.account_statistics.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.account_statistics.slider.right.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.account_statistics.slider.right.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.account_statistics.slider.right.mobile', 0),
                        ),
                    ),
                ),
                'full_name' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.full_name.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.full_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.full_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.full_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.full_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.full_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.full_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.full_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.full_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.full_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.full_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.full_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.full_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.full_name.typography.text_decoration', ''),
                    ),
                ),
                'account_description' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.account_description.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.account_description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.account_description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.account_description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.account_description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.account_description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.account_description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.account_description.typography.text_decoration', ''),
                    ),
                ),
                'follow_button' => array(
                    'selector' => $prefix . ' .wpsr-ig-follow-btn a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.follow_button.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.follow_button.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.follow_button.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.follow_button.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.follow_button.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.follow_button.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.follow_button.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.follow_button.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.follow_button.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.follow_button.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.follow_button.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.follow_button.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.follow_button.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.follow_button.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.follow_button.typography.text_decoration', ''),
                    ),
                ),
                'account_info_wrapper' => array(
                    'selector' => $prefix . ' .wpsr-ig-header .wpsr-ig-header-inner',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.account_info_wrapper.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.account_info_wrapper.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.account_info_wrapper.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.account_info_wrapper.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.account_info_wrapper.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.account_info_wrapper.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.account_info_wrapper.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.account_info_wrapper.border.border_color', ''),
                    ),
                ),
                'content' => array(
                    'selector' => $prefix . ' .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p',
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
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.content.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.content.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.content.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.content.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.content.padding.linked', false),
                    ),
                ),
                'hashtag' => array(
                    'selector' => $prefix . ' .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.hashtag.color.text_color', ''),
                    ),
                ),
                'statistics' => array(
                    'selector' => $prefix . ' .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.statistics.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.statistics.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.statistics.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.statistics.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.statistics.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.statistics.padding.linked', false),
                    ),
                    'slider'  => array(
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.slider.right.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.statistics.slider.right.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.statistics.slider.right.mobile', 0),
                        ),
                    ),
                ),
                'statistics_icon' => array(
                    'selector' => $prefix . ' .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic svg',
                    'color'  => array(
                        'fill_color' => Arr::get($settings,'styles.statistics_icon.color.fill_color', ''),
                    )
                ),
                'statistics_wrapper' => array(
                    'selector' => $prefix . ' .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic',
                    'slider'  => array(
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.statistics_wrapper.slider.right.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.statistics_wrapper.slider.right.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.statistics_wrapper.slider.right.mobile', 0),
                        ),
                    ),
                ),
                'popup_user_info_name' => array(
                    'selector' => $popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-user-name a,' .$popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-comments-wrapper .wpsr-feed-popup-comment-text a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.popup_user_info_name.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.popup_user_info_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_user_info_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_user_info_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_user_info_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_user_info_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_user_info_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_user_info_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_user_info_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_user_info_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.popup_user_info_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.popup_user_info_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.popup_user_info_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.popup_user_info_name.typography.text_decoration', ''),
                    )
                ),
                'popup_post_description' => array(
                    'selector' => $popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-comments-wrapper .wpsr-feed-popup-comment-text p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.popup_post_description.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.popup_post_description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.popup_post_description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.popup_post_description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.popup_post_description.typography.text_decoration', ''),
                    )
                ),
                'popup_post_time' => array(
                    'selector' => $popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-comments-wrapper .wpsr-feed-popup-comment-meta time,' .$popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-statistics-date a' ,
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.popup_post_time.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_time.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_time.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_time.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_time.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_time.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_time.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_post_time.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_post_time.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_post_time.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.popup_post_time.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.popup_post_time.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.popup_post_time.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.popup_post_time.typography.text_decoration', ''),
                    )
                ),
                'popup_call_to_action' => array(
                    'selector' => $popupPrefix . ' .wpsr-feed-popup-box-wraper .wpsr-feed-popup-box-wraper-inner .wpsr-feed-popup-box-content .wpsr-feed-popup-view-post-cta a' ,
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.popup_call_to_action.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.popup_call_to_action.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_call_to_action.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_call_to_action.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_call_to_action.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_call_to_action.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_call_to_action.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.popup_call_to_action.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.popup_call_to_action.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.popup_call_to_action.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.popup_call_to_action.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.popup_call_to_action.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.popup_call_to_action.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.popup_call_to_action.typography.text_decoration', ''),
                    )
                ),
                'pagination' => array(
                    'selector' => $prefix . ' .wpsr_more',
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
                'content_box' => array(
                    'selector' => $prefix . ' .wpsr-ig-post-info',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.content_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.content_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.content_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.content_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.content_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.content_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.content_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.content_box.border.border_color', ''),
                    ),

                ),
            ),
        ];
    }
}
