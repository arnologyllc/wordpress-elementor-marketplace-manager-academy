<?php
use WPSocialReviews\Framework\Support\Arr;

$sliderData              = Arr::get($template_meta, 'carousel_settings');
$show_header             = Arr::get($template_meta, 'show_header');
$header_enable           = $show_header && $template_meta['show_header'] === 'true' ? 'wpsr-header-enable' : '';
$masonry                 = $templateType === 'masonry' ? 'wpsr-active-masonry-layout' : '';
$fixed_height            = $show_header && $template_meta['show_header'] === 'true' ? 'wpsr-fixed-height' : '';
$content_length_deactive = isset($template_meta['contentType']) && $template_meta['contentType'] === 'content_in_scrollbar' ? 'wpsr-reviews-content-length-deactive' : '';
$template                = isset($template_meta['template']) ? $template_meta['template'] : '';
$equal_height            = $template_meta['equal_height'] === 'true' && $template_meta['contentType'] === 'excerpt' ? 'wpsr-has-equal-height' : '';
$hasSlider               = $templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-reviews-slider-wrapper' : '';
$wrapperId               = $templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-reviews-slider-'.$templateId : 'wpsr-reviews-grid-'.$templateId;
$position                = $templateType === 'notification' ? 'wpsr-'.$template_meta['notification_settings']['notification_position'] : '';


$wrapperAttsArray = [
    'id' => esc_attr($wrapperId),
    'class' => 'wpsr-reviews-' . esc_attr($templateId) . '  wpsr-reviews-wrapper wpsr-feed-wrap wpsr_content '.esc_attr($position) .' '.esc_attr($hasSlider) . ' '.esc_attr($equal_height). ' ' . esc_attr($content_length_deactive) .' wpsr-reviews-template-'. esc_attr($template).' wpsr-reviews-layout-'.esc_attr($templateType).' '.esc_attr($header_enable),
    'data-column'=> Arr::get($template_meta, 'column')
];

if($templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO')) {
    $wrapperAttsArray['data-slider_settings'] = json_encode($sliderData);
}

$wrapperAtts = '';

foreach ($wrapperAttsArray as $key => $value) {
    $wrapperAtts .= $key."='".$value."' ";
}

echo '<div '.$wrapperAtts.'>';
if($templateType === 'badge'){
    echo '<a class="wpsr-popup-close" href="#">
    <svg viewBox="0 0 16 16" style="fill: rgb(255, 255, 255);">
       <path d="M3.426 2.024l.094.083L8 6.586l4.48-4.479a1 1 0 011.497 1.32l-.083.095L9.414 8l4.48 4.478a1 1 0 01-1.32 1.498l-.094-.083L8 9.413l-4.48 4.48a1 1 0 01-1.497-1.32l.083-.095L6.585 8 2.106 3.522a1 1 0 011.32-1.498z">
       </path>
    </svg>
    </a>';
}

if($templateType === 'notification') {
    echo '<a class="wpsr-popup-collapse" href="#" data-notification_id="'.esc_attr($templateId).'">
      <i class="icon-angle-right"></i>
      </a>';
}
echo '<div class="wpsr-container ' . esc_attr($fixed_height) . '" style="max-width:' . esc_attr($template_meta['template_width']) . '" >';

do_action('wpsocialreviews/render_reviews_template_business_info', $reviews, $business_info, $template_meta, $templateId, $translations);

if($template_meta['enable_schema'] === 'true'){
    $name = Arr::get($template_meta, 'schema_settings.business_name');
    $type = Arr::get($template_meta, 'schema_settings.business_type');
    $image = Arr::get($template_meta, 'schema_settings.business_logo');
    $telephone = Arr::get($template_meta, 'schema_settings.business_telephone');
    $business_average_rating = Arr::get($template_meta, 'schema_settings.business_average_rating');
    $business_total_rating   = Arr::get($template_meta, 'schema_settings.business_total_rating');

    $average_rating = Arr::get($business_info, 'average_rating', 0);
    $ratingValue = $average_rating !== 0 ? $average_rating : $business_average_rating;

    $total_rating = Arr::get($business_info, 'total_rating', 0);
    $ratingCount = $total_rating !== 0 ? $total_rating : $business_total_rating;

    $schema = '{
      "@context": "https://schema.org/",
      "@type": "AggregateRating",
      "itemReviewed": {
        "@type": "'.$type.'",
        "image": "'.$image.'",
        "name": "'.$name.'",
        "telephone": "'.$telephone.'"
      },
      "ratingValue": "'.number_format($ratingValue, 1).'",
      "bestRating": "5",
      "ratingCount": "'.$ratingCount.'"
    }';

    echo '<script type="application/ld+json">';
    echo  $schema;
    echo '</script>';
}

echo isset($template_meta['show_header']) && $template_meta['show_header'] === 'true' ? '<div class="wpsr-row" style="height:' . esc_attr($template_meta['template_height']) . '">' : '';

do_action('wpsocialreviews/reviews_template_wrapper_start');

if($templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="wpsr-reviews-slider-wrapper-inner">';
}
$has_header = $show_header && $template_meta['show_header'] === 'true' ? 'wpsr-review-fixed-height-wrap' : 'wpsr-row';
echo ($templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO')) ? '<div class="wpsr-reviews-slider swiper-container">'
    : '<div class="wpsr-all-reviews wpsr_feeds ' . esc_attr($has_header) . ' ' . esc_attr($masonry) . '" data-column="' . esc_attr($template_meta['column']) . '">';
if($templateType === 'slider' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="swiper-wrapper">';
}