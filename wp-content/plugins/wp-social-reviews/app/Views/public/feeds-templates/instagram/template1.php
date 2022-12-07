<?php
if (!empty($feeds) && is_array($feeds)) {
    $layout_type = isset($template_meta['layout_type']) && defined('WPSOCIALREVIEWS_PRO') ? $template_meta['layout_type'] : 'grid';
    foreach ($feeds as $index => $feed) {
        if ($index >= $sinceId && $index <= $maxId && isset($feed['media_url'])) {

                if ($layout_type !== 'carousel') {
                    /**
                     * instagram_feed_template_item_wrapper_before hook.
                     *
                     * @hooked InstagramTemplateHandler::renderTemplateItemWrapper - 10 (outputs opening divs for the template item)
                     * */
                    do_action('wpsocialreviews/instagram_feed_template_item_wrapper_before', $template_meta);
                }
            ?>
            <div class="wpsr-ig-post <?php echo ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : ''; ?>">
                <a class="wpsr-ig-playmode" <?php echo ($template_meta['post_settings']['display_mode'] === 'instagram' && isset($feed['permalink'])) ? 'href=' . esc_url($feed['permalink']) . '' : ''; ?>
                   target="<?php echo ($template_meta['post_settings']['display_mode'] === 'instagram') ? '_blank' : ''; ?>"
                   data-index="<?php echo esc_attr($index); ?>"
                   data-playmode="<?php echo isset($template_meta['post_settings']['display_mode']) ? esc_attr($template_meta['post_settings']['display_mode']) : 'instagram'; ?>"
                   data-template-id="<?php echo esc_attr($templateId); ?>"
                   rel="noopener noreferrer"
                >
                    <?php
                    /**
                     * instagram_post_media hook.
                     *
                     * @hooked InstagramTemplateHandler::renderPostMedia 10
                     * */
                    do_action('wpsocialreviews/instagram_post_media', $feed, $template_meta, $index);
                    ?>
                </a>
                <?php if (count($feed) > 6) { ?>
                    <div class="wpsr-ig-post-info">
                        <?php
                        /**
                         * instagram_post_statistics hook.
                         *
                         * @hooked render_instagram_statistics_html 10
                         * */
                        do_action('wpsocialreviews/instagram_post_statistics', $feed, $template_meta);

                        /**
                         * instagram_post_caption hook.
                         *
                         * @hooked InstagramTemplateHandler::renderPostCaption 10
                         * */
                        do_action('wpsocialreviews/instagram_post_caption', $feed, $template_meta);

                        /**
                         * instagram_icon hook.
                         *
                         * @hooked InstagramTemplateHandler::renderIcon 10
                         * */
                        do_action('wpsocialreviews/instagram_icon');
                        ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ($layout_type !== 'carousel') { ?>
                </div>
            <?php } ?>
            <?php
        }
    }
}