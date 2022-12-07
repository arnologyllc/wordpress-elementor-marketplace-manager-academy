<?php
use WPSocialReviews\Framework\Support\Arr;
$close_button_color = Arr::get($settings, 'styles.close_button_color', '#1d2129');

if($settings['channels'] && in_array('fluent_forms', $channel_name)){ ?>
    <div class="wpsr-fm-chat-box">
        <?php if( Arr::get($settings, 'layout_type') !== 'icons' ) {?>
            <div class="wpsr-fm-chat-close" style="--wpsn-chat-close-btn-color: <?php echo ($close_button_color) ? esc_attr($close_button_color) : '#1d2129'; ?>"></div>
        <?php } ?>

        <?php
        $app->view->render('public.chat-templates.elements.fluent-form', array(
            'templateSettings' => $templateSettings,
            'settings' => $settings
        ));
        ?>
    </div>
<?php }

$btn_icons_class = sizeof($settings['channels']) > 1 ? 'wpsr-channels-icons' : 'wpsr-channels-icon';

echo '<div class="wpsr-channels '.esc_attr($btn_icons_class).'">';
$app->view->render('public.chat-templates.elements.channels-button', array(
    'templateSettings'   => $templateSettings,
    'settings'           => $settings
));
echo '</div>';