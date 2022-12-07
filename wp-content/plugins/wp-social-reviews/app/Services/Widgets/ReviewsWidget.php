<?php
namespace WPSocialReviews\App\Services\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ReviewsWidget extends Widget_Base {

    public function get_name() {
        return 'wp-social-ninja-reviews-widget';
    }

    public function get_title() {
        return __( 'Social Ninja Reviews', 'wp-social-reviews' );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_keywords() {
        return apply_filters('wpsocialreviews/elementor_keywords', [
            'wpsocialninja',
            'wp social ninja',
            'social ninja',
            'social reviews',
            'reviews',
            'google',
            'facebook',
            'airbnb',
            'yelp',
            'tripadvisor',
            'aliexpress',
            'booking.com',
            'amazon',
        ]);
    }

    public function get_categories() {
        return array('wp-social-reviews');
    }

    public function get_style_depends() {
        return ['wp_social_ninja_reviews'];
    }

    public function get_script_depends() {
        return [];
    }

    protected function register_controls()
    {
        $this->register_general_controls();
        $this->register_reviewer_header_style_controls();
        $this->register_reviewer_name_style_controls();
        $this->register_title_style_controls();
        $this->register_review_text_style_controls();
        $this->register_review_readmore_less_style_controls();
        $this->register_review_date_style_controls();
        $this->register_review_platform_name_style_controls();
        $this->register_pagination_style_controls();
        $this->register_review_box_style_controls();
    }

    protected function register_general_controls(){
        $platforms = ['twitter', 'youtube', 'instagram'];

        $this->start_controls_section(
            'section_social_ninja_reviews_templates',
            [
                'label' => __('Social Ninja Reviews', 'wp-social-reviews'),
            ]
        );

        $this->add_control(
            'reviews_template_list',
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

    protected function register_reviewer_header_style_controls()
    {
        $this->start_controls_section(
            'section_reviews_header_style',
            [
                'label' => __('Header/Business Info', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'reviews_header_rating_text_color',
            [
                'label' => __('Rating Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info .wpsr-total-rating' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpsr-business-info .wpsr-total-reviews span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'reviews_header_heading_title',
            [
                'label' => __('Write a Review Button', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'reviews_header_war_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info a.wpsr-write-review' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'reviews_header_war_bg_color',
            [
                'label' => __('Button Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info a.wpsr-write-review' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'reviews_header_bg_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'reviews_header_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'reviews_header_box_border',
                'selector' => '{{WRAPPER}} .wpsr-business-info',
            ]
        );

        $this->add_control(
            'reviews_header_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-business-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'reviews_header_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-business-info',
            ]
        );

        $this->end_controls_section();

    }

    protected function register_reviewer_name_style_controls()
    {
        $this->start_controls_section(
            'section_reviewer_name_style',
            [
                'label' => __('Reviewer Name', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'reviewer_name_alignment',
            [
                'label' => __('Alignment', 'wp-social-reviews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-info a .wpsr-reviewer-name' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reviewer_name_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-info a .wpsr-reviewer-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviewer_name_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-review-info a .wpsr-reviewer-name',
            ]
        );

        $this->add_responsive_control(
            'reviewer_name_margin',
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
                    '{{WRAPPER}} .wpsr-review-info a .wpsr-reviewer-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'reviewer_name_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-info a .wpsr-reviewer-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_title_style_controls()
    {
        $this->start_controls_section(
            'section_reviews_title_style',
            [
                'label' => __('Title', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'reviews_title_alignment',
            [
                'label' => __('Alignment', 'wp-social-reviews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reviews_title_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviews_title_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-review-title',
            ]
        );

        $this->add_responsive_control(
            'reviews_title_margin',
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
                    '{{WRAPPER}} .wpsr-review-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'reviews_title_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_review_date_style_controls()
    {
        $this->start_controls_section(
            'section_review_date_style',
            [
                'label' => __('Review Date', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'review_date_alignment',
            [
                'label' => __('Alignment', 'wp-social-reviews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template .wpsr-review-date' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'review_date_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template .wpsr-review-date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'review_date_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-review-template .wpsr-review-date',
            ]
        );

        $this->add_responsive_control(
            'review_date_margin',
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
                    '{{WRAPPER}} .wpsr-review-template .wpsr-review-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'review_date_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template .wpsr-review-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_review_text_style_controls()
    {
        $this->start_controls_section(
            'section_reviews_content_style',
            [
                'label' => __('Content', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'reviews_content_alignment',
            [
                'label' => __('Alignment', 'wp-social-reviews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'wp-social-reviews'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-content p' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reviews_content_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviews_content_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-review-content p',
            ]
        );

        $this->add_responsive_control(
            'reviews_content_margin',
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
                    '{{WRAPPER}} .wpsr-review-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'reviews_content_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_review_readmore_less_style_controls()
    {
        $this->start_controls_section(
            'section_reviews_read_more_less_style',
            [
                'label' => __('Read More/Less', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'reviews_read_more_less_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr_add_read_more .wpsr_read_more, {{WRAPPER}} .wpsr_add_read_more .wpsr_read_less' => 'color: {{VALUE}}; text-decoration-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reviews_read_more_less_text_hover_color',
            [
                'label' => __('Hover Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr_add_read_more .wpsr_read_more:hover, {{WRAPPER}} .wpsr_add_read_more .wpsr_read_less:hover' => 'color: {{VALUE}}; text-decoration-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviews_read_more_less_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr_add_read_more .wpsr_read_more,{{WRAPPER}} .wpsr_add_read_more .wpsr_read_less',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_review_platform_name_style_controls()
    {
        $this->start_controls_section(
            'section_review_platform_name_style',
            [
                'label' => __('Platform Name', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'review_platform_name_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-platform span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'review_platform_name_text_bg_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-platform span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'review_platform_name_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-review-platform span',
            ]
        );

        $this->add_responsive_control(
            'review_platform_name_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-platform span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_pagination_style_controls(){

        $this->start_controls_section(
            'section_reviews_pagination_style',
            [
                'label' => __('Pagination', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviews_pagination_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr_more span',
            ]
        );

        $this->add_control(
            'reviews_pagination_text_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'reviews_pagination_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr_more span',
            ]
        );

        $this->add_responsive_control(
            'reviews_pagination_margin',
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
            'reviews_pagination_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'reviews_pagination_border',
                'selector' => '{{WRAPPER}} .wpsr_more span',
            ]
        );

        $this->add_control(
            'reviews_pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr_more span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'reviews_pagination_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr_more span',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_review_box_style_controls(){

        $this->start_controls_section(
            'section_review_box_style',
            [
                'label' => __('Review Box', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'review_box_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr-review-template',
            ]
        );

        $this->add_responsive_control(
            'review_box_margin',
            [
                'label' => esc_html__('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'review_box_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'review_box_border',
                'selector' => '{{WRAPPER}} .wpsr-review-template',
            ]
        );

        $this->add_control(
            'review_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-review-template' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'review_box_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-review-template',
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
        if(!empty($reviews_template_list)){
            echo do_shortcode('[wp_social_ninja id="' . $reviews_template_list . '" platform="reviews"]');
        }
    }
}
