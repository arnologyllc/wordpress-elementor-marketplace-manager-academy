<?php use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper; ?>
<a target="_blank"
   href="<?php echo esc_url('https://twitter.com/intent/retweet?tweet_id=' . $feed['id_str'] . '&related=' . $feed['user']['screen_name']); ?>"
   class="wpsr-tweet-retweet">
    <?php echo Helper::getSvgIcons('action_retweet'); ?>
    <span><?php echo esc_html($retweet_count); ?></span>
</a>