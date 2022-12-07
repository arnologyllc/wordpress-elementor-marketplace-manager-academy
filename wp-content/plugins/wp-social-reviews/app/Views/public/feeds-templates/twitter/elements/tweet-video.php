<?php

use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper as TwitterHelper;

if ($has_external_media && !$soundcloud && $show_tweet_video === 'true') {
    $iframe_video_url = TwitterHelper::getIframeVideoUrl($feed);
    if (isset($iframe_video_url)) { ?>
        <div class="wpsr-tweet-media">
        <?php if ($show_image_video_popup === 'true') { ?>
        <a href="<?php echo esc_url($iframe_video_url) ?>" target="_blank" class="wpsr-tweet-video-frame">
        <?php echo TwitterHelper::getSvgIcons('video_player'); ?>
        <?php } else { ?>
        <div class="wpsr-tweet-video-frame">
    <?php } ?>
        <iframe class="wpsr-tweet-video-frame-render" type="text/html" src="<?php echo esc_url($iframe_video_url); ?>" frameborder="0"
                ebkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        <?php if ($show_image_video_popup === 'true') { ?>
            </a>
        <?php } else { ?>
            </div>
        <?php } ?>
        </div>
    <?php }
} elseif ($soundcloud > 0) {
    $soundcloud_url = explode("?", $external_media_url);
    $iframe_src     = 'https://w.soundcloud.com/player/?url=' . $soundcloud_url[0] . '&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;visual=false';
    echo '<div class="wpsr-tweet-mp3-frame"><iframe src="' . esc_url($iframe_src) . '" type="text/html"  frameborder="0" width="100%" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe></div>';
} else {
    $video_url = TwitterHelper::getHighQualityVideo($feed);
    if (isset($video_url)) {
        ?>
        <div class="wpsr-tweet-media">
            <?php if ($media_type === 'animated_gif' && $advanced_settings['show_tweet_gif'] === 'true') { ?>
                <?php if ($show_image_video_popup === 'true') { ?>
                    <a href="<?php echo esc_url($video_url) ?>" class="wpsr-twitter-playmode" target="_blank" data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr('popup'); ?>" data-template-id="<?php echo esc_attr($templateId); ?>"
                    data-video="<?php echo esc_url($video_url); ?>">
                <?php } ?>
                <video class="wpsr-tweet-media-video-render" loop muted="muted" autoplay="" poster="<?php echo esc_url($preview_image); ?>" width="100%;">
                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                </video>
                <?php if ($show_image_video_popup === 'true') { ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <?php if ($media_type === 'video' && $show_tweet_video === 'true') { ?>
                    <?php if ($show_image_video_popup === 'true') { ?>
                        <a href="<?php echo esc_url($video_url); ?>" class="wpsr-twitter-playmode" target="_blank"
                           data-index="<?php echo esc_attr($index); ?>" data-playmode="<?php echo esc_attr('popup'); ?>"
                           data-template-id="<?php echo esc_attr($templateId); ?>"
                           data-video="<?php echo esc_url($video_url); ?>">
                            <img src="<?php echo esc_url($preview_image); ?>" alt="">
                            <?php echo TwitterHelper::getSvgIcons('video_player'); ?>
                        </a>
                    <?php } else { ?>
                        <video ass="wpsr-tweet-media-video-render" playsinline controls poster="<?php echo esc_url($preview_image); ?>"
                               width="100%;">
                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        </video>
                    <?php } ?>
                <?php }
            } ?>
        </div>
        <?php
    }
}