<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Twitter;

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
                    'title'     => __('User Name', 'wp-social-reviews'),
                    'key'      => 'user_name',
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
                    'key'      => 'description',
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
                    'title'     => __('Location', 'wp-social-reviews'),
                    'key'      => 'location',
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
                    'title'     => __('Statistics Label', 'wp-social-reviews'),
                    'key'      => 'statistics_label',
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
                    'title'     => __('Statistics Count', 'wp-social-reviews'),
                    'key'      => 'statistics_count',
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
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Box', 'wp-social-reviews'),
                    'key'      => 'info_wrapper',
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
                'title' => __('Name', 'wp-social-reviews'),
                'key'  => 'name',
                array(
                    'title'     => __('Author', 'wp-social-reviews'),
                    'key'      => 'author',
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
                )
            ),
            'meta' => array(
                'title' => __('Meta', 'wp-social-reviews'),
                'key'  => 'meta',
                array(
                    'title'     => __('Username', 'wp-social-reviews'),
                    'key'      => 'username',
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
                    'title'     => __('Date', 'wp-social-reviews'),
                    'key'      => 'tweet_date',
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
                    'title'     => '',
                    'key'      => 'tweet_meta',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => false,
                    'styles' => []
                )
            ),
            'content' => array(
                'title' => __('Content', 'wp-social-reviews'),
                'key'  => 'content',
                array(
                    'title'     => __('Text', 'wp-social-reviews'),
                    'key'      => 'tweet',
                    'divider' => true,
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
                    'title'     => __('Hashtag', 'wp-social-reviews'),
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
                )
            ),
            'action' => array(
                'title' => __('Action', 'wp-social-reviews'),
                'key'  => 'action',
                array(
                    'title'     => __('Label', 'wp-social-reviews'),
                    'key'      => 'action_text',
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
                    'title'     => __('Icon', 'wp-social-reviews'),
                    'key'      => 'action_icon',
                    'divider' => true,
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
                    'title'     => '',
                    'key'      => 'action_wrapper',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => false,
                    'styles' => []
                )
            ),
        );
    }

    public function formatStylesConfig($settings = [], $postId = null)
    {
        $prefix = '.wpsr-tw-feed-template-'.$postId;
        return [
            'styles' => array(
                'full_name' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
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
                'user_name' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
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
                ),
                'description' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.description.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.description.typography.text_decoration', ''),
                    ),
                ),
                'location' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.location.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.location.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.location.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.location.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.location.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.location.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.location.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.location.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.location.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.location.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.location.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.location.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.location.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.location.typography.text_decoration', ''),
                    ),
                ),
                'statistics_label' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.statistics_label.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.statistics_label.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_label.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_label.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics_label.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_label.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_label.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics_label.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_label.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_label.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.statistics_label.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.statistics_label.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.statistics_label.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.statistics_label.typography.text_decoration', ''),
                    ),
                ),
                'statistics_count' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.statistics_count.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.statistics_count.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_count.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_count.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics_count.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_count.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_count.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.statistics_count.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.statistics_count.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.statistics_count.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.statistics_count.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.statistics_count.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.statistics_count.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.statistics_count.typography.text_decoration', ''),
                    ),
                ),
                'follow_button' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info-head .wpsr-twitter-user-follow-btn',
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
                'info_wrapper' => array(
                    'selector' => $prefix .' .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.info_wrapper.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.info_wrapper.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.info_wrapper.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.info_wrapper.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.info_wrapper.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.info_wrapper.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.info_wrapper.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.info_wrapper.border.border_color', ''),
                    ),
                ),
                'author' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.author.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.author.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.author.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.author.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.author.typography.text_decoration', ''),
                    ),
                ),
                'username' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-user-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.username.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.username.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.username.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.username.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.username.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.username.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.username.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.username.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.username.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.username.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.username.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.username.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.username.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.username.typography.text_decoration', ''),
                    ),
                ),
                'tweet_date' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-time',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.tweet_date.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.tweet_date.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_date.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_date.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.tweet_date.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_date.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_date.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.tweet_date.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_date.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_date.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.tweet_date.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.tweet_date.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.tweet_date.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.tweet_date.typography.text_decoration', ''),
                    ),
                ),
                'tweet_meta' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info',
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.tweet_meta.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_meta.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_meta.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.tweet_meta.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_meta.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_meta.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.tweet_meta.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_meta.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_meta.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.tweet_meta.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet_meta.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet_meta.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.tweet_meta.padding.linked', false),
                    ),
                ),
                'tweet' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.tweet.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.tweet.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.tweet.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.tweet.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.tweet.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.tweet.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.tweet.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.tweet.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.tweet.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.tweet.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.tweet.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.tweet.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tweet.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tweet.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.tweet.padding.linked', false),
                    ),
                ),
                'hashtag' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.hashtag.color.text_color', ''),
                    ),
                ),
                'action_wrapper' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions',
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.action_wrapper.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_wrapper.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_wrapper.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.action_wrapper.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_wrapper.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_wrapper.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.action_wrapper.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_wrapper.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_wrapper.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.action_wrapper.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_wrapper.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_wrapper.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.action_wrapper.padding.linked', false),
                    ),
                ),
                'action_text' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.action_text.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.action_text.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_text.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_text.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.action_text.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_text.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_text.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.action_text.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.action_text.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.action_text.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.action_text.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.action_text.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.action_text.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.action_text.typography.text_decoration', ''),
                    ),

                ),
                'action_icon' => array(
                    'selector' => $prefix .' .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a svg',
                    'color'  => array(
                        'fill_color' => Arr::get($settings,'styles.action_icon.color.fill_color', ''),
                    ),
                ),
            ),
        ];
    }
}
