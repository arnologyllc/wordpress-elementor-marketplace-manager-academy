<?php

namespace WPSocialReviews\App\Http\Controllers;

use WPSocialReviews\App\Models\Widget;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Services\Platforms\Chats\Config;
use WPSocialReviews\App\Models\Post;

class WidgetsController extends Controller
{
    protected $postType = 'wpsr_social_chats';

    /**
     *
     * Get all templates from posts table.
     *
     * @param $request
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function index(Request $request, Widget $widget)
    {
        $widgets = $widget->getWidgetTemplate($request->get('search'));

        return [
            'message'            => 'success',
            'items'            => $widgets,
            'total_items' => $widget->count()
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
            $widgetId = $post->createPost(
                [
                    'post_title'   => __('Chat Widget', 'wp-social-reviews'),
                    'post_content' => 'social chats',
                    'post_type'    => $this->postType,
                ]
            );

            $widgetMeta = Config::formatConfig();
            $post->updateConfigMeta($widgetId, serialize($widgetMeta));

            return [
                'template_id' => $widgetId
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
        $widget = Widget::find($id);

        $widget['post_title'] = '(Duplicate) ' . $widget['post_title'];
        $widget = $this->app->applyCustomFilters('chat_template_duplicate', $widget);

        if (!$widget) {
            wp_send_json_error([
                'message' => __('No chat widget found when duplicating the chat widget.', 'wp-social-reviews')
            ], 423);
        }

        // Create a new post.
        $widgetId = $post->createPost(
            [
                'post_title'   => $widget['post_title'],
                'post_content' => $widget['post_content'],
                'post_type'    => $this->postType,
            ]
        );

        $widgetConfig = get_post_meta($widget['ID'], '_wpsr_template_config', true);

        if ($widgetConfig) {
            update_post_meta($widgetId, '_wpsr_template_config', $widgetConfig);
        }

        return [
            'message'   => __('Widget successfully duplicated.', 'wp-social-reviews'),
            'item'    => get_post($widgetId, 'ARRAY_A'),
            'item_id' => $widgetId
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
                'message' => __("Widget status update successfully.", 'wp-social-reviews'),
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
            'message' => __('Widget has been successfully deleted.', 'wp-social-reviews')
        ];
    }
}