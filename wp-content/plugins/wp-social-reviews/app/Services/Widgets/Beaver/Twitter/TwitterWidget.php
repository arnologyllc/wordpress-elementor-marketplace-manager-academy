<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class WPSR_Fl_Twitter_Module
 */
class WPSR_Fl_Twitter_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Twitter Feeds', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => WPSOCIALREVIEWS_DIR . 'app/Services/Widgets/Beaver/Twitter/',
            'url'           => WPSOCIALREVIEWS_URL . 'app/Services/Widgets/Beaver/Twitter/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
        ));

        $this->add_css(
            'wp_social_ninja_tw',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tw.css',
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
FLBuilder::register_module('WPSR_Fl_Twitter_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['twitter'])
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
                    'tw_header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper',
                            'property'  => 'background',
                        ),
                    ),
                    'tw_header_full_name_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'FullName Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_username_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'UserName Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_location_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Location Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_statistics_label_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Statistics Label Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_statistics_count_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Statistics Count Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_follow_btn_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Follow Button Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-user-follow-btn',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_header_follow_btn_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Follow Button Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-user-follow-btn',
                            'property'  => 'background',
                        ),
                    ),
                    'tw_header_follow_btn_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Follow Button Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-twitter-user-follow-btn'
                        )
                    ),
                ),
            ),
            'full_name_style' => array(
                'title'  => __( 'FullName', 'wp-social-reviews' ),
                'fields' => array(
                    'tw_fullname_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_fullname_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name:hover',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_fullname_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name'
                        )
                    ),
                ),
            ),
            'meta_style' => array(
                'title'  => __( 'Meta', 'wp-social-reviews' ),
                'fields' => array(
                    'tw_meta_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name, .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_meta_text_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name:hover, .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time:hover',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_meta_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name, .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time'
                        )
                    ),
                ),
            ),
            'content_style' => array(
                'title'  => __( 'Content', 'wp-social-reviews' ),
                'fields' => array(
                    'tw_content_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_hashtag_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hashtag Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p a',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_content_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p'
                        )
                    ),
                ),
            ),
            'actions_style' => array(
                'title'  => __( 'Actions', 'wp-social-reviews' ),
                'fields' => array(
                    'tw_actions_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_actions_icon_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Icon Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a svg',
                            'property'  => 'fill',
                        ),
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'tw_load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'tw_load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'tw_load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'tw_load_more_typography'		=> array(
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
                    'tw_box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-twitter-feed-wrapper .wpsr-twitter-tweet',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));