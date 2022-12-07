<?php

namespace WPSocialReviews\App\Http\Controllers;

use WPSocialReviews\App\Models\Notification;
use WPSocialReviews\Framework\Foundation\Application;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Services\Platforms\Reviews\ReviewsTrait;
use WPSocialReviews\App\Models\Post;

class NotificationsController extends Controller
{
    use ReviewsTrait;

    protected $postType = 'wpsr_reviews_notify';

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     *
     * Get all templates from posts table.
     *
     * @param $request
     *
     * @return array
     * 
     * @since 2.0.0
     *
     **/
    public function index(Request $request, Post $post)
    {
        $notifications = $post->getPosts(
            $this->postType,
            $request->get('search'),
            $request->get('filter')
        );

        return [
            'message'                       => 'success',
            'items'                         => $notifications,
            'total_items'                   => $post->count(),
            'all_valid_platforms'           => $this->validReviewsPlatforms(),
        ];
    }

    /**
     *
     * Create single template on posts table and save template meta by post id on post meta table
     *
     * @param $request
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function create(Request $request, Post $post)
    {
        try {
            $platform = $request->get('platform');
            $postId = $post->createPost(
                [
                    'post_title'   => ucfirst($platform) . __(' Notification Popup', 'wp-social-reviews'),
                    'post_content' => $platform,
                    'post_type'    => $this->postType,
                ]
            );

            $postMeta = [
                'templateType' => 'notification'
            ];
            $post->updatePostMeta($postId, $postMeta, $platform);

            return [
                'template_id' => $postId
            ];
        } catch (\Exception $e){
            wp_send_json_error([
                'message' => $e->getMessage()
            ], 423);
        }
    }

    /**
     *
     * Duplicate single template on posts table and save template meta by post id on post meta table
     *
     * @param $request
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function duplicate(Request $request, Post $post, $id)
    {
        $template = $post->findPost($this->postType, $id);
        $template['post_title'] = '(Duplicate) ' . $template['post_title'];
        $template = $this->app->applyCustomFilters('notification_template_duplicate', $template);

        if (!$template) {
            wp_send_json_error([
                'message' => __('No notification stream found when duplicating the notification.', 'wp-social-reviews')
            ], 423);
        }

        $templateId = $post->createPost(
            [
                'post_title'   => $template['post_title'],
                'post_content' => $template['post_content'],
                'post_type'    => $this->postType,
            ]
        );

        $templateConfig = get_post_meta($template['ID'], '_wpsr_template_config', true);
        if ($templateConfig) {
            update_post_meta($templateId, '_wpsr_template_config', $templateConfig);
        }

        // Add new template
        return [
            'message'  => __('Notification successfully duplicated.', 'wp-social-reviews'),
            'item'     => get_post($templateId, 'ARRAY_A'),
            'item_id'  => $templateId
        ];
    }

    public function update(Request $request, Post $post, $templateId)
    {
        try {
            $status = $request->get('status');
            $args = [
                'ID'          => $templateId,
                'post_status' => $status,
            ];
            $post->updatePost($args);

            return [
                'message' => __("Notification status update successfully!!", 'wp-social-reviews'),
            ];
        } catch (\Exception $e){
            wp_send_json_error([
                'message' => $e->getMessage()
            ], 423);
        }
    }

    /**
     *
     * Delete template and meta from posts, post meta table
     *
     * @param $templateId
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function delete(Post $post, $templateId)
    {
        $post->deletePost($templateId);

        return [
            'message' => __('Notification has been successfully deleted.', 'wp-social-reviews')
        ];
    }
}
