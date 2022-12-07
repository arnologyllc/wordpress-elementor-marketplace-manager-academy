<?php

use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\Framework\Support\Arr;

$translations =  GlobalSettings::getTranslations();
?>
<div data-rating="<?php echo esc_attr($rating); ?>" class="wpsr-rating-wrapper">
    <?php if ($rating_style === 'default' && $platform_name !== 'facebook' && $platform_name !== 'booking.com') { ?>
        <div class="wpsr-rating">
            <?php echo Helper::generateRatingIcon($rating); ?>
        </div>
    <?php } ?>

    <?php if ($rating_style === 'default' && $platform_name === 'booking.com' && $platform_name !== 'facebook') { ?>
        <div class="wpsr-booking-rating-style">
            <span class="review-badge"><?php echo number_format(floatval($rating), 1); ?></span>
        </div>
    <?php } ?>

    <?php if ($rating_style === 'style1' && $platform_name !== 'facebook') { ?>
        <div class="wpsr-rating-style-1">
            <?php echo __('Rated', 'wp-social-reviews'); ?>
            <span><?php echo number_format(floatval($rating), 1); ?></span>
        </div>
    <?php } ?>

    <?php if ($rating_style === 'style2' && $platform_name !== 'facebook') { ?>
        <div class="wpsr-rating-style-2">
			<span class="wpsr-rating-float"><?php echo number_format(floatval($rating), 1); ?></span>
            <div class="wpsr-rating"><?php echo Helper::generateRatingIcon($rating); ?></div>
        </div>
    <?php } ?>

    <?php if ($platform_name === 'facebook') { ?>
        <div class="wpsr-recommends">
            <svg width="18" height="18">
                <path d="M9 14l-3.293 3.293A1 1 0 0 1 4 16.586V14h-.154c-1.337 0-1.822-.14-2.311-.4A2.726 2.726 0 0 1 .4 12.464c-.261-.488-.4-.973-.4-2.309v-6.31c0-1.336.14-1.821.4-2.31A2.726 2.726 0 0 1 1.536.4c.488-.261.973-.4 2.309-.4h10.31c1.336 0 1.821.14 2.31.4.49.262.873.646 1.134 1.135.262.489.401.974.401 2.31v6.31c0 1.336-.14 1.821-.4 2.31a2.726 2.726 0 0 1-1.135 1.134c-.489.262-.974.401-2.31.401H9zm0-5l1.454.765a.5.5 0 0 0 .726-.527l-.278-1.62 1.177-1.147a.5.5 0 0 0-.277-.853l-1.626-.236-.728-1.474a.5.5 0 0 0-.896 0l-.728 1.474-1.626.236a.5.5 0 0 0-.277.853l1.177 1.147-.278 1.62a.5.5 0 0 0 .726.527L9 9z"></path>
            </svg>
            <?php echo ($recommendation_type === 'positive') ? '<span>' . Arr::get($translations, 'recommends') . '</span>' : '<span>' .Arr::get($translations, 'does_not_recommend')  . '</span>'; ?>
        </div>
    <?php } ?>
</div>