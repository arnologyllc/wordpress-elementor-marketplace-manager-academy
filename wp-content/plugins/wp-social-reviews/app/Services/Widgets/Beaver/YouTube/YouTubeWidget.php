<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class WPSR_Fl_YouTube_Module
 */
class WPSR_Fl_YouTube_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('YouTube Feeds', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => WPSOCIALREVIEWS_DIR . 'app/Services/Widgets/Beaver/YouTube/',
            'url'           => WPSOCIALREVIEWS_URL . 'app/Services/Widgets/Beaver/YouTube/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
            'icon'            => 'format-video.svg',
        ));

        $this->add_css(
            'wp_social_ninja_yt',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_yt.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );
        if(defined('WPSOCIALREVIEWS_PRO')){
            $this->add_css(
                'swiper',
                WPSOCIALREVIEWS_PRO_URL . 'assets/libs/swiper/swiper-bundle.min.css',
                array(),
                WPSOCIALREVIEWS_VERSION
            );
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSR_Fl_YouTube_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['youtube'])
                    ),
                )
            )
        )
    ),
    'style'   => array(
        'title'    => __( 'Style', 'wp-social-reviews' ),
        'sections' => array(
            'header_style' => array(
                'title'  => __( 'Header', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header .wpsr-yt-header-inner',
                            'property'  => 'background',
                        ),
                    ),
                    'yt_header_channel_name_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Channel Name Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-name a',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_header_statistics_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Statistics Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_header_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_header_follow_btn_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Subscribe Button Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header-subscribe-btn a',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_header_follow_btn_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Subscribe Button Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-header-subscribe-btn a',
                            'property'  => 'background',
                        ),
                    ),
                    'yt_header_follow_btn_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Subscribe Button Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-yt-header-subscribe-btn a'
                        )
                    ),
                ),
            ),
            'title_style' => array(
                'title'  => __( 'Title', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_title_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-video .wpsr-yt-video-info h3 a',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_title_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-yt-video .wpsr-yt-video-info h3'
                        )
                    ),
                ),
            ),
            'statistics_style' => array(
                'title'  => __( 'Statistics', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_statistics_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_statistics_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item'
                        )
                    ),
                ),
            ),
            'description_style' => array(
                'title'  => __( 'Description', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-description',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_description_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-description'
                        )
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'yt_load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'yt_load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'yt_load_more_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr_more'
                        )
                    ),
                ),
            ),
            'box_style' => array(
                'title'  => __( 'Box', 'wp-social-reviews' ),
                'fields' => array(
                    'yt_box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-yt-video',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));