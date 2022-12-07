<a target="_blank"
   href="<?php echo esc_url('https://twitter.com/' . $feed['user']['screen_name'] . '/status/' . $feed['id_str']); ?>"
   class="wpsr-tweet-time">
    <?php
    $created_at = strtotime($feed['created_at']);
    /* translators: %s: Human-readable time difference. */
    echo sprintf(__('%s ago'), human_time_diff($created_at));
    ?>
</a>