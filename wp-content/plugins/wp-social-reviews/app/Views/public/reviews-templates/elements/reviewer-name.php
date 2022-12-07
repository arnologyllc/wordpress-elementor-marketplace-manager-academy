<?php use WPSocialReviews\App\Services\Helper; ?>
<<?php echo !empty($reviewer_url) ? 'a' : 'span'; ?> <?php Helper::printInternalString(implode(' ', $attrs)); ?>>
    <span class="wpsr-reviewer-name"><?php echo esc_html($reviewer_name); ?></span>
</<?php echo !empty($reviewer_url) ? 'a' : 'span'; ?>>