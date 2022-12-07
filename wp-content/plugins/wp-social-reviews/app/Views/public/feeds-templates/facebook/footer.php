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
echo '<div class="wpsr-fb-feed-footer wpsr-fb-feed-follow-button-group wpsr-row ' . esc_attr($mt_30) . '">';
//pagination
if (count($feeds) > $paginate && $layout_type !== 'carousel' && $pagination_type === 'load_more') {
    echo '<div class="wpsr-fb-load-more wpsr_more wpsr-load-more-default"
        id="wpsr-fb-load-more-btn-' . esc_attr($templateId) . '"
        data-paginate="' . intval($paginate) . '"
        data-template_id="' . intval($templateId) . '"
        data-template_type="' . esc_attr($layout_type) . '"
        data-platform="facebook_feed"
        data-page="1"
        data-total="' . intval($total) . '">
        '.Arr::get($feed_settings, 'pagination_settings.load_more_button_text').'
    <div class="wpsr-load-icon-wrapper"><span></span></div>
    </div>';
}

if (Arr::get($feed_settings, 'share_button_settings.share_button_position') !== 'header') {

    /**
     * facebook_feed_like_button hook.
     *
     * @hooked render_facebook_feed_like_button_html 10
     * */
    if (Arr::get($feed_settings, 'like_button_settings.like_button_position') !== 'header') {
        do_action('wpsocialreviews/facebook_feed_like_button', $feed_settings, $header);
    }

    /**
     * facebook_feed_share_button hook.
     *
     * @hooked render_facebook_feed_share_button_html 10
     * */
    if (Arr::get($feed_settings, 'share_button_settings.share_button_position') !== 'header') {
        do_action('wpsocialreviews/facebook_feed_share_button', $feed_settings, $header);
    }
}
echo '</div>';

echo '</div>'; // wpsr-fb-feed-wrapper-inner end

echo '</div>'; // wpsr-container end
echo '</div>'; // wpsr-fb-feed-wrapper end