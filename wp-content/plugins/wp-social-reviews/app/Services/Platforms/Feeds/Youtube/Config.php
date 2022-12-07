<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Youtube;

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
                    'title'     => __('Channel Name', 'wp-social-reviews'),
                    'key'      => 'channel_name',
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
                    'key'      => 'channel_name_wrapper',
                    'divider' => true,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Bottom', 'wp-social-reviews'),
                    ),
                ),
                array(
                    'title'     => __('Statistics', 'wp-social-reviews'),
                    'key'      => 'statistics',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Between Items', 'wp-social-reviews'),
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
                    'title'     => __('Description', 'wp-social-reviews'),
                    'key'      => 'header_description',
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
                    'title'     => __('Subscribe Button', 'wp-social-reviews'),
                    'key'      => 'subscribe_button',
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
                    'key'      => 'header_box',
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
                )
            ),
            'name' => array(
                'title' => __('Title', 'wp-social-reviews'),
                'key'  => 'name',
                array(
                    'key'      => 'video_title',
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
                )
            ),
            'statistics' => array(
                'title' => __('Statistics', 'wp-social-reviews'),
                'key'  => 'video_statistics',
                array(
                    'key'      => 'video_statistics',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Spacing Between Items', 'wp-social-reviews'),
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
            'description' => array(
                'title' => __('Description', 'wp-social-reviews'),
                'key'  => 'description',
                array(
                    'key'      => 'video_description',
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
                )
            ),
            'pagination' => array(
                'title' => __('Pagination', 'wp-social-reviews'),
                'key'  => 'pagination',
                array(
                    'key'      => 'youtube_pagination',
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
                )
            ),
            'item' => array(
                'title' => __('Item Box', 'wp-social-reviews'),
                'key'  => 'item_box',
                array(
                    'key'      => 'item_box',
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
        );
    }

    public function formatStylesConfig($settings = [], $postId = null)
    {
        $prefix = '.wpsr-yt-feed-template-'.$postId;
        return [
            'styles' => array(
                'channel_name' => array(
                    'selector' => $prefix.' .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.channel_name.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.channel_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.channel_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.channel_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.channel_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.channel_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.channel_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.channel_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.channel_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.channel_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.channel_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.channel_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.channel_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.channel_name.typography.text_decoration', ''),
                    )
                ),
                'channel_name_wrapper' => array(
                    'selector' => $prefix.' .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-name',
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.channel_name_wrapper.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.channel_name_wrapper.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.channel_name_wrapper.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'statistics' => array(
                    'selector' => $prefix.' .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.statistics.color.text_color', '')
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
                    'slider'  => array(
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.statistics.slider.right.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.statistics.slider.right.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.statistics.slider.right.mobile', 0),
                        ),
                    ),
                ),
                'header_description' => array(
                    'selector' => $prefix.' .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.header_description.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.header_description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.header_description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.header_description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.header_description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.header_description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.header_description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.header_description.typography.text_decoration', ''),
                    )
                ),
                'subscribe_button' => array(
                    'selector' => $prefix.' .wpsr-yt-header-subscribe-btn a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.subscribe_button.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.subscribe_button.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.subscribe_button.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.subscribe_button.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.subscribe_button.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.subscribe_button.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.subscribe_button.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.subscribe_button.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.subscribe_button.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.subscribe_button.padding.linked', false),
                    ),
                ),
                'header_box' => array(
                    'selector' => $prefix. ' .wpsr-yt-header .wpsr-yt-header-inner',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.header_box.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.header_box.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.header_box.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.header_box.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.header_box.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.header_box.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.header_box.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.header_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.header_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.header_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.header_box.border.border_color', ''),
                    ),
                ),
                'video_title' => array(
                    'selector' => $prefix.' .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-playmode',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.video_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.video_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.video_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.video_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.video_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.video_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.video_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.video_title.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.video_title.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.video_title.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.video_title.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.video_title.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_title.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_title.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.video_title.padding.linked', false),
                    ),
                ),
                'video_statistics' => array(
                    'selector' => $prefix.' .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.video_statistics.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.video_statistics.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.video_statistics.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.video_statistics.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.video_statistics.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_statistics.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_statistics.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.video_statistics.padding.linked', false),
                    ),
                    'slider'  => array(
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.video_statistics.slider.right.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.video_statistics.slider.right.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.video_statistics.slider.right.mobile', 0),
                        ),
                    ),
                ),
                'video_description' => array(
                    'selector' => $prefix.' .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-description',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.video_description.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.video_description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.video_description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.video_description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.video_description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.video_description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.video_description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.video_description.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.video_description.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.video_description.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.video_description.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.video_description.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.video_description.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.video_description.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.video_description.padding.linked', false),
                    ),
                ),
                'youtube_pagination' => array(
                    'selector' => $prefix.' .wpsr_more',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.youtube_pagination.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.youtube_pagination.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.youtube_pagination.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.youtube_pagination.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.youtube_pagination.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.youtube_pagination.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.youtube_pagination.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.youtube_pagination.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.youtube_pagination.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.youtube_pagination.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.youtube_pagination.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.youtube_pagination.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.youtube_pagination.border.border_color', ''),
                    ),

                ),
                'item_box' => array(
                    'selector' => $prefix.' .wpsr-yt-video-info',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.item_box.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.item_box.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.item_box.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.item_box.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.item_box.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.item_box.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.item_box.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.item_box.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.item_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.item_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.item_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.item_box.border.border_color', ''),
                    ),

                ),
            ),
        ];
    }
}
