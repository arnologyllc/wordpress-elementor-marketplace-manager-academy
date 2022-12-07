<?php

namespace WPSocialReviews\App\Http\Controllers;

use WPSocialReviews\App\Models\Post;
use WPSocialReviews\App\Models\Template;
use WPSocialReviews\Framework\Foundation\Application;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Services\Platforms\Reviews\ReviewsTrait;

class TemplatesController extends Controller
{
    use ReviewsTrait;

    protected $app = null;
    protected $postType = 'wp_social_reviews';

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
     * @since 2.0.0
     *
     **/
    public function index(Request $request, Template $template, Post $post)
    {
        $templates = $post->getPosts(
            $this->postType,
            $request->get('search'),
            $request->get('filter')
        );

        //find all available platforms for templating
        $platforms = $this->validReviewsPlatforms();
        $validShortcodeType = $template->getValidShortcodeType($platforms);
        $feedPlatforms = $this->app->applyCustomFilters('available_valid_feed_platforms', []);
        $platforms = ($platforms + $feedPlatforms);

        return [
            'message'         => 'success',
            'connected_platform_sections' => $validShortcodeType,
            'all_valid_platforms'         => $platforms,
            'items'                       => $templates,
            'total_items'                 => $post->count()
        ];
    }

    /**
     *
     * Create single template on posts table and save template meta by post id on post meta table.
     *
     * @param $request
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function create(Request $request, Template $template, Post $post)
    {
        try {
            $platform     = $request->get('platform');

            $postTitle = ucfirst($platform) . __(' Template', 'wp-social-reviews');
            if($platform === 'google') {
                $postTitle = __('Google My Business Template', 'wp-social-reviews');
            } else if( $platform === 'facebook_feed') {
                $postTitle = __('Facebook Feed Template', 'wp-social-reviews');
            }

            $postId = $post->createPost(
                [
                    'post_title'   => $postTitle,
                    'post_content' => $platform,
                    'post_type'    => $this->postType,
                ]
            );

            $postMeta = $template->getPlatformDefaultConfig($platform);
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
     * Duplicate single template on posts table and save template meta by post id on post meta table.
     *
     * @param $request
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function duplicate(Request $request, Post $post, $id)
    {
        $template = Template::find($id);

        $template['post_title'] = '(Duplicate) ' . $template['post_title'];
        $template = $this->app->applyCustomFilters('template_duplicate', $template);

        if (!$template) {
            wp_send_json_error([
                'message' => __('No template found when duplicating the template', 'wp-social-reviews')
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

        //add new template end
        return [
            'message'     => __('Template successfully duplicated', 'wp-social-reviews'),
            'item'    => get_post($templateId, 'ARRAY_A'),
            'item_id' => $templateId
        ];
    }

    /**
     *
     * Delete template and meta from posts, post meta table.
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
            'message' => __('Template has been successfully deleted', 'wp-social-reviews')
        ];
    }

    /**
     *
     * Update template title on post table.
     *
     * @param $request
     * @param $templateId
     *
     * @return array
     * @since 2.0.0
     *
     **/
    public function updateTitle(Request $request, Post $post, $templateId)
    {
        try {
            $templateTitle = $request->get('template_title');

            $this->app->doCustomAction('before_save_title', $templateId);
            $updateArgs = [
                'ID'         => $templateId,
                'post_title' => $templateTitle,
            ];
            $args   = $this->app->applyCustomFilters('template_title', $updateArgs);
            $result = $post->updatePost($args);
            $this->app->doCustomAction('after_save_title', $templateId);

            return [
                'message' => __("Title updated successfully!!", 'wp-social-reviews'),
                'title'   => $templateTitle,
                'id'      => $templateId,
                'result'  => $result
            ];
        } catch (\Exception $e){
            wp_send_json_error([
                'message' => $e->getMessage()
            ], 423);
        }
    }
}