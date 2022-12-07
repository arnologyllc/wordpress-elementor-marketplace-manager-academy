<?php use WPSocialReviews\App\Services\Helper; ?>
<div class="wpsr-reviewer-image">
    <<?php echo !empty($reviewer_url) ? 'a' : 'span'; ?> <?php Helper::printInternalString(implode(' ', $attrs)); ?>>
        <?php if (!empty($reviewer_img)) {?>
            <?php if(strpos($reviewer_img, 'secure.gravatar.com') !== false){ ?>
                <img class="wpsr-reviewer-avatar" src="<?php echo esc_url($reviewer_img); ?>" width="80" height="80" alt="<?php echo esc_attr($reviewer_name); ?>"/>
            <?php } else { ?>
                <img class="wpsr-reviewer-avatar" src="<?php echo esc_url($reviewer_img); ?>" alt="<?php echo esc_attr($reviewer_name); ?>"/>
            <?php } ?>
        <?php } else { ?>
            <img class="wpsr-reviewer-avatar" src="<?php echo esc_url(WPSOCIALREVIEWS_URL . 'assets/images/template/review-template/placeholder-image.png'); ?>" alt="<?php echo esc_attr($reviewer_name); ?>"/>
        <?php } ?>
    </<?php echo !empty($reviewer_url) ? 'a' : 'span'; ?>>
</div>