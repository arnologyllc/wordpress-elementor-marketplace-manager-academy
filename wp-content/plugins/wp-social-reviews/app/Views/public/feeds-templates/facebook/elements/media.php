<?php
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper;

$feed_type = Arr::get($template_meta, 'source_settings.feed_type');
$status_type = Arr::get($feed, 'status_type');
$display_mode = Arr::get($template_meta, 'post_settings.display_mode');
$permalink_url = $display_mode !== 'none' && $feed_type === 'timeline_feed' ? esc_url(Arr::get($feed, 'permalink_url')) : esc_url(Arr::get($feed, 'link'));
$attrs = [
    'class'  => 'class="wpsr-feed-link"',
    'target' => $display_mode !== 'none' ? 'target="_blank"' : '',
    'rel'    => 'rel="nofollow"',
    'href'   =>  $display_mode !== 'none' ? 'href="'.esc_url($permalink_url).'"' : '',
];
?>
<div class="wpsr-fb-feed-image">
    <?php if($feed_type === 'timeline_feed' && Arr::get($feed, 'attachments')){ ?>
    <a <?php Helper::printInternalString(implode(' ', $attrs)); ?>>
        <?php if(!defined('WPSOCIALREVIEWS_PRO')){ ?>
          <span class="wpsr-fb-media-placeholder-icon">
              <?php if($status_type !== 'added_video' && Arr::get($feed, 'attachments.data.0.type') !== 'video_inline'){?>
              <i class="icon-picture-o"></i><?php echo __('Photo', 'wp-social-reviews'); ?>
              <?php } ?>
              <?php if($status_type === 'added_video' || Arr::get($feed, 'attachments.data.0.type') === 'video_inline') {?>
                  <i class="icon-video-camera"></i><?php echo __('Video', 'wp-social-reviews'); ?>
              <?php } ?>
          </span>
        <?php } ?>
        <?php
        /**
         * facebook_feed_image hook.
         *
         * @hooked render_facebook_feed_image 10
         * */
        do_action('wpsocialreviews/facebook_feed_image', $feed, $template_meta);
        ?>
    </a>
    <?php } ?>

    <?php
    /**
     * facebook_feed_photo_feed_image hook.
     *
     * @hooked render_facebook_feed_photo_feed_image 10
     * */
    do_action('wpsocialreviews/facebook_feed_photo_feed_image', $feed, $template_meta, $attrs);
    ?>
</div>
