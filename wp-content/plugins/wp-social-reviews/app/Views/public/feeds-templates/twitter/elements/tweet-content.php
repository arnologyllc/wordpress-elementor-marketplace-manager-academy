<?php
use WPSocialReviews\App\Services\Helper;
use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper as TwitterHelper;
?>
<div class="wpsr-tweet-content <?php echo esc_attr(implode(' ', $classes)); ?>" <?php Helper::printInternalString($twitter_card_data_attrs); ?>>
    <?php if (isset($template_meta['advance_settings']) && $template_meta['advance_settings']['tweet_text'] === 'true') { ?>
        <p class="wpsr-tweet-text"><?php echo TwitterHelper::replaceTweetUrls($feed); ?></p>
    <?php } ?>
    <?php
    if (isset($feed['quoted_status'])) {
        /**
         * tweet_quoted_status hook.
         *
         * @hooked wpsr_render_tweet_quoted_status_html 10
         * */
        do_action('wpsocialreviews/tweet_quoted_status', $feed['quoted_status'], $template_meta, $templateId, $index);
    }

    if (isset($feed['retweeted_status']['quoted_status'])) {
        /**
         * tweet_quoted_status hook.
         *
         * @hooked wpsr_render_tweet_quoted_status_html 10
         * */
        do_action('wpsocialreviews/tweet_quoted_status', $feed['retweeted_status']['quoted_status'], $template_meta,
            $templateId, $index);
    }

    if (!isset($feed['quoted_status'])) {
        if (
            $media_type === 'video' ||
            $media_type === 'animated_gif' ||
            $has_external_media
        ) {
            /**
             * tweet_video hook.
             *
             * @hooked wpsr_render_tweet_video_html 10
             * */
            do_action('wpsocialreviews/tweet_video', $feed, $template_meta, $templateId, $index);
        } else {
            /**
             * tweet_image hook.
             *
             * @hooked wpsr_render_tweet_image_html 10
             * */
            do_action('wpsocialreviews/tweet_image', $feed, $template_meta, $templateId, $index);
        }
    }
    ?>
</div>
