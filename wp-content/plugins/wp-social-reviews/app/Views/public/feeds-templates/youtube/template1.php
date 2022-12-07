<?php
if (!empty($feeds) && is_array($feeds)) {
    $layout_type = isset($template_meta['layout_type']) ? $template_meta['layout_type'] : 'grid';
    $layout_type = $layout_type !== 'grid' && !defined('WPSOCIALREVIEWS_PRO') ? 'grid' : $layout_type;
    foreach ($feeds as $index => $feed) {
        if ($index >= $sinceId && $index <= $maxId) {
            ?>
            <?php
                if ($layout_type !== 'carousel') {
                    /**
                     * youtube_feed_template_item_wrapper_before hook.
                     *
                     * @hooked YoutubeTemplateHandler::renderTemplateItemWrapper 10 - (outputs opening divs for the template item)
                     **/
                    do_action('wpsocialreviews/youtube_feed_template_item_wrapper_before', $template_meta);
                }
             ?>

            <div class="wpsr-yt-video <?php echo ($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) ? 'swiper-slide' : ''; ?>">
                <?php
                /**
                 * youtube_feed_preview_image hook.
                 *
                 * @hooked YoutubeTemplateHandler::renderPreviewImage 10
                 **/
                do_action('wpsocialreviews/youtube_feed_preview_image', $feed, $template_meta, $index, $templateId,
                    $feed_info);
                ?>
                <div class="wpsr-yt-video-info">
                    <?php
                    /**
                     * youtube_feed_title hook.
                     *
                     * @hooked YoutubeTemplateHandler::renderTitle 10
                     **/
                    do_action('wpsocialreviews/youtube_feed_title', $feed, $template_meta, $index, $templateId);

                    /**
                     * youtube_feed_statistics hook.
                     *
                     * @hooked wpsr_render_youtube_feed_statistics_html 10
                     **/
                    do_action('wpsocialreviews/youtube_feed_statistics', $feed, $template_meta, $feed_info, $index,
                        $templateId);

                    /**
                     * youtube_feed_description hook.
                     *
                     * @hooked wpsr_render_youtube_feed_description_html 10
                     **/
                    do_action('wpsocialreviews/youtube_feed_description', $feed, $template_meta);
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




