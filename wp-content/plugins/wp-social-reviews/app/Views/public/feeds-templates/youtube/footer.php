<?php
echo '</div>'; // row end

if( $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '</div>'; // swiper container end
    echo '<div class="wpsr-swiper-carousel-wrapper">';
        if( $feed_settings['carousel_settings']['navigation'] === 'arrow' || $feed_settings['carousel_settings']['navigation'] === 'both') {
            echo '<div class="wpsr-swiper-prev-next wpsr-swiper-next swiper-button-next"></div>
              <div class="wpsr-swiper-prev-next wpsr-swiper-prev swiper-button-prev"></div>';
        }
        if( $feed_settings['carousel_settings']['navigation'] === 'dot' || $feed_settings['carousel_settings']['navigation'] === 'both') {
            echo '<div class="wpsr-swiper-pagination swiper-pagination"></div>';
        }
    echo '</div>';
}

$mt_30 = $column_gaps === 'no_gap' ? 'wpsr-mt-20' : '';
$feedType = isset($feed_settings['source_settings']['feed_type']) ? $feed_settings['source_settings']['feed_type'] : '';
// wpsr-youtube-footer start
if (($pagination_type === 'load_more') || (!empty($header) && $feed_settings['subscribe_button_settings']['subscribe_button_position'] !== 'header') ) {
    echo '<div class="wpsr-youtube-footer wpsr-row ' . esc_attr($mt_30) . '">';
    if ($total > $paginate && $layout_type !== 'carousel' && $pagination_type === 'load_more') {
        echo '<div class="wpsr-yt-load-more wpsr_more wpsr-load-more-default"
                id="wpsr-yt-load-more-btn-' . esc_attr($templateId) . '"
                data-paginate="' . esc_attr($paginate) . '"
                data-platform="youtube"
                data-page="1"
                data-template_id="' . esc_attr($templateId) . '"
                data-total="' . esc_attr($total) . '">
                ' . $feed_settings['pagination_settings']['load_more_button_text'] . '
                <div class="wpsr-load-icon-wrapper"><span></span></div>
            </div>';
    }
// wpsr-youtube-footer end
    if (!empty($header) && isset($feed_settings['subscribe_button_settings']['subscribe_button_position']) && $feed_settings['subscribe_button_settings']['subscribe_button_position'] !== 'header' && ($feedType !== 'search_feed' && $feedType !== 'single_video')) {
        /**
         * youtube_channel_subscribe_btn hook.
         *
         * @hooked wpsr_render_youtube_channel_subscribe_btn_html 10
         * */
        do_action('wpsocialreviews/youtube_channel_subscribe_btn', $header,
            $feed_settings['subscribe_button_settings']);
    }
    echo '</div>';
}
if (($layout_type !== 'carousel' && $pagination_type === 'prev_next' && defined('WPSOCIALREVIEWS_PRO')) && (isset($feed_settings['video_settings']) && $feed_settings['video_settings']['play_mode'] !== 'gallery')) {
    do_action('wpsocialreviews/render_youtube_prev_next_pagination', $templateId, $paginate, $total, '');
}
echo '</div>'; //wpsr-yt-feed-wrapper-inner end
echo '</div>'; // wpsr-container end
echo '</div>'; // wpsr-yt-feed-wrapper end

do_action('wpsocialreviews/youtube_template_wrapper_end');
