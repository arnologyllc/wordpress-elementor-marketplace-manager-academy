<h3 class="wpsr-yt-video-title">
    <a class="wpsr-yt-video-playmode" data-videoid="<?php echo esc_attr($videoId); ?>"
       data-index="<?php echo esc_attr($index); ?>"
       data-playmode="<?php echo isset($template_meta['video_settings']['play_mode']) ? esc_attr($template_meta['video_settings']['play_mode']) : 'inline'; ?>"
       data-template_id="<?php echo esc_attr($templateId); ?>"
       target="_blank"
       rel="noopener noreferrer"
    >
        <?php
        if ($trim_title_words) {
            echo esc_html(wp_trim_words($feed['snippet']['title'], $trim_title_words, '...'));
        } else {
            echo esc_html($feed['snippet']['title']);
        }
        ?>
    </a>
</h3>
