<?php
use WPSocialReviews\Framework\Support\Arr;
$status_type = Arr::get($feed, 'status_type');
$feed_type = Arr::get($template_meta, 'source_settings.feed_type');
$feed_url = $feed_type === 'video_feed' ? 'https://www.facebook.com'.$feed['permalink_url'] : $feed['permalink_url'];
?>
<div class="wpsr-fb-feed-author">
    <?php if( is_array($account)){ ?>

        <?php if( Arr::get($account, 'picture') && Arr::get($template_meta, 'post_settings.display_author_photo') === 'true'){ ?>
        <div class="wpsr-fb-feed-author-avatar">
            <a class="wpsr-fb-feed-author-avatar-url" target="_blank" href="<?php echo esc_url($account['link']); ?>" rel="nofollow noopener">
                <img class="wpsr-fb-feed-author-img" src="<?php echo esc_url($account['picture']['data']['url']); ?>" alt="<?php echo esc_url($account['name']); ?>" width="40" height="40">
            </a>
        </div>
        <?php } ?>

        <div class="wpsr-fb-feed-author-info">
            <?php if( Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){ ?>
            <a target="_blank" rel="nofollow" href="<?php echo esc_url($account['link']); ?>" class="wpsr-fb-feed-author-name">
                <span class="wpsr-fb-feed-author-name-render"><?php echo esc_html($account['name']); ?>️</span>
            </a>
            <?php } ?>

            <?php
            $story = Arr::get($feed, 'story');
            if($story && ($status_type === 'added_photos' || $status_type === 'mobile_status_update')){ ?>
                <span class="wpsr-fb-feed-story">
                   <?php
                   $index = strpos($story, 'updated');
                   if($index !== false){
                      echo ucfirst(substr($story, $index));
                   }
                   ?>
                </span>
            <?php } ?>

            <?php
                if(Arr::get($template_meta,'post_settings.display_date') === 'true'){
                    /**
                     * facebook_feed_date hook.
                     *
                     * @hooked FacebookFeedTemplateHandler::renderFeedDate 10
                     * */
                    do_action('wpsocialreviews/facebook_feed_date', $feed);
                }
            ?>
        </div>
        <?php if(Arr::get($template_meta,'post_settings.display_platform_icon') === 'true'){ ?>
        <a target="_blank" href="<?php echo esc_url($feed_url); ?>" class="wpsr-fb-feed-platform">
            <i class="icon-facebook-square"></i>
        </a>
        <?php } ?>
    <?php } ?>
</div>