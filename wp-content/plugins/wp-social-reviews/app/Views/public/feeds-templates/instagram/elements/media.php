<?php use WPSocialReviews\Framework\Support\Arr; ?>
<div class="wpsr-ig-post-media" id="wpsr-video-play-<?php echo esc_attr($index); ?>">
    <?php if (isset($template_meta['source_settings']['feed_type']) && $feed['media_type'] === 'VIDEO' && isset($feed['media_url'])) { ?>
        <video class="wpsr-ig-post-video" poster="<?php echo esc_url(Arr::get($feed, 'thumbnail_url')); ?>" <?php echo ($template_meta["post_settings"]["display_mode"] === 'inline') ? 'controls=controls preload=auto' : ''?>>
            <source src="<?php echo esc_url($feed['media_url']); ?>" type="video/mp4">
        </video>
    <?php } ?>

    <?php if (isset($template_meta['source_settings']['feed_type']) && $template_meta['source_settings']['feed_type'] === 'hashtag_feed' && isset($feed['media_type']) && $feed['media_type'] === 'IMAGE' && isset($feed['media_url'])) { ?>
        <img class="wpsr-ig-post-img" src="<?php echo esc_url($feed['media_url']); ?>"
             alt="<?php echo isset($feed['caption']) ? esc_attr($feed['caption']) : ''; ?>" loading="lazy">
    <?php } ?>

    <?php if (isset($template_meta['source_settings']['feed_type']) && $template_meta['source_settings']['feed_type'] !== 'hashtag_feed' && $feed['media_type'] === 'IMAGE' && isset($feed['media_url'])) { ?>
        <img class="wpsr-ig-post-img" src="<?php echo esc_url($feed['media_url']); ?>"
             alt="<?php echo isset($feed['caption']) ? esc_attr($feed['caption']) : ''; ?>" loading="lazy">
    <?php } ?>

    <?php if (isset($feed['media_type']) && $feed['media_type'] === 'CAROUSEL_ALBUM' && $feed['children']['data'][0]['media_type'] === 'IMAGE' && isset($feed['children']['data'][0]['media_url'])) { ?>
        <img class="wpsr-ig-post-img" src="<?php echo esc_url($feed['children']['data'][0]['media_url']); ?>" loading="lazy">
    <?php } ?>

    <?php if (isset($feed['media_type']) && $feed['media_type'] === 'CAROUSEL_ALBUM' && $feed['children']['data'][0]['media_type'] === 'VIDEO' && isset($feed['children']['data'][0]['media_url'])) { ?>
        <video class="wpsr-ig-post-video" poster="<?php echo esc_url(Arr::get($feed, 'children.data.0.thumbnail_url', '')); ?>" <?php echo ($template_meta["post_settings"]["display_mode"] === 'inline') ? 'controls=controls preload=auto' : ''?>>
            <source src="<?php echo esc_url($feed['children']['data'][0]['media_url']); ?>" type="video/mp4">
        </video>
    <?php } ?>

    <?php if (isset($feed['media_type']) && $feed['media_type'] !== 'IMAGE') { ?>
        <div class="wpsr-ig-post-type-icon wpsr-ig-post-type-<?php echo esc_attr($feed['media_type']); ?>"></div>
    <?php } ?>
</div>