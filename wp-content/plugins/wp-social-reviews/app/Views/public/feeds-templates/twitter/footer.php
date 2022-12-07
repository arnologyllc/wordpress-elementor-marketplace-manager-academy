<?php
// end wpsr-twitter-all-tweets div
echo '</div>';

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
echo '<div class="wpsr-twitter-footer wpsr-row ' . esc_attr($mt_30) . '">';

//render pagination
if ($total > $paginate && $layout_type !== 'carousel' && $pagination_type !== 'none') {
    echo '<div 
    class="wpsr-twitter-loadmore wpsr_more wpsr-load-more-default" 
    id="wpsr-twitter-load-more-btn' . esc_attr($templateId) . '" 
    data-template_id="' . intval($templateId) . '" 
    data-template_type="' . esc_attr($layout_type) . '" 
    data-total="' . intval($total) . '" 
    data-page="1"
    data-platform="twitter"
    data-paginate="' . intval($paginate) . '" >' .
        $feed_settings['pagination_settings']['load_more_button_text'] .
         '<div class="wpsr-load-icon-wrapper"><span></span></div></div>';
}
$feedType = isset($feed_settings['additional_settings']['feed_type']) ? $feed_settings['additional_settings']['feed_type'] : '';
if (!empty($header) && isset($feed_settings['follow_button_settings']['follow_button_position']) && $feed_settings['follow_button_settings']['follow_button_position'] !== 'header' && $feedType !== 'hashtag') {
    /**
     * tweeter_user_profile_follow_btn hook.
     *
     * @hooked wpsr_render_tweeter_user_profile_follow_btn_html 10
     * */
    do_action('wpsocialreviews/tweeter_user_profile_follow_btn', $header, $feed_settings['follow_button_settings']);
}
// end wpsr-twitter-footer div
echo '</div>';

// end wpsr-twitter-wrapper-inner div
echo '</div>';

// end wpsr-twitter-tweets-wrapper div
echo '</div>';

