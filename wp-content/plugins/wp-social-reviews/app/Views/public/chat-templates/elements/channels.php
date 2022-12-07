<?php
use WPSocialReviews\App\Services\Platforms\Chats\Helper as chatHelper;
use WPSocialReviews\Framework\Support\Arr;
?>
<div class="wpsr-fm-chat-btn-wrapper">
    <div class="wpsr-fm-btn-icon">
            <?php if ( $settings['channels'] && sizeof($settings['channels']) === 1){
                $isUrl = chatHelper::isUrl($settings['channels'][0]['credential']);
                $credential = $isUrl ? $settings['channels'][0]['credential'] : $settings['channels'][0]['webUrl'] . $settings['channels'][0]['credential'];
                if(strpos($credential, 'mailto') !== false || strpos($credential, 'tel') !== false){
                    $credential = chatHelper::encodeCredentials($credential);
                }
                $credential = str_replace('=+', '=', $credential);
                ?>
            <a role="button"
               data-chat-url="<?php echo esc_attr($credential); ?>"
               data-channel="<?php echo esc_attr($settings['channels'][0]['name']); ?>"
               style="background-color:<?php echo esc_attr(Arr::get($settings, 'styles.channel_icon_bg_color', '')); ?>"
               class="wpsr-fm-btn <?php echo esc_attr($settings['channels'][0]['name']); ?>"
            >
                <span><?php echo esc_html($settings['chat_button']['button_text']); ?></span>
                <?php
                if ($settings['chat_button']['display_icon'] === 'true') {
                    if (strpos($credential, 'fluentform_modal')) {
                        echo do_shortcode($credential);
                    }
                    if (!strpos($credential, 'fluentform_modal')) {
                    ?>
                    <img src="<?php echo esc_url(WPSOCIALREVIEWS_URL . 'assets/images/svg/'.$settings['channels'][0]['name'].'.svg'); ?>" alt="<?php echo esc_attr($settings['channels'][0]['name']); ?>" width="32" height="32">
                    <?php } ?>
                <?php } ?>
            </a>
            <?php } ?>
            <?php if (sizeof($settings['channels']) > 1){ ?>
            <span class="wpsr-fm-multiple-btn"><?php echo esc_html($settings['chat_button']['button_text']); ?></span>
            <div class="wpsr-channels <?php echo sizeof($settings['channels']) == 1 ? 'wpsr-social-channel' : ''; ?>">
                <?php
                $app->view->render('public.chat-templates.elements.channels-button', array(
                    'templateSettings'   => $templateSettings,
                    'settings'           => $settings
                ));
                ?>
            </div>
            <?php } ?>
    </div>
</div>