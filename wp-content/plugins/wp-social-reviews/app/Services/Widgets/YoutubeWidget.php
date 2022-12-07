<?php
namespace WPSocialReviews\App\Services\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Color as Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class YoutubeWidget extends Widget_Base {
    public function get_name() {
        return 'wp-social-ninja-youtube-widget';
    }

    public function get_title() {
        return __( 'Social Ninja YouTube', 'wp-social-reviews' );
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_keywords() {
        return [
            'wpsocialninja',
            'wp social ninja',
            'social ninja',
            'youtube feed',
            'feeds',
            'youtube',
        ];
    }

    public function get_categories() {
        return array('wp-social-reviews');
    }

    public function get_style_depends() {
        return ['wp_social_ninja_yt'];
    }

    public function get_script_depends() {
        return [];
    }

    protected function register_controls()
    {
        $this->register_general_controls();
        $this->register_yt_header_style_controls();
        $this->register_title_style_controls();
        $this->register_statistics_style_controls();
        $this->register_description_style_controls();
        $this->register_pagination_style_controls();
        $this->register_item_box_style_controls();
    }

    protected function register_general_controls(){
        $platforms = ['youtube'];
        $this->start_controls_section(
            'section_social_ninja_yt_templates',
            [
                'label' => __('Social Ninja Youtube', 'wp-social-reviews'),
            ]
        );

        $this->add_control(
            'yt_template_list',
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

    protected function register_yt_header_style_controls()
    {
        $this->start_controls_section(
            'section_yt_header_style',
            [
                'label' => __('Header', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'yt_header_channel_name',
            [
                'label' => __('Channel Name', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'yt_header_channel_name_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-name a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_header_channel_name_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-name a',
            ]
        );

        $this->add_responsive_control(
            'yt_header_channel_name_spacing',
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
                    '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'yt_header_statistics_title',
            [
                'label' => __('Statistics', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'yt_header_statistics_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_header_statistics_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
            ]
        );

        $this->add_responsive_control(
            'yt_header_statistics_spacing',
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
                    '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item:after' => 'margin: 0 calc({{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_control(
            'yt_header_description_title',
            [
                'label' => __('Description', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'yt_header_description_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_header_description_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
            ]
        );

        $this->add_control(
            'yt_header_subscribe_btn_title',
            [
                'label' => __('Subscribe Button', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'yt_header_subscribe_btn_color',
            [
                'label' => __('Text Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header-subscribe-btn a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'yt_header_subscribe_btn_bg_color',
            [
                'label' => __('Button Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header-subscribe-btn a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_header_subscribe_btn_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-header-subscribe-btn a',
            ]
        );

        $this->add_control(
            'yt_header_box_title',
            [
                'label' => __('Box', 'wp-social-reviews'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'yt_header_bg_color',
            [
                'label' => __('Background Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header .wpsr-yt-header-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'yt_header_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header .wpsr-yt-header-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'yt_header_box_border',
                'selector' => '{{WRAPPER}} .wpsr-yt-header .wpsr-yt-header-inner',
            ]
        );

        $this->add_control(
            'yt_header_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-header .wpsr-yt-header-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'yt_header_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-yt-header .wpsr-yt-header-inner',
            ]
        );

        $this->end_controls_section();

    }

    protected function register_title_style_controls()
    {
        $this->start_controls_section(
            'section_yt_title_style',
            [
                'label' => __('Title', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'yt_title_alignment',
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
                    '{{WRAPPER}} .wpsr-yt-video-info h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'yt_title_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video-info h3 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_title_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-video-info h3',
            ]
        );

        $this->add_responsive_control(
            'yt_title_margin',
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
                    '{{WRAPPER}} .wpsr-yt-video-info h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'yt_title_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video-info h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_statistics_style_controls()
    {
        $this->start_controls_section(
            'section_yt_statistics_style',
            [
                'label' => __('Statistics', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

//        $this->add_responsive_control(
//            'yt_statistics_alignment',
//            [
//                'label' => __('Alignment', 'wp-social-reviews'),
//                'type' => Controls_Manager::CHOOSE,
//                'options' => [
//                    'left' => [
//                        'title' => __('Left', 'wp-social-reviews'),
//                        'icon' => 'fa fa-align-left',
//                    ],
//                    'center' => [
//                        'title' => __('Center', 'wp-social-reviews'),
//                        'icon' => 'fa fa-align-center',
//                    ],
//                    'right' => [
//                        'title' => __('Right', 'wp-social-reviews'),
//                        'icon' => 'fa fa-align-right',
//                    ],
//                ],
//                'default' => '',
//                'selectors' => [
//                    '{{WRAPPER}} .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item' => 'text-align: {{VALUE}};',
//                ],
//            ]
//        );

        $this->add_control(
            'yt_statistics_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_statistics_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-video-statistic-item',
            ]
        );

        $this->add_responsive_control(
            'yt_statistics_spacing',
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
                    '{{WRAPPER}} .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item:after' => 'margin: 0 calc({{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'yt_statistics_margin',
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
                    '{{WRAPPER}} .wpsr-yt-video-statistic-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'yt_statistics_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video-statistic-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_description_style_controls()
    {
        $this->start_controls_section(
            'section_yt_description_style',
            [
                'label' => __('Description', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'yt_description_alignment',
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
                    '{{WRAPPER}} .wpsr-yt-video-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'yt_description_text_color',
            [
                'label' => __('Color', 'wp-social-reviews'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_description_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr-yt-video-description',
            ]
        );

        $this->add_responsive_control(
            'yt_description_margin',
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
                    '{{WRAPPER}} .wpsr-yt-video-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'yt_description_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_pagination_style_controls(){

        $this->start_controls_section(
            'section_yt_pagination_style',
            [
                'label' => __('Pagination', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'yt_pagination_typography',
                'label' => __('Typography', 'wp-social-reviews'),
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_control(
            'yt_pagination_text_color',
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
                'name' => 'yt_pagination_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_responsive_control(
            'yt_pagination_margin',
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
            'yt_pagination_padding',
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
                'name' => 'yt_pagination_border',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->add_control(
            'yt_pagination_border_radius',
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
                'name' => 'yt_pagination_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr_more',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_item_box_style_controls(){
        $this->start_controls_section(
            'section_yt_box_style',
            [
                'label' => __('Item Box', 'wp-social-reviews'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_box_background',
                'label' => __( 'Background', 'wp-social-reviews' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpsr-yt-video-info',
            ]
        );

        $this->add_responsive_control(
            'item_box_margin',
            [
                'label' => esc_html__('Margin', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_box_padding',
            [
                'label' => esc_html__('Padding', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video .wpsr-yt-video-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_box_border',
                'selector' => '{{WRAPPER}} .wpsr-yt-video',
            ]
        );

        $this->add_control(
            'item_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wp-social-reviews'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .wpsr-yt-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpsr-yt-video-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_box_shadow',
                'selector' => '{{WRAPPER}} .wpsr-yt-video',
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
        if(!empty($yt_template_list)){
            echo do_shortcode('[wp_social_ninja id="' . $yt_template_list . '" platform="youtube"]');
        }
    }
}
