<?php
    /* translators: %s: Human-readable time difference. */
    $human_time_diff = sprintf(__('%s ago'), human_time_diff(strtotime($review_time)));
?>
<span data-time="<?php echo esc_attr($human_time_diff); ?>" class="wpsr-review-date">
     <?php
         $date_format = get_option( 'date_format' );
         echo date_i18n($date_format, strtotime($review_time));
     ?>
</span>