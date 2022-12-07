<div class="wpsr-review-content">
    <?php if ($content_length && $contentType === 'excerpt') { ?>
        <p class="wpsr_add_read_more wpsr_show_less_content" data-num-words-trim="<?php echo esc_attr($content_length); ?>"><?php echo wp_kses($reviewer_text, $allowed_tags); ?></p>
    <?php } else { ?>
        <p class="wpsr-review-full-content"><?php echo wp_kses($reviewer_text, $allowed_tags); ?></p>
    <?php } ?>
</div>