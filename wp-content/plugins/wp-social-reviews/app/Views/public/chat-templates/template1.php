<?php
use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\Framework\Support\Arr;

$app   = App::getInstance();

$dataParams = '';
$popup_delay = '';
$display_popup = '';

$channel_name = array_column($settings['channels'], 'name');

$classes                            = array();
$classes['has_pro']                 = defined('WPSOCIALREVIEWS_PRO') ? 'wpsr_pro_active' : '';
$classes['chat_single']             = sizeof($settings['channels']) > 1 ? 'wpsr_has_multiple_chat_channel' : '';
$classes['btn-position']            = $settings['settings']['chat_bubble_position'] ? 'wpsr-fm-bubble-position-' . $settings['settings']['chat_bubble_position'] : '';
$classes['template']                = $settings['template'] ? 'wpsr-fm-chat-' . $settings['template'] : '';
$classes['layout']                  = $settings['layout_type'] === 'icons' ? 'wpsr-chat-icons-layout' : '';
$classes['fuent_forms']             = in_array('fluent_forms', $channel_name) ? 'wpsr-has-fluent-forms-widget' : '';
$classes['ff_modal']                = sizeof($settings['channels']) === 1 && strpos($settings['channels'][0]['credential'], 'fluentform_modal') ? 'wpsr_has_ff_modal' : '';

if (isset($settings['settings']['day_time_schedule']) && $settings['settings']['day_time_schedule'] === 'true') {
    $dataParams = apply_filters('wpsocialreviews/display_user_online_status', $settings['settings']);
}

if(Arr::get($settings, 'settings.display_greeting') === 'true'){
    $display_popup = Arr::get($settings, 'settings.display_greeting');
    $display_popup = 'data-chat-display-popup='.$display_popup.'';
    $popup_delay = Arr::get($settings, 'settings.popup_delay');
    $popup_delay = 'data-chat-popup-delay='.$popup_delay.'';
}

$popup_target = Arr::get($settings, 'settings.popup_target', 'false');
$popup_target_data   = 'data-popup-target='.$popup_target.'';
$chats_params_data   = !empty($dataParams) && is_array($dataParams) ? ' data-chats-params="' . htmlspecialchars(json_encode($dataParams), ENT_QUOTES, 'UTF-8') . '"' : '';
?>
<div data-chats-side="front"
     id="wpsr-chat-widget-<?php echo esc_attr($template_id); ?>"
     class="wpsr-fm-chat-wrapper <?php echo esc_attr(implode(' ', $classes)); ?>"
     style="--wpsn-chat-channel-icon-bg-color: <?php echo Arr::get($settings, 'styles.channel_icon_bg_color', '#EA4335'); ?>"
     <?php echo esc_attr($popup_delay) .' '.esc_attr($display_popup).' '.esc_attr($popup_target_data).' '.$chats_params_data; ?>
>
    <?php
        if(Arr::get($settings, 'layout_type', 'chat_box')){
            $app->view->render('public.chat-templates.elements.'.$settings['layout_type'].'-layout', array(
                'app'                => $app,
                'templateSettings'   => $templateSettings,
                'settings'           => $settings,
                'channel_name'       => $channel_name
            ));
        }

        if($settings['layout_type'] === 'chat_box' || sizeof($settings['channels']) > 1){
            $app->view->render('public.chat-templates.elements.bubble-icon', array(
                'templateSettings'   => $templateSettings,
                'settings'           => $settings
            ));
        }
    ?>
</div>

