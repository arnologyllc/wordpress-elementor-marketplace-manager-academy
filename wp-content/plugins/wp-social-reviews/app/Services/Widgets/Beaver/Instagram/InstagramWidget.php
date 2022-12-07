<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class WPSR_Fl_Instagram_Module
 */
class WPSR_Fl_Instagram_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Instagram Feeds', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => WPSOCIALREVIEWS_DIR . 'app/Services/Widgets/Beaver/Instagram/',
            'url'           => WPSOCIALREVIEWS_URL . 'app/Services/Widgets/Beaver/Instagram/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
            'icon'            => 'format-image.svg',
        ));

        $this->add_css(
            'wp_social_ninja_ig',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_ig.css',
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
FLBuilder::register_module('WPSR_Fl_Instagram_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['instagram'])
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
                    'ig_header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-header .wpsr-ig-header-inner',
                            'property'  => 'background',
                        ),
                    ),
                    'ig_username_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'UserName Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-name a',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_statistics_label_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Statistics Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_fullname_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'FullName Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_follow_btn_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Follow Button Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-ig-follow-btn a'
                        )
                    ),
                    'ig_follow_btn_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Follow Button Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-follow-btn a',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_follow_btn_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Follow Button Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-follow-btn a',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
            'content_style' => array(
                'title'  => __( 'Content', 'wp-social-reviews' ),
                'fields' => array(
                    'ig_content_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_hashtag_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hashtag Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p a',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_content_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p'
                        )
                    ),
                ),
            ),
            'statistics_style' => array(
                'title'  => __( 'Statistics', 'wp-social-reviews' ),
                'fields' => array(
                    'ig_statistics_count_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Count Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_statistics_count_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span'
                        )
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'ig_load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'ig_load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'ig_load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'ig_load_more_typography'		=> array(
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
                    'ig_box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-ig-post, .wpsr-ig-post .wpsr-ig-post-info',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));
