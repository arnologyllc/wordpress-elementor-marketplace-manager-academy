<?php use WPSocialReviews\App\Services\Platforms\Reviews\Helper;

?>
<div class="wpsr-review-platform">
    <?php $platform_icon = Helper::platformIcon($platform_name, 'small'); ?>
    <img class="wpsr-review-platform-icon" width="20" height="20" src="<?php echo esc_url($platform_icon); ?>" alt="<?php echo esc_attr($platform_name); ?>">
</div>