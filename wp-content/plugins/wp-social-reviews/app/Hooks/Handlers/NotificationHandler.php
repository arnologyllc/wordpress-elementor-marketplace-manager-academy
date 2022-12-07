<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\App\Services\Helper;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Helper as GlobalHelper;

class NotificationHandler
{
    public function notificationRegister()
    {
        //not show notification in the oxygen builder editor
        if(isset($_GET['ct_builder']) && $_GET['ct_builder']){
            return;
        }
        add_action('template_redirect', array($this, 'maybeHasNotification'), 999);
    }

    public function maybeHasNotification()
    {
        $args = array(
            'post_type'   => 'wpsr_reviews_notify',
            'post_status' => 'publish',
            'orderby'     => 'menu_order',
            'order'       => 'DESC'
        );

        $notification_streams = get_posts($args);

        if (!$notification_streams) {
            return;
        }

        foreach ($notification_streams as $stream) {
            $templateMeta = get_post_meta($stream->ID, '_wpsr_template_config', true);
            if (empty($templateMeta)) {
                continue;
            }

            $templateMeta = json_decode($templateMeta, true);

            // check any platform is set or not
            if (!Arr::get($templateMeta, 'platform')) {
                return false;
            }

            if (!Arr::get($templateMeta, 'notification_settings')) {
                return false;
            }

            $settings = Arr::get($templateMeta, 'notification_settings', []);
            $isValid = GlobalHelper::isTemplateMatched($settings);

            //not show notification in the elementor builder editor
            if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
                $isValid = false;
            }

            //not show notification in the beaver builder editor
            if(class_exists( 'FLBuilderModel' ) && \FLBuilderModel::is_builder_active()){
                $isValid = false;
            }

            if ($isValid && defined('WPSOCIALREVIEWS_PRO')) {
                $shortcodeObject = (new ShortcodeHandler());

                if(!did_action('wp_enqueue_scripts')) {
                   $shortcodeObject->registerStyles();
                }
                $shortcodeObject->enqueueStyles(['reviews']);

                add_action('wp_footer', function () use ($stream) {
                    $templateData = (new ShortcodeHandler())->renderReviewsTemplate($stream->ID, 'reviews');
                    Helper::printInternalString($templateData);
                });
                return;
            }
        }
    }
}