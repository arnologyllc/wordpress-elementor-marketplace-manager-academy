<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 *
 * @class WPSR_Fl_Reviews_Module
 */
class WPSR_Fl_Reviews_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Social Reviews', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => WPSOCIALREVIEWS_DIR . 'app/Services/Widgets/Beaver/Reviews/',
            'url'           => WPSOCIALREVIEWS_URL . 'app/Services/Widgets/Beaver/Reviews/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
            'icon'            => 'star-filled.svg',
        ));

        $this->add_css(
            'wp_social_ninja_reviews',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_reviews.css',
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
FLBuilder::register_module('WPSR_Fl_Reviews_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['twitter', 'youtube', 'instagram'])
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
                    'header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-business-info',
                            'property'  => 'background',
                        ),
                    ),
                    'header_rating_text_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Rating Text Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-business-info .wpsr-rating-and-count, .wpsr-business-info .wpsr-rating-and-count .wpsr-total-rating'
                        )
                    ),
                    'header_rating_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Rating Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-business-info .wpsr-rating-and-count, .wpsr-business-info .wpsr-rating-and-count .wpsr-total-rating',
                            'property'  => 'color',
                        ),
                    ),
                    'header_war_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Write a Review Button Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-business-info .wpsr-business-info-right .wpsr-write-review'
                        )
                    ),
                    'header_war_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Write a Review Button Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-business-info .wpsr-business-info-right .wpsr-write-review',
                            'property'  => 'color',
                        ),
                    ),
                    'header_war_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Write a Review Button Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-business-info .wpsr-business-info-right .wpsr-write-review',
                            'property'  => 'background',
                        ),
                    ),

                ),
            ),
            'name_style' => array(
                'title'  => __( 'Name', 'wp-social-reviews' ),
                'fields' => array(
                    'name_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template .wpsr-review-info a .wpsr-reviewer-name',
                            'property'  => 'color',
                        ),
                    ),
                    'name_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-review-template .wpsr-review-info a .wpsr-reviewer-name'
                        )
                    ),
                ),
            ),
            'title_style' => array(
                'title'  => __( 'Title', 'wp-social-reviews' ),
                'fields' => array(
                    'title_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template .wpsr-review-title',
                            'property'  => 'color',
                        ),
                    ),
                    'title_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-review-template .wpsr-review-title'
                        )
                    ),
                ),
            ),
            'description_style' => array(
                'title'  => __( 'Description', 'wp-social-reviews' ),
                'fields' => array(
                    'description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template .wpsr-review-content p',
                            'property'  => 'color',
                        ),
                    ),
                    'description_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-review-template .wpsr-review-content p'
                        )
                    ),
                ),
            ),
            'platform_name_style' => array(
                'title'  => __( 'Platform', 'wp-social-reviews' ),
                'fields' => array(
                    'platform_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Platform Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template .wpsr-review-platform span',
                            'property'  => 'background',
                        ),
                    ),
                    'platform_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template .wpsr-review-platform span',
                            'property'  => 'color',
                        ),
                    ),
                ),
            ),
            'read_more_style' => array(
                'title'  => __( 'Read More', 'wp-social-reviews' ),
                'fields' => array(
                    'read_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less',
                            'property'  => 'color',
                        ),
                    ),
                    'read_more_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less'
                        )
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-reviews-loadmore span',
                            'property'  => 'color',
                        ),
                    ),
                    'load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-reviews-loadmore span',
                            'property'  => 'color',
                        ),
                    ),
                    'load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-reviews-loadmore span',
                            'property'  => 'background',
                        ),
                    ),
                    'load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-reviews-loadmore span',
                            'property'  => 'background',
                        ),
                    ),
                    'load_more_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-reviews-loadmore span'
                        )
                    ),
                ),
            ),
            'box_style' => array(
                'title'  => __( 'Box', 'wp-social-reviews' ),
                'fields' => array(
                    'box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-review-template',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));