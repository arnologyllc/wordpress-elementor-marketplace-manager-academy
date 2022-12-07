<?php use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper; ?>
<a target="_blank"
   href="<?php echo esc_url('https://twitter.com/intent/tweet?in_reply_to=' . $feed['id_str'] . '&related=' . $feed['user']['screen_name']); ?>"
   class="wpsr-tweet-reply">
    <?php echo Helper::getSvgIcons('action_reply'); ?>
</a>