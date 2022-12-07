<?php use WPSocialReviews\Framework\Support\Arr;
$close_button_color = Arr::get($settings, 'styles.close_button_color', '#1d2129');
?>

<div class="wpsr-fm-chat-box">
    <div class="wpsr-fm-chat-close" style="--wpsn-chat-close-btn-color: <?php echo ($close_button_color) ? esc_attr($close_button_color) : '#1d2129'; ?>"></div>
    <?php
    if ( $settings['channels'] && (sizeof($settings['channels']) >= 1 && !in_array('fluent_forms', $channel_name)) || (sizeof($settings['channels']) >= 1 && in_array('fluent_forms', $channel_name)) ){
        $app->view->render('public.chat-templates.elements.header', array(
            'settings' => $settings,
            'templateSettings' => $templateSettings,
        ));
    }

    if($settings['channels'] && sizeof($settings['channels']) >= 1 && in_array('fluent_forms', $channel_name) ) {
        $app->view->render('public.chat-templates.elements.fluent-form', array(
            'templateSettings' => $templateSettings,
            'settings' => $settings
        ));
    }

    if ( $settings['channels'] && (sizeof($settings['channels']) >= 1 && !in_array('fluent_forms', $channel_name)) || (sizeof($settings['channels']) >= 1 && in_array('fluent_forms', $channel_name)) ){
        echo '<div class="wpsr-fm-chat-room">';

        $app->view->render('public.chat-templates.elements.welcome-message', array(
            'templateSettings' => $templateSettings,
            'settings' => $settings
        ));

        $app->view->render('public.chat-templates.elements.channels', array(
            'templateSettings' => $templateSettings,
            'settings' => $settings,
            'app' => $app
        ));
        echo '</div>';
    }
    ?>
</div>