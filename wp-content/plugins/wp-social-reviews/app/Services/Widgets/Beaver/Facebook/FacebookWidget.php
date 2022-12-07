<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class WPSR_Fl_Facebook_Module
 */
class WPSR_Fl_Facebook_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Facebook Feeds', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => WPSOCIALREVIEWS_DIR . 'app/Services/Widgets/Beaver/Facebook/',
            'url'           => WPSOCIALREVIEWS_URL . 'app/Services/Widgets/Beaver/Facebook/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
        ));

        $this->add_css(
            'wp_social_ninja_fb',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_fb.css',
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
FLBuilder::register_module('WPSR_Fl_Facebook_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['facebook_feed'])
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
                    'fb_header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper',
                            'property'  => 'background',
                        ),
                    ),
                    'fb_header_page_name_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'PageName Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_header_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_header_likes_count_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Likes Count Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_header_page_name_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('PageName Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a'
                        )
                    ),
                    'fb_header_page_description_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Description Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p'
                        )
                    ),
                    'fb_header_page_likes_counter_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Likes Counter Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span'
                        )
                    ),
                ),
            ),
            'content_author_style' => array(
                'title'  => __( 'Post Author', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_content_author_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_content_author_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-author .wpsr-fb-feed-author-info a'
                        )
                    ),
                ),
            ),
            'content_date_style' => array(
                'title'  => __( 'Post Date', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_content_date_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_content_date_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-author .wpsr-fb-feed-time, .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item'
                        )
                    ),
                ),
            ),
            'post_title_style' => array(
                'title'  => __( 'Post Title', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_post_title_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_title_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a:hover',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_title_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-item .wpsr-fb-feed-video-info h3'
                        )
                    ),
                ),
            ),
            'post_content_style' => array(
                'title'  => __( 'Post Content', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_post_content_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-inner p',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_content_link_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Link Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-inner p a',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_content_link_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Link Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-inner p a:hover',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_content_rm_link_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Read More Link Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_content_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-inner p'
                        )
                    ),
                ),
            ),
            'post_summary_card_style' => array(
                'title'  => __( 'Post Summary Card', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_post_sc_domain_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Domain Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_sc_title_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Title Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_post_sc_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                            'property'  => 'color',
                        ),
                    ),
                ),
            ),
            'like_and_share_btn_style' => array(
                'title'  => __( 'Like and Share Button', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_feed_button_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_feed_button_background_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                            'property'  => 'background',
                        ),
                    ),
                    'fb_feed_button_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a'
                        )
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'fb_load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'fb_load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'fb_load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'fb_load_more_typography'		=> array(
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
                    'fb_box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-fb-feed-item .wpsr-fb-feed-inner',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));