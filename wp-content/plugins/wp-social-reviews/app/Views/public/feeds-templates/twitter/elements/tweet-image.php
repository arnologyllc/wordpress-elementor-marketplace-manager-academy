<div class="wpsr-tweet-media">
    <?php
    $permalink = 'https://twitter.com/' . $feed['user']['screen_name'] . '/status/' . $feed['id'];
    if ($show_image_video_popup === 'true') {
    ?>
    <a href="<?php echo esc_url($media_url) ?>" target="_blank" rel="nofollow" class="wpsr-twitter-playmode"
       data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr('popup'); ?>"
       data-template-id="<?php echo esc_attr($templateId); ?>"
       data-permalink="<?php echo esc_url($permalink); ?>" data-image="<?php echo esc_url($media_url); ?>">
        <?php } else { ?>
        <a href="<?php echo esc_url($permalink) ?>" target="_blank" rel="nofollow">
            <?php } ?>
            <img class="wpsr-tweet-media-img-render" src="<?php echo esc_url($media_url) ?>" alt="Image" loading="lazy">
        </a>
</div>