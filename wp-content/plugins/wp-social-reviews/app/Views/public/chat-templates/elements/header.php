<?php
use WPSocialReviews\Framework\Support\Arr;
?>
<div id="wpsr-chat-active-status" class="wpsr-fm-chat-header"
     style="background-color:<?php echo isset($settings['styles']['header_color']) ? $settings['styles']['header_color'] : ''; ?>">

    <?php if (Arr::get($templateSettings, 'chat_header.picture')) { ?>
    <div class="wpsr-chat-user-img">
        <img src="<?php echo esc_url($templateSettings['chat_header']['picture']); ?>"
             alt="<?php echo esc_html($templateSettings['chat_header']['name']); ?>" width="70" height="70">
    </div>
    <?php } ?>

    <div class="wpsr-fm-group-details">

        <?php if (Arr::get($templateSettings, 'chat_header.name')) { ?>
        <h3 style="color:<?php echo isset($settings['styles']['header_title_color']) ? $settings['styles']['header_title_color'] : ''; ?>">
            <?php echo esc_html($templateSettings['chat_header']['name']); ?>
        </h3>
        <?php } ?>

        <?php if (Arr::get($templateSettings, 'chat_header.caption')) { ?>
            <p class="wpsr-fm-caption"
               style="color:<?php echo isset($settings['styles']['header_caption_color']) ? $settings['styles']['header_caption_color'] : ''; ?>">
                <?php echo esc_html($templateSettings['chat_header']['caption']); ?>
            </p>
        <?php } ?>

        <?php if (Arr::get($settings, 'settings.caption_when_offline')) { ?>
            <p class="wpsr-fm-offline-caption"
               style="color:<?php echo isset($settings['styles']['header_caption_color']) ? $settings['styles']['header_caption_color'] : ''; ?>">
                <?php echo esc_html($settings['settings']['caption_when_offline']); ?>
            </p>
        <?php } ?>
    </div>
</div>