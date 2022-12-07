<?php

//carousel
$sliderData = array();
if ($layout_type === 'carousel') {
    $sliderData = array(
        'autoplay'               => $feed_settings['carousel_settings']['autoplay'],
        'autoplay_speed'         => $feed_settings['carousel_settings']['autoplay_speed'],
        'slides_to_show'         => $feed_settings['carousel_settings']['slides_to_show'],
        'slides_to_scroll'       => $feed_settings['carousel_settings']['slides_to_scroll'],
        'navigation'             => $feed_settings['carousel_settings']['navigation'],
    );
}

$row = $layout_type === 'masonry' ? 'wpsr-row' : '';
// wrapper classes
$classes   = array();
$classes[] = $layout_type ? 'wpsr-twitter-' . $layout_type : '';
$classes[] = $layout_type !== 'standard' ? 'wpsr-container' : 'wpsr-twitter-tweets-wrapper';
$classes[] = $pagination_type === 'infinite' ? 'wpsr-twitter-infinite-scroll-active' : '';
$classes[] = (isset($feed_settings['advance_settings']) && $feed_settings['advance_settings']['show_twitter_card'] === 'true') && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-twitter-card-wrapper' : '';
$classes[] = (isset($feed_settings['advance_settings']) && $feed_settings['advance_settings']['equal_height'] === 'true') ? 'wpsr-twitter-equal-height' : '';
$classes[] = 'wpsr-tw-feed-template-' . esc_attr($templateId);

$dataAttrs   = array();
$dataAttrs[] = isset($feed_settings['column_number']) && $layout_type === 'masonry' ? 'data-column=' . $feed_settings['column_number'] . '' : '';
$dataAttrs[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'data-slider_settings=' . json_encode($sliderData) . '' : '';

echo '<div data-template-type="' . esc_attr($feed_settings['layout_type']) . '" data-template-id="' . esc_attr($templateId) . '" id="wpsr-twitter-tweet-' . esc_attr($templateId) . '" class="wpsr-twitter-feed-wrapper wpsr_content wpsr-feed-wrap ' . esc_attr(implode(' ', $classes)) . '" ' . esc_attr(implode(' ',
        $dataAttrs)) . '>';
$feedType = isset($feed_settings['additional_settings']['feed_type']) ? $feed_settings['additional_settings']['feed_type'] : '';
//render header
if ((isset($feed_settings['header_settings']) && $feed_settings['header_settings']['show_header'] === 'true') && defined('WPSOCIALREVIEWS_PRO') && $feedType !== 'hashtag') {
    echo apply_filters('wpsocialreviews/render_twitter_template_header',
        $header,
        $feed_settings,
        $translations
    );
}
echo '<div class="wpsr-twitter-wrapper-inner">';
if( $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="swiper-container">';
}
$swiperClasses = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'swiper-wrapper' : '';
echo '<div class="'.esc_attr($swiperClasses).' wpsr-twitter-all-tweets wpsr_feeds ' . esc_attr($row) . ' wpsr-column-gap-' . esc_attr($column_gaps) . '">';
