<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\Framework\Support\Arr;

class InstagramTemplateHandler
{

    /**
     *
     * Render parent opening div for the template item
     *
     * @param $template_meta
     *
     * @since 3.7.0
     *
     **/
    public function renderTemplateItemWrapper($template_meta = []){
        $app = App::getInstance();

        $desktop_column = Arr::get($template_meta, 'responsive_column_number.desktop');
        $tablet_column = Arr::get($template_meta, 'responsive_column_number.tablet');
        $mobile_column = Arr::get($template_meta, 'responsive_column_number.mobile');
        $template = Arr::get($template_meta, 'template') === 'template2' ? 'wpsr-mb-30 ' : '';

        $classes = esc_attr($template) . 'wpsr-col-' . esc_attr($desktop_column) . ' wpsr-col-sm-' . esc_attr($tablet_column) . ' wpsr-col-xs-' . esc_attr($mobile_column);
        $app->view->render('public.feeds-templates.instagram.elements.item-parent-wrapper', array(
            'classes' => $classes,
        ));
    }

    /**
     *
     * Render Instagram Post Media HTML
     *
     * @param $feed
     *
     * @since 1.3.0
     *
     **/
    public function renderPostMedia($feed = [], $template_meta = [], $index = null)
    {
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.instagram.elements.media', array(
            'feed'          => $feed,
            'template_meta' => $template_meta,
            'index' => $index
        ));
    }

    /**
     *
     * Render Instagram Post Media HTML
     *
     * @param $feed
     * @param $template_meta
     *
     * @since 1.3.0
     *
     **/
    public function renderPostCaption($feed = [], $template_meta = [])
    {
        if (Arr::get($template_meta, 'post_settings.display_caption') === 'false') {
            return false;
        }

        $trim_words_count = isset($template_meta['post_settings']['trim_caption_words']) && $template_meta['post_settings']['trim_caption_words'] > 0 ? $template_meta['post_settings']['trim_caption_words'] : 0;
        if (isset($feed['caption']) && $trim_words_count) {
            $caption = apply_filters('wpsocialreviews/instagram_trim_caption_words', $feed['caption'],
                $trim_words_count);
        } else {
            $caption = isset($feed['caption']) ? $feed['caption'] : '';
        }

        $app = App::getInstance();
        $app->view->render('public.feeds-templates.instagram.elements.caption', array(
            'feed'          => $feed,
            'template_meta' => $template_meta,
            'caption'       => $caption
        ));
    }

    public function renderIcon()
    {
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.instagram.elements.icon');
    }
}