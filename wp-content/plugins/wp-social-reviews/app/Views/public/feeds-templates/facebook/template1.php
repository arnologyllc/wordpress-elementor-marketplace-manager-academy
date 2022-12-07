<?php
use WPSocialReviews\Framework\Support\Arr;

if (!empty($feeds) && is_array($feeds)) {
    $feed_type = Arr::get($template_meta, 'source_settings.feed_type');
    $column      = isset($template_meta['column_number']) ? $template_meta['column_number'] : 4;
    $columnClass = 'wpsr-col-' . $column;
    $layout_type = isset($template_meta['layout_type']) && defined('WPSOCIALREVIEWS_PRO') ? $template_meta['layout_type'] : 'timeline';

    if ($feed_type !== 'timeline_feed' && !defined('WPSOCIALREVIEWS_PRO')) {
        echo '<p>' . __('You need to upgrade to pro to use this feature.', 'wp-social-reviews') . '</p>';
        return;
    }

    if(!Arr::get($template_meta, 'post_settings')) {
        return;
    }

    $feed_type = $template_meta['source_settings']['feed_type'];

    foreach($feeds as $index => $feed) {
        if ($index >= $sinceId && $index <= $maxId) {
            if ($layout_type !== 'carousel') {
                /**
                 * facebook_feed_template_item_wrapper_before hook.
                 *
                 * @hooked FacebookFeedTemplateHandler::renderTemplateItemWrapper 10 - (outputs opening divs for the template item)
                 **/
                do_action('wpsocialreviews/facebook_feed_template_item_wrapper_before', $template_meta);

           }
        ?>
            <div class="wpsr-fb-feed-item <?php echo ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : ''; ?>">
                <?php if($feed_type === 'timeline_feed'){ ?>
                <div class="wpsr-fb-feed-inner">
                    <?php
                    /**
                     * facebook_feed_author hook.
                     *
                     * @hooked FacebookFeedTemplateHandler::renderFeedAuthor 10
                     * */
                    do_action('wpsocialreviews/facebook_feed_author', $feed, $template_meta);

                    /**
                     * facebook_feed_description hook.
                     *
                     * @hooked FacebookFeedTemplateHandler::renderFeedDescription 10
                     * */
                    do_action('wpsocialreviews/facebook_feed_description', $feed, $template_meta);
                    ?>

                    <div class="wpsr-fb-feed-content-wrapper wpsr-fb-feed-playmode" data-feed_type="<?php echo esc_attr($feed_type); ?>" data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr($template_meta['post_settings']['display_mode']); ?>" data-template-id="<?php echo esc_attr($templateId); ?>">
                        <?php
                        /**
                         * facebook_feed_media hook.
                         *
                         * @hooked FacebookFeedTemplateHandler::renderFeedMedia 10
                         * */
                        do_action('wpsocialreviews/facebook_feed_media', $feed, $template_meta);
                        ?>
                    </div>

                    <?php
                    /**
                     * facebook_feed_summary_card hook.
                     *
                     * @hooked FacebookFeedTemplateHandler::renderFeedSummaryCard 10
                     * */
                    do_action('wpsocialreviews/facebook_feed_summary_card', $feed, $template_meta);

                    /**
                     * facebook_feed_statistics hook.
                     *
                     * @hooked FacebookFeedTemplateHandler::renderFeedStatistics 10
                     * */
                    do_action('wpsocialreviews/facebook_feed_statistics', $feed, $template_meta, $translations);
                    ?>
                </div>
                <?php } ?>

                <div class="wpsr-fb-feed-playmode" data-feed_type="<?php echo esc_attr($feed_type); ?>" data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr($template_meta['post_settings']['display_mode']); ?>" data-template-id="<?php echo esc_attr($templateId); ?>">
                <?php
                    if($feed_type === 'photo_feed') {
                        /**
                         * facebook_feed_media hook.
                         *
                         * @hooked FacebookFeedTemplateHandler::renderFeedMedia 10
                         * */
                        do_action('wpsocialreviews/facebook_feed_media', $feed, $template_meta);
                    }

                    if($feed_type === 'video_feed') {
                        /**
                         * facebook_feed_videos hook.
                         *
                         * @hooked render_facebook_feed_videos 10
                         * */
                        do_action('wpsocialreviews/facebook_feed_videos', $feed, $template_meta);
                    }
                ?>
                </div>
            </div>
        <?php if ($layout_type !== 'carousel') { ?>
        </div>
        <?php } ?>
        <?php
        }
    }
}