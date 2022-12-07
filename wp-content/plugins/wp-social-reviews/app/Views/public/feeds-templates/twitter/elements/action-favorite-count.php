<?php use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper; ?>
<a target="_blank"
   rel="noopener noreferrer"
   href="<?php echo esc_url('https://twitter.com/intent/like?tweet_id=' . $feed['id_str'] . '&related=' . $feed['user']['screen_name']); ?>"
   class="wpsr-tweet-like">
    <?php echo Helper::getSvgIcons('action_favourite'); ?>
    <span><?php echo esc_html($favorite_count); ?></span>
</a>