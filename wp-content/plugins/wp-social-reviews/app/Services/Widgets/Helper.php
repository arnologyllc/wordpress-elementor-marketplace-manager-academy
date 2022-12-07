<?php

namespace WPSocialReviews\App\Services\Widgets;


use WPSocialReviews\App\Models\Template;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    public static function getTemplates($platforms)
    {
        if( count($platforms) > 1 ){
            $posts = Template::whereNotIn('post_content', $platforms)->orderBy('ID', 'desc')->get();
        } else {
            $posts = Template::whereIn('post_content', $platforms)->orderBy('ID', 'desc')->get();
        }

        $templates = array();

        if ($posts) {
            $templates[0] = esc_html__('Select a template', 'wp-social-reviews');
            foreach ($posts as $post) {
                $templates[$post->ID] = $post->post_title .' (id-'.$post->ID.')';
            }
        } else {
            $templates[0] = esc_html__('Create a template first', 'wp-social-reviews');
        }

        return $templates;
    }
}