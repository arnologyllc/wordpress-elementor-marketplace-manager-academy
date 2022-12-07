<?php
use WPSocialReviews\Framework\Support\Arr;

$classes   = [];
$classes[] = $templateSettings['chat_bubble']['cb_button_text'] ? 'wpsr-fm-bubble-btn-has-text' : '';
$classes[] = sizeof($settings['channels']) === 1 && $settings['channels'][0]['name'] ? $settings['channels'][0]['name'] : '';
?>
<div class="wpsr-fm-chat-bubble">
    <a class="wpsr-fm-bubble-btn <?php echo esc_attr(implode(' ', $classes));?>"
       style="background-color:<?php echo esc_attr(Arr::get($settings, 'styles.widget_icon_bg_color', '')); ?>">
        <?php if($settings['layout_type'] !== 'icons' && sizeof($settings['channels']) === 1 && $settings['channels'][0]['name']){ ?>
            <img src="<?php echo esc_url(WPSOCIALREVIEWS_URL . 'assets/images/svg/'.$settings['channels'][0]['name'].'.svg'); ?>" alt="<?php echo esc_attr($settings['channels'][0]['label']); ?>" width="32" height="32">
        <?php } ?>

        <?php if(sizeof($settings['channels']) > 1){
         $icon = Arr::get($templateSettings, 'chat_bubble.cb_button_icon') ? Arr::get($templateSettings, 'chat_bubble.cb_button_icon') : 'icon1';
        ?>
        <img src="<?php echo esc_url(WPSOCIALREVIEWS_URL . 'assets/images/icon/chat-icon/'.$icon.'.svg'); ?>" alt="chat" width="32" height="32">
        <?php } ?>

        <?php if($settings['layout_type'] === 'icons'){ ?>
        <span class="wpsr-chat-icons-closee">
            <svg viewBox="0 0 16 16" style="fill: rgb(255, 255, 255);">
              <path d="M3.426 2.024l.094.083L8 6.586l4.48-4.479a1 1 0 011.497 1.32l-.083.095L9.414 8l4.48 4.478a1 1 0 01-1.32 1.498l-.094-.083L8 9.413l-4.48 4.48a1 1 0 01-1.497-1.32l.083-.095L6.585 8 2.106 3.522a1 1 0 011.32-1.498z"></path>
            </svg>
        </span>
        <?php } ?>
        <span><?php echo esc_html($templateSettings['chat_bubble']['cb_button_text']); ?></span>
    </a>
</div>
