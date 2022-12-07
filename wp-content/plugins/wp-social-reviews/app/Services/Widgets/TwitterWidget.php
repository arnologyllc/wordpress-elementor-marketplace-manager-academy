<?php
namespace WPSocialReviews\App\Services\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TwitterWidget extends Widget_Base {

    public function get_name() {
        return 'wp-social-ninja-twitter-widget';
    }

    public function get_title() {
        return __( 'Social Ninja Twitter', 'wp-social-reviews' );
    }

    public function get_icon() {
        return 'eicon-twitter-feed';
    }

    public function get_keywords() {
        return [
            'wpsocialninja',
            'wp social ninja',
            'social ninja',
            'twitter',
            'feed',
            'twitter feed'
        ];
    }

    public function get_categories() {
        return array('wp-social-reviews');
    }

    public function get_style_depends() {
        return ['wp_social_ninja_tw'];
    }

    public function get_script_depends() {
        return [];
    }

    protected function register_controls()
    {
        $this->register_general_controls();
        $this->register_tw_header_style_controls();
        $this->register_name_style_controls();
        $this->register_meta_style_controls();
        $this->register_tw_content_style_controls();
        $this->register_tw_actions_style_controls();
        $this->register_pagination_style_controls();
        $this->register_tw_box_style_controls();
    }

    protected function register_general_controls(){
        $platforms = ['twitter'];
        $this->start_controls_section(
            'section_social_ninja_twitter_templates',
            [
                'label' => __('Social Ninja Twitter Feed', 'wp-social-reviews'),
            ]
        );

        $this->add_control(
            'twitter_template_list',
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

    protected function register_tw_header_style_controls()
    {
        $this->start_controls_section(
            'section_tw_header_style',
            [
                'label' => __('Header', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tw_header_name',
            [
                'label' => __('Full Name', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tw_header_name_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_name_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
            ]
        );

        $this->add_responsive_control(
            'tw_header_name_spacing',
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
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tw_header_username',
            [
                'label' => __('UserName', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tw_header_username_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_username_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
            ]
        );

        $this->add_responsive_control(
            'tw_header_username_spacing',
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
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tw_header_description_title',
            [
                'label' => __('Description', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tw_header_description_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_header_description_link_color',
            [
                'label' => __('Link Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_description_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
            ]
        );

        $this->add_responsive_control(
            'tw_header_description_spacing',
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
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tw_header_location',
            [
                'label' => __('Location', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tw_header_location_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_location_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
            ]
        );

        $this->add_responsive_control(
            'tw_header_location_spacing',
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
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tw_header_statistics_label_title',
            [
                'label' => __('Statistics Label', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tw_header_statistics_label_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_statistics_label_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
            ]
        );

        $this->add_responsive_control(
            'tw_header_statistics_label_spacing',
            [
                'label' => esc_html__('Spacing Between Item', 'wp-social-reviews'),
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
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tw_header_statistics_count_title',
            [
                'label' => __('Statistics Count', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tw_header_statistics_count_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_statistics_count_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data',
            ]
        );

        $this->add_control(
            'tw_header_follow_btn_title',
            [
                'label' => __('Follow Button', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tw_header_follow_btn_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_header_follow_btn_bg_color',
            [
                'label' => __('Button Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_header_follow_btn_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-follow-btn',
            ]
        );

        $this->add_control(
            'tw_header_box_title',
            [
                'label' => __('Box', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tw_header_bg_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_header_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tw_header_box_border',
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper',
            ]
        );

        $this->add_control(
            'tw_header_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tw_header_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_name_style_controls(){
        $this->start_controls_section(
            'section_tw_name_style',
            [
                'label' => __('Name', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tw_name_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tw_name_hover_text_color',
            [
                'label' => __('Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_name_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_meta_style_controls()
    {
        $this->start_controls_section(
            'section_tw_meta_style',
            [
                'label' => __('Meta', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tw_meta_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_meta_text_hover_color',
            [
                'label' => __('Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_meta_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name, {{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time',
            ]
        );

        $this->add_responsive_control(
            'tw_meta_spacing',
            [
                'label' => esc_html__('Spacing Between Item', 'wp-social-reviews'),
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
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-time' => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-time:before' => 'left: calc({{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_meta_margin',
            [
                'label' => __('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'placeholder' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-tweet-author-links' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_meta_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-tweet-author-links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_tw_content_style_controls()
    {
        $this->start_controls_section(
            'section_tw_content_style',
            [
                'label' => __('Content', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tw_content_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_content_text_hashtag_color',
            [
                'label' => __('Hashtag Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_content_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p',
            ]
        );

        $this->add_responsive_control(
            'tw_content_margin',
            [
                'label' => __('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'placeholder' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_content_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_tw_actions_style_controls()
    {
        $this->start_controls_section(
            'section_tw_actions_style',
            [
                'label' => __('Actions', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tw_actions_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_actions_icon_color',
            [
                'label' => __('Icon Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_actions_icon_bg_color',
            [
                'label' => __('Icon Hover Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a:hover svg' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tw_actions_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a:hover svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_actions_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a',
            ]
        );

        $this->add_responsive_control(
            'tw_actions_margin',
            [
                'label' => __('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'placeholder' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_actions_spacing',
            [
                'label' => esc_html__('Spacing Between Item', 'wp-social-reviews'),
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
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_pagination_style_controls(){

        $this->start_controls_section(
            'section_tw_pagination_style',
            [
                'label' => __('Pagination', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tw_pagination_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_control(
            'tw_pagination_text_color',
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
            Group_Control_Background::get_type(),
            [
                'name' => 'tw_pagination_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_responsive_control(
            'tw_pagination_margin',
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
            'tw_pagination_padding',
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
                'name' => 'tw_pagination_border',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_control(
            'tw_pagination_border_radius',
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
                'name' => 'tw_pagination_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_tw_box_style_controls(){

        $this->start_controls_section(
            'section_tw_box_style',
            [
                'label' => __('Item Box', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tw_box_platform_color',
            [
                'label' => __('Platform Icon Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-logo svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tw_box_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet',
            ]
        );

        $this->add_responsive_control(
            'tw_box_margin',
            [
                'label' => esc_html__('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tw_box_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tw_box_border',
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet',
            ]
        );

        $this->add_control(
            'tw_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tw_box_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet',
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
        if(!empty($twitter_template_list)){
            echo do_shortcode('[wp_social_ninja id="' . $twitter_template_list . '" platform="twitter"]');
        }
    }
}