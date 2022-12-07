<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Youtube\YoutubeFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\Youtube\Helper as YoutubeHelper;

class YoutubeTemplateHandler
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

        $classes = 'wpsr-col-' . esc_attr($desktop_column) . ' wpsr-col-sm-' . esc_attr($tablet_column) . ' wpsr-col-xs-' . esc_attr($mobile_column);
        $app->view->render('public.feeds-templates.youtube.elements.item-wrapper-before', array(
            'classes' => $classes,
        ));
    }

    public function renderChannelBanner($header = [], $template_header_meta = [])
    {
        if (Arr::get($template_header_meta, 'display_banner') === 'false') {
            return;
        }
        $app = App::getInstance();
        if (Arr::get($header, 'items.0.brandingSettings.image.bannerExternalUrl')) {
            $app->view->render('public.feeds-templates.youtube.elements.channel_banner', array(
                'header' => $header
            ));
        }
    }

    public function renderChannelLogo($header = [], $template_header_meta = [])
    {
        if (Arr::get($template_header_meta, 'display_logo') === 'false') {
            return;
        }
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.youtube.elements.channel_logo', array(
            'header' => $header
        ));
    }

    public function renderChannelName($header = [], $template_header_meta = [])
    {
        if (Arr::get($template_header_meta, 'display_name') === 'false') {
            return;
        }
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.youtube.elements.channel_name', array(
            'header' => $header
        ));
    }

    public function renderPreviewImage(
        $feed = [],
        $template_meta = [],
        $index = null,
        $templateId = null,
        $feed_info = []
    )
    {
        $videoId = YoutubeHelper::getVideoId($feed);
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.youtube.elements.preview_image', array(
            'feed'          => $feed,
            'template_meta' => $template_meta,
            'index'         => $index,
            'templateId'    => $templateId,
            'feed_info'     => $feed_info,
            'videoId'       => $videoId
        ));
    }

    public function renderTitle($feed = [], $template_meta = [], $index = null, $templateId = null)
    {
        if (Arr::get($template_meta, 'video_settings.display_title') === 'false') {
            return;
        }
        $trim_title_words = isset($template_meta['video_settings']['trim_title_words']) && $template_meta['video_settings']['trim_title_words'] > 0 ? $template_meta['video_settings']['trim_title_words'] : null;
        $videoId = YoutubeHelper::getVideoId($feed);
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.youtube.elements.feed_title', array(
            'feed'             => $feed,
            'template_meta'    => $template_meta,
            'index'            => $index,
            'templateId'       => $templateId,
            'trim_title_words' => $trim_title_words,
            'videoId'          => $videoId
        ));
    }

    public function renderPopupFeed()
    {
        $feedId =  Arr::get($_REQUEST, 'feedId');
        $templateId = absint(Arr::get($_REQUEST, 'templateId'));

        $app = App::getInstance();
        $shortcodeHandler = new ShortcodeHandler();

        $template_meta = $shortcodeHandler->templateMeta($templateId, 'youtube');
        $feeds = (new YoutubeFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $shortcodeHandler->formatFeedSettings($feeds);

        $feeds = Arr::get($settings, 'feeds', []);
        $feed  = YoutubeHelper::getFeedById($feedId, $feeds);

        $app->view->render('public.feeds-templates.youtube.popup', array(
            'header'        => $settings['header'],
            'feed'          => $feed,
            'template_meta' => $settings['feed_settings'],
        ));
        die();
    }

    public function getPaginatedFeedHtml($templateId, $page)
    {
        $app = App::getInstance();
        $shortcodeHandler = new ShortcodeHandler();

        $template_meta = $shortcodeHandler->templateMeta($templateId, 'youtube');
        $feed = (new YoutubeFeed())->getTemplateMeta($template_meta, $templateId);
        $feed_info = Arr::get($feed, 'feed_info', []);
        $settings = $shortcodeHandler->formatFeedSettings($feed);
        $pagination_settings = $shortcodeHandler->formatPaginationSettings($feed);

        $sinceId = (($page - 1) * $pagination_settings['paginate']);
        $maxId = ($sinceId + $pagination_settings['paginate']) - 1;

        return (string) $app->view->make('public.feeds-templates.youtube.template1', array(
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'feed_info'     => $feed_info,
            'template_meta' => $settings['feed_settings'],
            'paginate'      => $pagination_settings['paginate'],
            'sinceId'       => $sinceId,
            'maxId'         => $maxId
        ));
    }
}