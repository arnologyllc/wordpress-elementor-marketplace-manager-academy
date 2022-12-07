<?php

use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper as GlobalHelper;

//carousel
$dataAttrs  = array();
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

$dataAttrs[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'data-slider_settings=' . json_encode($sliderData) . '' : '';
$feed_type = Arr::get($feed_settings, 'source_settings.feed_type');

// wrapper classes
$classes   = array('wpsr-fb-feed-wrapper', 'wpsr-feed-wrap', 'wpsr_content');
$classes[] = 'wpsr-fb-feed-' . esc_attr($template) . '';
$classes[] = 'wpsr-fb-' . esc_attr($feed_type) . '';
$classes[] = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'wpsr-facebook-feed-slider-activate' : '';
$classes[] = $layout_type === 'masonry' ? 'wpsr-facebook-feed-masonry-activate' : '';
$classes[] = 'wpsr-fb-feed-template-' . esc_attr($templateId) . '';

$classes[] = Arr::get($feed_settings, 'post_settings.equal_height') === 'true' ? 'wpsr-has-equal-height' : '';
$classes[] = $feed_settings['layout_type'] === 'timeline' ? 'wpsr-fb-feed-layout-standard' : '';

$header_settings = $feed_settings['header_settings'];
$profile_photo_hide_class = $header_settings['display_profile_photo'] === 'false' ? 'wpsr-fb-feed-profile-pic-hide' : '';

echo '<div  id="wpsr-fb-feed-' . esc_attr($templateId) . '" class="' . esc_attr(implode(' ', $classes)) . '" ' . esc_attr(implode(' ',
        $dataAttrs)) . '  data-column="' . esc_attr($feed_settings['column_number']) . '">';
echo '<div class="wpsr-loader">
        <div class="wpsr-spinner-animation"></div>
    </div>';
echo '<div class="wpsr-container">';
?>

<?php if ($header_settings['display_header'] === 'true' && !empty($header)){ ?>
<div class="wpsr-row">
    <div class="wpsr-fb-feed-header wpsr-col-12 wpsr-gap-<?php echo esc_attr($column_gaps); ?> <?php echo esc_attr($profile_photo_hide_class); ?>">
    <?php if(Arr::get($header, 'cover') &&  $header_settings['display_cover_photo'] === 'true') {?>
        <div class="wpsr-fb-feed-user-profile-banner" >
            <img src="<?php echo esc_url($header['cover']['source']); ?>" alt="<?php echo esc_attr($header['name']); ?>">
        </div>
    <?php } ?>

    <div class="wpsr-fb-feed-user-info-wrapper">
        <div class="wpsr-fb-feed-user-info-head">
            <div class="wpsr-fb-feed-header-info">
                <?php if(Arr::get($header, 'picture') && $header_settings['display_profile_photo'] === 'true'){ ?>
                    <a rel="nofollow" href="<?php echo esc_url($header['link'] ); ?>" target="_blank" class="wpsr-fb-feed-user-profile-pic">
                        <img src="<?php echo esc_url($header['picture']['data']['url']) ?>" alt="<?php esc_attr($header['name']); ?>">
                    </a>
                <?php } ?>

                <div class="wpsr-fb-feed-user-info">
                    <?php if(Arr::get($header, 'name') && $header_settings['display_page_name'] === 'true'){ ?>
                    <div class="wpsr-fb-feed-user-info-name-wrapper">
                        <a class="wpsr-fb-feed-user-info-name" rel="nofollow" href="<?php echo esc_url($header['link']); ?>" title="<?php echo esc_attr($header['name']); ?>" target="_blank">
                            <?php echo esc_html($header['name']); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if(Arr::get($header, 'about') && $header_settings['display_description'] === 'true'){ ?>
                        <div class="wpsr-fb-feed-user-info-description">
                            <p><?php echo esc_html($header['about']); ?></p>
                        </div>
                    <?php } ?>

                    <?php if(Arr::get($header, 'fan_count') !== 0 && $header_settings['display_likes_counter'] === 'true'){ ?>
                    <div class="wpsr-fb-feed-user-statistics">
                        <span><?php echo GlobalHelper::shortNumberFormat($header['fan_count']).' '.Arr::get($translations, 'people_like_this');?></span>
                    </div>
                    <?php } ?>
                </div>

                <div class="wpsr-fb-feed-follow-button-group">
                    <?php
                        /**
                         * facebook_feed_like_button hook.
                         *
                         * @hooked render_facebook_feed_like_button_html 10
                         * */
                        if (Arr::get($feed_settings, 'like_button_settings.like_button_position') !== 'footer') {
                            do_action('wpsocialreviews/facebook_feed_like_button', $feed_settings, $header);
                        }

                        /**
                         * facebook_feed_share_button hook.
                         *
                         * @hooked render_facebook_feed_share_button_html 10
                         * */
                        if (Arr::get($feed_settings, 'share_button_settings.share_button_position') !== 'footer') {
                            do_action('wpsocialreviews/facebook_feed_share_button', $feed_settings, $header);
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>

    </div>
</div>
<?php }


echo '<div class="wpsr-fb-feed-wrapper-inner">';
if($layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO')) {
    echo '<div class="swiper-container">';
}
$rowClasses = $layout_type === 'carousel' && defined('WPSOCIALREVIEWS_PRO') ? 'swiper-wrapper' : 'wpsr-row';

echo '<div class="'.esc_attr($rowClasses).' wpsr-fb-all-feed wpsr_feeds wpsr-column-gap-' . esc_attr($column_gaps) . '"">';
