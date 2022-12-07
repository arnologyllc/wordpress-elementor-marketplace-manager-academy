<?php
namespace WPSocialReviews\App\Services\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FacebookFeedWidget extends Widget_Base
{
    public function get_name() {
        return 'wp-social-ninja-facebook-feed-widget';
    }

    public function get_title() {
        return __( 'Social Ninja Facebook Feed', 'wp-social-reviews' );
    }

    public function get_icon() {
        return 'eicon-facebook';
    }

    public function get_keywords() {
        return [
            'wpsocialninja',
            'wp social ninja',
            'social ninja',
            'facebook',
            'feed',
            'facebook feed'
        ];
    }

    public function get_categories() {
        return array('wp-social-reviews');
    }

    public function get_style_depends() {
        return ['wp_social_ninja_fb'];
    }

    public function get_script_depends() {
        return [];
    }

    protected function register_controls()
    {
        $this->register_general_controls();
        $this->register_header_style_controls();
        $this->register_content_style_controls();
        $this->register_button_style_controls();
        $this->register_pagination_style_controls();
        $this->register_box_style_controls();
    }

    protected function register_general_controls(){
        $platforms = ['facebook_feed'];

        $this->start_controls_section(
            'section_social_ninja_facebook_feed_templates',
            [
                'label' => __('Social Ninja Facebook Feed', 'wp-social-reviews'),
            ]
        );

        $this->add_control(
            'fb_feed_template_list',
            [
                'label' => __('Select a Template', 'wp-social-reviews'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => Helper::getTemplates($platforms),
                'default' => '0',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_pagination_style_controls(){

        $this->start_controls_section(
            'section_fb_feed_pagination_style',
            [
                'label' => __('Pagination', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fb_feed_pagination_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_pagination_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fb_feed_pagination_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_pagination_margin',
            [
                'label' => esc_html__('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fb_feed_pagination_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fb_feed_pagination_border',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_control(
            'fb_feed_pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fb_feed_pagination_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_button_style_controls()
    {
        $this->start_controls_section(
            'section_fb_feed_button_style',
            [
                'label' => __('Like and Share Button', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fb_feed_button_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_button_icon_color',
            [
                'label' => __('Icon Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a svg path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_button_background_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a ' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_button_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'wp-social-reviews'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fb_feed_button_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_content_style_controls()
    {
        $this->start_controls_section(
            'section_fb_feed_content_style',
            [
                'label' => __('Content', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fb_feed_header_author',
            [
                'label' => __('Author', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_author_text_color',
            [
                'label' => __('Name Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-author .wpsr-fb-feed-author-info a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_author_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
            ]
        );

        $this->add_control(
            'fb_feed_header_post_date',
            [
                'label' => __('Post Date', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_post_date_color',
            [
                'label' => __('Date Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpsr-fb-feed-author .wpsr-fb-feed-time' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_post_date_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item, {{WRAPPER}} .wpsr-fb-feed-author .wpsr-fb-feed-time',
            ]
        );

        $this->add_control(
            'fb_feed_header_post_title',
            [
                'label' => __('Post Title', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'fb_feed_post_title_color',
            [
                'label' => __('Title Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fb_feed_post_title_hover_color',
            [
                'label' => __('Title Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_post_title_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3',
            ]
        );


        $this->add_control(
            'fb_feed_header_post',
            [
                'label' => __('Post Text', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );


        $this->add_control(
            'fb_feed_content_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-inner p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_content_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-inner p',
            ]
        );

        $this->add_control(
            'fb_feed_content_text_link_color',
            [
                'label' => __('Link Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-inner p a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_content_text_link_hover_color',
            [
                'label' => __('Link Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-inner p a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_content_text_read_more_link_color',
            [
                'label' => __('Read More Link Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less' => 'color: {{VALUE}}; text-decoration-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_summary_card',
            [
                'label' => __('Summary Card', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_content_summary_card_domain_color',
            [
                'label' => __('Domain Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_content_summary_card_domain_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_summary_card_domain_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'wp-social-reviews'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_content_summary_card_title_color',
            [
                'label' => __('Title Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_content_summary_card_title_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_summary_card_title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'wp-social-reviews'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_content_summary_card_description_color',
            [
                'label' => __('Description Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_content_summary_card_description_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_header_style_controls() {
        $this->start_controls_section(
            'section_fb_feed_header_style',
            [
                'label' => __('Header', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fb_feed_header_username_title',
            [
                'label' => __('UserName', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_header_username_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_header_username_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_header_username_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'wp-social-reviews'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_header_description',
            [
                'label' => __('Description', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_header_description_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_header_description_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
            ]
        );

        $this->add_responsive_control(
            'fb_feed_header_description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'wp-social-reviews'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fb_feed_header_likes',
            [
                'label' => __('Likes', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'fb_feed_header_likes_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_feed_header_likes_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
            ]
        );

        $this->add_control(
            'fb_feed_header_box_title',
            [
                'label' => __('Box', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fb_feed_header_bg_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'fb_feed_header_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fb_feed_header_box_border',
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper',
            ]
        );

        $this->add_control(
            'fb_feed_header_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fb_feed_header_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_box_style_controls(){

        $this->start_controls_section(
            'section_fb_box_style',
            [
                'label' => __('Item Box', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fb_box_platform_color',
            [
                'label' => __('Platform Icon Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-author .wpsr-fb-feed-platform' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fb_box_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-inner',
            ]
        );

        $this->add_responsive_control(
            'fb_box_margin',
            [
                'label' => esc_html__('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fb_box_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fb_box_border',
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-inner,{{WRAPPER}} .wpsr-fb-photo_feed .wpsr-fb-feed-item .wpsr-fb-feed-image',
            ]
        );

        $this->add_control(
            'fb_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpsr-fb-photo_feed .wpsr-fb-feed-item .wpsr-fb-feed-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fb_box_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-fb-feed-item .wpsr-fb-feed-inner, {{WRAPPER}} .wpsr-fb-photo_feed .wpsr-fb-feed-item .wpsr-fb-feed-image',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        if(!empty($fb_feed_template_list)){
            echo do_shortcode('[wp_social_ninja id="' . $fb_feed_template_list . '" platform="facebook_feed"]');
        }
    }

}