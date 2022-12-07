<div class="wpsr-tweet-quoted-status">
    <?php $permalink = 'https://twitter.com/' . $feed['user']['screen_name'] . '/status/' . $feed['id']; ?>
    <a href="<?php echo esc_url($permalink); ?>" target="_blank" class="wpsr-tweet-quoted-status-link"></a>
    <div class="wpsr-tweet-author-info">
        <?php
        /**
         * tweet_author_avatar hook.
         *
         * @hooked wpsr_render_tweet_author_avatar_html 10
         * */
        do_action('wpsocialreviews/tweet_author_avatar', $feed, $template_meta);
        ?>
        <div class="wpsr-tweet-author-links">
            <?php
            /**
             * tweet_author_info hook.
             *
             * @hooked wpsr_render_tweet_author_verified_icon_html 10
             * @hooked wpsr_render_tweet_author_name_html 5
             * */
            do_action('wpsocialreviews/tweet_author_info', $feed, $template_meta);
            ?>
            <div class="wpsr-tweet-author-username-time">
                <?php
                /**
                 * tweet_author_info hook.
                 *
                 * @hooked wpsr_render_tweet_time_html 10
                 * @hooked wpsr_render_tweet_author_username_html 10
                 * */
                do_action('wpsocialreviews/tweet_author_username', $feed, $template_meta);
                do_action('wpsocialreviews/tweet_time', $feed, $template_meta);
                ?>
            </div>
        </div>
        <!-- end wpsr-tweet-author-links -->
    </div>
    <?php
    /**
     * tweet_content hook.
     *
     * @hooked wpsr_render_tweet_content_html 10
     * */
    do_action('wpsocialreviews/tweet_content', $feed, $template_meta, $templateId, $index);
    ?>
</div>