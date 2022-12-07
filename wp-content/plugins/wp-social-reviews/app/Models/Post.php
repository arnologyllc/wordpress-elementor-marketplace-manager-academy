<?php

namespace WPSocialReviews\App\Models;

use WPSocialReviews\App\Models\Traits\SearchableScope;
use WPSocialReviews\Framework\Support\Arr;

class Post extends Model
{
    use SearchableScope;

    protected static $type = '';
    protected $table = 'posts';

    public static function boot()
    {
        static::creating(function ($model) {
            $model->post_type   = static::$type;
            $model->post_status = 'publish';
        });

        static::addGlobalScope(function ($builder) {
            $builder->where('post_type', static::$type);
            if(static::$type !== 'wpsr_reviews_notify'){
                $builder->where('post_status', 'publish');
            }
        });
    }
    /**
     * $searchable Columns in table to search
     * @var array
     */
    protected $searchable = [
        'ID',
        'post_title',
        'post_content'
    ];

    public function getPosts($postType, $search, $filter)
    {
        static::$type = $postType;
        if($filter === 'all'){
            $filter = '';
        }

        $posts = static::searchBy($search)
            ->where('post_content', 'like', '%'.$filter.'%')
            ->latest('ID')
            ->paginate();

        foreach ($posts as $post) {
            $platforms = $post->getPlatformNames();

            if (Arr::get($platforms, 'platform')) {
                $post->platform_name = implode(', ', Arr::get($platforms, 'platform'));
            } else {
                $post->platform_name = Arr::get($platforms, 'feed_settings.platform');
            }
        }

        return $posts;
    }

    public function findPost($postType, $id)
    {
        static::$type = $postType;
        $post = static::find($id);
        return $post;
    }

    /**
     * Insert a post.
     *
     * @param $postTitle
     * @param $platform
     *
     * @return int|WP_Error The post ID on success. The value 0 or WP_Error on failure.
     */
    public function createPost($postArr)
    {
        $default = [
            'post_author'  => get_current_user_id(),
            'post_status'  => 'publish'
        ];
        $postData = array_merge($default, $postArr);
        $postId = wp_insert_post($postData, true);

        if (is_wp_error($postId)) {
            throw new \Exception($postId->get_error_message());
        }

        return $postId;
    }

    /**
     *  Update post.
     *
     * @param $args
     *
     * @return int|WP_Error The post ID on success. The value 0 or WP_Error on failure.
     */
    public function updatePost($args)
    {
        $result = wp_update_post($args, true);

        if (is_wp_error($result)) {
            throw new \Exception($result->get_error_message());
        }

        return $result;
    }

    /**
     * Delete post and post meta by post id
     *
     * @param $postId
     *
     * @return WP_Post|false|null Post data on success, false or null on failure.
     */
    public function deletePost($postId)
    {
        wp_delete_post($postId, true);
        delete_post_meta($postId, '_wpsr_template_config', true);
    }

    /**
     *  Update a post meta field.
     *
     * @param $postId
     * @param $postMeta
     * @param $platform
     *
     * @return int|bool
     */
    public function updatePostMeta($postId, $postMeta, $platform)
    {
        $this->updateConfigMeta($postId, json_encode($postMeta));
        $this->updateDriverMeta($postId, $platform);
    }

    public function updateConfigMeta($postId, $meta)
    {
        update_post_meta($postId, '_wpsr_template_config', $meta);
    }

    public function updateDriverMeta($postId, $platform)
    {
        update_post_meta($postId, '_wpsr_driver', $platform);
    }

    public function getConfig()
    {
        $encodedMeta = get_post_meta($this->ID, '_wpsr_template_config', true);
        return json_decode($encodedMeta, true);
    }

    public function getPlatformNames()
    {
        return $this->getConfig();
    }
}