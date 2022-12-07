<?php

use WPSocialReviews\Framework\Support\Arr;

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
echo '<div class="wpsr-ig-footer wpsr-row ' . esc_attr($mt_30) . '">';
//pagination
if (count($feeds) > $paginate && $layout_type !== 'carousel' && $pagination_type === 'load_more' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="wpsr-ig-load-more wpsr_more wpsr-load-more-default"
        id="wpsr-ig-load-more-btn-' . esc_attr($templateId) . '"
        data-paginate="' . intval($paginate) . '"
        data-template_id="' . intval($templateId) . '"
        data-template_type="' . esc_attr($layout_type) . '"
        data-platform="instagram"
        data-page="1"
        data-total="' . intval($total) . '">
        '.$feed_settings['pagination_settings']['load_more_button_text'].'
    <div class="wpsr-load-icon-wrapper"><span></span></div>
    </div>';
}

if (Arr::get($feed_settings, 'follow_button_settings.follow_button_position') !== 'header') {
    /**
     * instagram_follow_button hook.
     *
     * @hooked render_instagram_follow_button_html 10
     * */
    do_action('wpsocialreviews/instagram_follow_button', $feed_settings);
}
echo '</div>';
echo '</div>'; // wpsr-ig-feed-wrapper-inner end

echo '</div>'; // wpsr-container end
echo '</div>'; // wpsr-yt-feed-wrapper end