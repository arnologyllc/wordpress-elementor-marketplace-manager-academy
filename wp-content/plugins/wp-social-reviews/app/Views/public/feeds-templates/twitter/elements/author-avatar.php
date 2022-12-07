<div class="wpsr-tweet-author-avatar <?php echo esc_attr($has_retweet); ?>">
    <a class="wpsr-tweet-author-avatar-url" target="_blank" href="<?php echo esc_url('https://twitter.com/' . $feed['user']['screen_name']); ?>">
        <img class="wpsr-tweet-author-avatar-img-render" src="<?php echo esc_url($feed['user']['profile_image_url']); ?>"
             alt="<?php echo esc_attr($feed['user']['name']); ?>">
    </a>
</div>