<span class="wpsr-fb-feed-time">
  <?php
  $created_at = strtotime($feed['updated_time']);
  /* translators: %s: Human-readable time difference. */
  echo sprintf(__('%s ago'), human_time_diff($created_at));
  ?>
</span>