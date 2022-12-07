<?php

use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Youtube\Helper as YoutubeHelper;

if (empty($feed)) {
    return;
}
?>
<div class="wpsr-yt-popup-overlay wpsr-yt-popup-open wpsrm-overlay wpsr_content">
    <div class="wpsr-yt-popup-box-wraper">
        <div class="wpsr-yt-popup-box-wraper-inner wpsrm_inner">
            <div class="wpsr-yt-popup-loader">
                <div class="wpsr-spinner-animation"></div>
            </div>
            <div class="wpsr-yt-popup-close-btn wpsrm_close"></div>
            <div class="wpsr-yt-popup-video-player">
                <?php
                $playlist = '';
                $videoId  = YoutubeHelper::getVideoId($feed);
                if (Arr::get($template_meta, 'popup_settings.video_loop') === 'true') {
                    $playlist = '&playlist=' . $videoId;
                }
                $autoplay = Arr::get($template_meta, 'popup_settings.autoplay') === 'true' ? 1 : 0;
                $url      = 'https://www.youtube.com/embed/' . $videoId . '?loop=1&rel=0&autoplay=' . $autoplay . '' . $playlist . '';
                ?>
                <iframe id="wpsr-yt-popup-video-iframe" src="<?php echo esc_url($url); ?>" frameborder="0"
                        allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
            <?php do_action('wpsocialreviews/youtube_popup_content', $feed, $template_meta, $header); ?>
        </div>
    </div>
</div>