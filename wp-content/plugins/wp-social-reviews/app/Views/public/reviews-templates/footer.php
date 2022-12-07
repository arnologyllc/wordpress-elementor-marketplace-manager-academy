<?php
use WPSocialReviews\Framework\Support\Arr;
echo '</div>';
if($template_meta['templateType'] === 'slider' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '</div>'; // swiper wrapper end
    if($template_meta['carousel_settings']['navigation'] !== 'none') {
        echo '<div class="wpsr-swiper-carousel-wrapper">';
        if ($template_meta['carousel_settings']['navigation'] === 'arrow' || $template_meta['carousel_settings']['navigation'] === 'both') {
            echo '<div class="wpsr-swiper-prev-next wpsr-swiper-next swiper-button-next"></div>
          <div class="wpsr-swiper-prev-next wpsr-swiper-prev swiper-button-prev"></div>';
        }
        if ($template_meta['carousel_settings']['navigation'] === 'dot' || $template_meta['carousel_settings']['navigation'] === 'both') {
            echo '<div class="wpsr-swiper-pagination swiper-pagination"></div>';
        }
        echo '</div>';
    }

    echo '</div>';  // wpsr-reviews-slider-wrapper-inner end
}

do_action('wpsocialreviews/reviews_template_wrapper_end');

if (($template_meta['templateType'] !== 'slider' && $template_meta['pagination_type'] === 'load_more') && ($totalReviews > $template_meta['paginate'])) {
    echo '<div class="wpsr-reviews-loadmore wpsr_more" id="wpsr-reviews-load-more-btn' . esc_attr($templateId) . '" data-paginate="' . esc_attr($template_meta['paginate']) . '" data-template_id="' . esc_attr($templateId) . '" data-page="1" data-platform="reviews" data-template_type="' . $template_meta['templateType'] . '" data-total="' . $totalReviews . '"><span>' . $template_meta['load_more_button_text'] .'</span></div>';
}

$display_read_all_reviews_btn = Arr::get($template_meta, 'notification_settings.display_read_all_reviews_btn');
if($templateType === 'notification' && $display_read_all_reviews_btn === 'true') {
    echo '<div class="wpsr-reviews-footer-cta">';
    $read_all_reviews_btn_text = Arr::get($translations, 'read_all_reviews');
    $read_all_reviews_btn_url = Arr::get($template_meta, 'notification_settings.read_all_reviews_btn_url', '#');
    echo '<a href="'.esc_url($read_all_reviews_btn_url).'" target="_blank" rel="nofollow">'.esc_html($read_all_reviews_btn_text).'</a>';
    echo '</div>';
}

echo ($template_meta['show_header'] === 'true') ? '</div>' : '';
echo '</div>';
echo '</div>';