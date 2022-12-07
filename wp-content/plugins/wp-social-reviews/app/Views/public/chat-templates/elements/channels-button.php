<?php
use WPSocialReviews\App\Services\Platforms\Chats\Helper as chatHelper;
use WPSocialReviews\Framework\Support\Arr;
?>
<?php foreach ($settings['channels'] as $key => $channel){
    $isUrl = chatHelper::isUrl($channel['credential']);
    $credential = $isUrl ? $channel['credential'] : $channel['webUrl'] . $channel['credential'];
    ?>
    <div class="wpsr-channel-item <?php echo esc_attr($channel['name'].$key); ?>">
        <?php if($settings['layout_type'] === 'icons'){ ?>
            <span class="wpsr-channel-name">
                <?php
                $label = esc_html($channel['label']);
                echo apply_filters('wpsocialreviews/'.$channel['name'].'_chat_channel_label', $label);
                ?>
            </span>
        <?php } ?>

        <?php
            if(strpos($credential, 'fluentform_modal')){
                echo do_shortcode($credential);
            }
            if(!strpos($credential, 'fluentform_modal')){
                if(strpos($credential, 'mailto') !== false || strpos($credential, 'tel') !== false){
                    $credential = chatHelper::encodeCredentials($credential);
                }
                $credential = str_replace('=+', '=', $credential);
        ?>
        <a role="button"
           data-chat-url="<?php echo esc_attr($credential); ?>"
           data-channel="<?php echo esc_attr($channel['name']); ?>"
           style="background-color:<?php echo esc_attr(Arr::get($settings, 'styles.channel_icon_bg_color', '')); ?>"
           class="wpsr-channel-btn <?php echo esc_attr($channel['name']); ?> <?php echo esc_attr($channel['name'].$key); ?>""
        >
            <?php
            if ($settings['chat_button']['display_icon'] === 'true') {
               ?>
                <img src="<?php echo esc_url(WPSOCIALREVIEWS_URL . 'assets/images/svg/'.$channel['name'].'.svg'); ?>" alt="<?php echo esc_attr($channel['name']); ?>" width="32" height="32">
              <?php
            }
            ?>
        </a>
        <?php } ?>
    </div>
<?php } ?>