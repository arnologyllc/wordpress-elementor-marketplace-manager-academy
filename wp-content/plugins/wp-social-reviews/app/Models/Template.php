<?php

namespace WPSocialReviews\App\Models;

use WPSocialReviews\App\Models\Traits\SearchableScope;
use WPSocialReviews\App\Services\Platforms\PlatformManager;
use WPSocialReviews\Framework\Support\Arr;

class Template extends Model
{
    use SearchableScope;

    protected static $type = 'wp_social_reviews';
    protected $table = 'posts';

    /**
     * $searchable Columns in table to search
     * @var array
     */
    protected $searchable = [
        'ID',
        'post_title',
        'post_content'
    ];

    public static function boot()
    {
        static::creating(function ($model) {
            $model->post_type   = static::$type;
            $model->post_status = 'publish';
        });

        static::addGlobalScope(function ($builder) {
            $builder->where('post_type', static::$type);
            $builder->where('post_status', 'publish');
        });
    }

    public function getValidShortcodeType($platforms)
    {
        $countTestimonial = Review::where('platform_name', 'testimonial')->count();
        $validShortcodeType = [
            'reviews'   => count($platforms) ? true : false,
            'testimonial'  => $countTestimonial > 0 ? true : false,
        ];

        $feedPlatforms = apply_filters('wpsocialreviews/available_valid_feed_platforms', []);
        foreach($feedPlatforms as $key => $platform) {
            $validShortcodeType[$key] = true;
        }

        return $validShortcodeType;
    }

    public function getPlatformDefaultConfig($platform)
    {
        $feedPlatforms = (new PlatformManager())->feedPlatforms();
        $config = [];
        if (in_array($platform, $feedPlatforms)) {
            $methodName   = $platform . 'TemplateConfig';
            $methodName   = str_replace('_feed', 'Feed', $methodName);

            $config = $this->$methodName();
        } else {
            if ($platform !== 'reviews') {
                $config = [
                    'platform' => array($platform)
                ];
            }
        }
        return $config;
    }

    /**
     *
     * get twitter verification configs to set editor default screen_name
     * @return array
     * @since 2.0.0
     *
     **/
    public function twitterTemplateConfig()
    {
        $configs = get_option('wpsr_twitter_verification_configs');

        return [
            'feed_settings' => [
                'platform'            => 'twitter',
                'additional_settings' => [
                    'feed_type'   => 'user_timeline',
                    'screen_name' => Arr::get($configs, 'dynamic.screen_name', ''),
                    'feed_count'  => 10,
                ],
                'pagination_settings' => [
                    'pagination_type' => 'none',
                    'paginate'        => 6,
                ]
            ],
            'dynamic'       => []
        ];
    }

    public function youtubeTemplateConfig()
    {
        $configs = get_option('wpsr_youtube_verification_configs');

        return [
            'feed_settings' => [
                'platform'        => 'youtube',
                'source_settings' => [
                    'feed_type'  => 'channel_feed',
                    'channel_id' => Arr::get($configs, 'channel_id', ''),
                    'user_name'  => Arr::get($configs, 'user_name', ''),
                    'feed_count' => 50,
                ]
            ],
            'dynamic'       => []
        ];
    }

    public function facebookFeedTemplateConfig()
    {
        return array(
            'feed_settings' => array (
                'platform'                  => 'facebook_feed',
                'template'                  => 'template1',
                'responsive_column_number'  => array(
                    'desktop'  => '4',
                    'tablet'   => '4',
                    'mobile'   => '12'
                ),
                'source_settings'  => array (
                    'feed_type'         => 'timeline_feed',
                    'selected_accounts' => [],
                )
            )
        );
    }

    public function instagramTemplateConfig()
    {
        $configs = get_option('wpsr_instagram_verification_configs');

        return [
            'feed_settings' => [
                'platform'        => 'instagram',
                'source_settings' => [
                    'feed_type'  => 'user_account_feed',
                    'account_id' => Arr::get($configs, 'account_id', '')
                ],
                'filters'         => [
                     'total_posts_number'  => array(
                        'desktop'  => 50,
                        'mobile'   => 50
                    ),
                ]
            ],
            'dynamic'       => []
        ];
    }
}