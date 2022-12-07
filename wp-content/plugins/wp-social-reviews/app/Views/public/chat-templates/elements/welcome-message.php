<?php
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper;
?>
<div class="wpsr-fm-conversation">
    <?php if (Arr::get($templateSettings, 'chat_header.picture')) { ?>
    <div class="wpsr-fm-user-picture">
        <img src="<?php echo esc_url($templateSettings['chat_header']['picture']); ?>"
             alt="<?php echo esc_html($templateSettings['chat_header']['name']); ?>" width="40" height="40">
    </div>
    <?php } ?>
    <div class="wpsr-fm-chat">
        <div class="wpsr-fm-chat-bubbles">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="wpsr-fm-greeting-msg">
        <?php if (Arr::get($templateSettings, 'chat_body.greeting_msg')) { ?>
            <div class="wpsr-fm-msg-text">
                <?php
                $allowed_tags = Helper::allowedHtmlTags();
                echo wp_kses($templateSettings['chat_body']['greeting_msg'], $allowed_tags);
                ?>
            </div>
        <?php } ?>
    </div>
</div>