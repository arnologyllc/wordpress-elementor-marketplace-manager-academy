<?php

use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper as TwitterHelper;
use WPSocialReviews\Framework\Support\Arr;
if (!empty($feeds) && is_array($feeds)) {
    foreach ($feeds as $index => $feed) {
        if ($index >= $sinceId && $index <= $maxId) {
            $retweeted_tweet = isset($feed['retweeted_status']) ? $feed['retweeted_status'] : '';
            $quoted_tweet    = isset($feed['quoted_status']) ? $feed['quoted_status'] : '';
            $tweet_action_target = Arr::get($template_meta, 'advance_settings.tweet_action_target', 'popup');

            if ((isset($template_meta['advance_settings']['show_retweeted_tweet']) && $template_meta['advance_settings']['show_retweeted_tweet'] === 'false' && $retweeted_tweet) || (isset($template_meta['advance_settings']['show_quoted_tweet']) && $template_meta['advance_settings']['show_quoted_tweet'] === 'false' && $quoted_tweet)) {
                continue;
            }
            ?>
            <div class="wpsr-twitter-tweet">
                <?php
                /**
                 * tweet_author_avatar hook.
                 *
                 * @hooked wpsr_render_tweet_author_avatar_html 10
                 * */
                do_action('wpsocialreviews/tweet_author_avatar', $feed, $template_meta);
                ?>
                <div class="wpsr-twitter-author-tweet">
                    <?php
                    /**
                     * tweet_retweeted_status hook.
                     *
                     * @hooked wpsr_render_tweet_retweeted_status_html 10
                     * */
                    do_action('wpsocialreviews/tweet_retweeted_status', $feed);
                    ?>
                    <div class="wpsr-tweet-author-info">
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
                        <!-- end wpsr-tweet-author-links -->
                        <?php if (isset($template_meta['advance_settings']) && $template_meta['advance_settings']['twitter_logo'] === 'true') { ?>
                            <div class="wpsr-tweet-logo">
                                <a target="_blank"
                                   href="<?php echo esc_url('https://twitter.com/' . $feed['user']['screen_name'] . '/status/' . $feed['id_str']); ?>">
                                    <?php echo TwitterHelper::getSvgIcons('twitter_logo'); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <!-- end wpsr-tweet-author-links -->
                    </div>
                    <!-- end wpsr-tweet-author-info -->
                    <?php
                    /**
                     * tweet_content hook.
                     *
                     * @hooked wpsr_render_tweet_content_html 10
                     * */
                    do_action('wpsocialreviews/tweet_content', $feed, $template_meta, $templateId, $index);
                    ?>
                    <div class="wpsr-tweet-actions" data-actions="<?php echo esc_attr($tweet_action_target); ?>">
                        <?php
                        /**
                         * tweet_author_info hook.
                         *
                         * @hooked wpsr_render_tweet_action_favorite_count 15
                         * @hooked wpsr_render_tweet_action_retweet_count 10
                         * @hooked wpsr_render_tweet_action_reply 5
                         * */
                        do_action('wpsocialreviews/tweet_actions', $feed, $template_meta);
                        ?>
                    </div>
                    <!-- end wpsr-tweet-actions -->
                </div>
                <!-- end wpsr-twitter-author-tweet -->
            </div>
            <!-- end wpsr-twitter-tweet -->
            <?php
        } //if condition end
    }
    ?>
    <?php
}