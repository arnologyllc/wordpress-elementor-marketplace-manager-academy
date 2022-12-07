<?php use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper; ?>

<div class="wpsr-retweeted">
    <a target="_blank"
       href="<?php echo esc_url('https://twitter.com/' . $feed['user']['screen_name'] . '/status/' . $feed['id_str']); ?>">
        <?php echo Helper::getSvgIcons('retweeted'); ?>
    </a>
    <a target="_blank" href="<?php echo esc_url('https://twitter.com/' . $feed['user']['screen_name']); ?>"
       class="wpsr-tweet-author-name"><span><?php echo esc_html($feed['user']['screen_name']); ?><?php echo __(' Retweeted',
                'wp-social-reviews'); ?></span></a>
</div>