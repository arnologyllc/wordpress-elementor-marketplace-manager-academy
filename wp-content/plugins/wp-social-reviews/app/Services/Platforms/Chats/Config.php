<?php

namespace WPSocialReviews\App\Services\Platforms\Chats;

use WPSocialReviews\Framework\Support\Arr;

class Config
{
    public static function greetingMessage($settings, $template)
    {
        global $wpdb;
        $charset = $wpdb->get_col_charset( $wpdb->posts, 'post_content' );

        $message = '';
        if($template === 'template1'){
            $message = __('Hey there 👋 <br> It’s your friend Dany Williams. How can I help you?', 'wp-social-reviews');
        } elseif ($template === 'template2'){
            $message = __('Hello 👋 Thanks for your interest in us. Before we begin, may I know your name?', 'wp-social-reviews');
        } elseif ($template === 'template3'){
            $message = __('Hi there👋 Quick question - How do you like our WP Social Ninja plugin so far?', 'wp-social-reviews');
        } elseif ($template === 'template4'){
            $message = __('Hey! We’ve got a great sale offer running. I am happy to tell you about it. Let me know if you\'ve any questions.', 'wp-social-reviews');
        }

        $greeting_msg = wp_kses_post(Arr::get($settings, 'chat_settings.'.$template.'.chat_body.greeting_msg', $message));

        if('utf8' === $charset || 'latin1' === $charset) {
            $greeting_msg = wp_encode_emoji($greeting_msg);
        }
        return $greeting_msg;
    }

    public static function formatConfig($settings = [], $empty = false, $pageId = '')
    {
        $template = Arr::get($settings, 'chat_settings.template', 'template1');
        return array(
            'chat_settings' => array(
                'template'  => $template,
                'channels'  => Arr::get($settings, 'chat_settings.channels', []),
                'layout_type' => Arr::get($settings, 'chat_settings.layout_type', 'chat_box'),
                'chat_button'         => array(
                    'button_text'     => sanitize_text_field(Arr::get($settings, 'chat_settings.chat_button.button_text', __('Start Chat with:', 'wp-social-reviews'))),
                    'display_icon'    => Arr::get($settings, 'chat_settings.chat_button.display_icon', 'true')
                ),
                'settings' => array(
                    'chat_bubble_position'        => Arr::get($settings, 'chat_settings.settings.chat_bubble_position', 'bottom-right'),
                    'chat_bubble_scroll_position' => (int) Arr::get($settings, 'chat_settings.settings.chat_bubble_scroll_position', 20),
                    'post_types'                  => Arr::get($settings, 'chat_settings.settings.post_types', []),
                    'page_list'                   => Arr::get($settings, 'chat_settings.settings.page_list', array('-1')),
                    'exclude_page_list'           => Arr::get($settings, 'chat_settings.settings.exclude_page_list', array()),
                    'hide_on_desktop'             => Arr::get($settings, 'chat_settings.settings.hide_on_desktop', 'false'),
                    'hide_on_mobile'              => Arr::get($settings, 'chat_settings.settings.hide_on_mobile', 'false'),
                    'display_greeting'            => Arr::get($settings, 'chat_settings.settings.display_greeting', 'false'),
                    'popup_delay'                 => (int) Arr::get($settings, 'chat_settings.settings.popup_delay', 3000),
                    'popup_target'                => Arr::get($settings, 'chat_settings.settings.popup_target', 'false'),

                    //schedule time for chat to show
                    'day_time_schedule'           => isset($settings['chat_settings']['settings']['day_time_schedule']) && defined('WPSOCIALREVIEWS_PRO') ? $settings['chat_settings']['settings']['day_time_schedule'] : 'false',
                    'day_list'                    => Arr::get($settings, 'chat_settings.settings.day_list',
                        array(
                            __('Saturday', 'wp-social-reviews'),
                            __('Sunday', 'wp-social-reviews'),
                            __('Monday', 'wp-social-reviews'),
                            __('Tuesday', 'wp-social-reviews'),
                            __('Wednesday', 'wp-social-reviews'),
                            __('Thursday', 'wp-social-reviews'),
                            __('Friday', 'wp-social-reviews')
                        )),
                    'time_schedule'               => Arr::get($settings, 'chat_settings.settings.time_schedule', 'false'),
                    'start_time'                  => Arr::get($settings, 'chat_settings.settings.start_time', "03:07:26 PM"),
                    'end_time'                    => Arr::get($settings, 'chat_settings.settings.end_time', "03:07:26 PM"),
                    'caption_when_offline'        => sanitize_text_field(Arr::get($settings, 'chat_settings.settings.caption_when_offline', __('I will be back soon', 'wp-social-reviews')))
                ),
                'ff_settings'   => array(
                    'header_title'             => sanitize_text_field(Arr::get($settings, 'chat_settings.ff_settings.header_title', __('Contact Us', 'wp-social-reviews'))),
                ),
                'styles'              => array(
                    'widget_icon_bg_color' => Arr::get($settings, 'chat_settings.styles.widget_icon_bg_color', ''),
                    'channel_icon_bg_color'=> Arr::get($settings, 'chat_settings.styles.channel_icon_bg_color', ''),
                    'header_color'         => Arr::get($settings, 'chat_settings.styles.header_color', ''),
                    'header_title_color'   => Arr::get($settings, 'chat_settings.styles.header_title_color', ''),
                    'header_caption_color' => Arr::get($settings, 'chat_settings.styles.header_caption_color', ''),
                    'close_button_color'   => Arr::get($settings, 'chat_settings.styles.close_button_color', '#1d2129')
                ),
                'template1' => array(
                    'template'            => 'template1',
                    'chat_header'         => array(
                        'name'    => sanitize_text_field(Arr::get($settings, 'chat_settings.template1.chat_header.name', __('Dany Williams', 'wp-social-reviews'))),
                        'caption' => sanitize_text_field(Arr::get($settings, 'chat_settings.template1.chat_header.caption', __('Typically replies within an hour', 'wp-social-reviews'))),
                        'picture' => Arr::get($settings, 'chat_settings.template1.chat_header.picture', WPSOCIALREVIEWS_URL . 'assets/images/chat-imgs/user-profile.png')
                    ),
                    'chat_body'           => array(
                        'greeting_msg' => static::greetingMessage($settings, 'template1')
                    ),
                    'chat_bubble'         => array(
                        'cb_button_text' => sanitize_text_field(Arr::get($settings, 'chat_settings.template1.chat_bubble.cb_button_text', __('', 'wp-social-reviews'))),
                        'cb_button_icon' => sanitize_text_field(Arr::get($settings, 'chat_settings.template1.chat_bubble.cb_button_icon', '')),
                    ),
                ),
                'template2' => array(
                    'template'            => 'template2',
                    'chat_header'         => array(
                        'name'    => sanitize_text_field(Arr::get($settings, 'chat_settings.template2.chat_header.name', __('Chris Morphe', 'wp-social-reviews'))),
                        'caption' => sanitize_text_field(Arr::get($settings, 'chat_settings.template2.chat_header.caption', __('Typically replies within an hour', 'wp-social-reviews'))),
                        'picture' => Arr::get($settings, 'chat_settings.template2.chat_header.picture', WPSOCIALREVIEWS_URL . 'assets/images/chat-imgs/user-profile2.png')
                    ),
                    'chat_body'           => array(
                        'greeting_msg' => static::greetingMessage($settings, 'template2')
                    ),
                    'chat_bubble'         => array(
                        'cb_button_text' => sanitize_text_field(Arr::get($settings, 'chat_settings.template2.chat_bubble.cb_button_text', __('Need Help?', 'wp-social-reviews'))),
                        'cb_button_icon' => sanitize_text_field(Arr::get($settings, 'chat_settings.template2.chat_bubble.cb_button_icon', 'icon3')),
                    ),
                ),
                'template3' => array(
                    'template'            => 'template3',
                    'chat_header'         => array(
                        'name'    => sanitize_text_field(Arr::get($settings, 'chat_settings.template3.chat_header.name', __('Olivia Scott', 'wp-social-reviews'))),
                        'caption' => sanitize_text_field(Arr::get($settings, 'chat_settings.template3.chat_header.caption', __('QA Manager', 'wp-social-reviews'))),
                        'picture' => Arr::get($settings, 'chat_settings.template3.chat_header.picture', WPSOCIALREVIEWS_URL . 'assets/images/chat-imgs/user-profile3.png')
                    ),
                    'chat_body'           => array(
                        'greeting_msg' => static::greetingMessage($settings, 'template3')
                    ),
                    'chat_bubble'         => array(
                        'cb_button_text' => sanitize_text_field(Arr::get($settings, 'chat_settings.template3.chat_bubble.cb_button_text', __('Feedback', 'wp-social-reviews'))),
                        'cb_button_icon' => Arr::get($settings, 'chat_settings.template3.chat_bubble.cb_button_icon', 'icon4'),
                    ),
                ),
                'template4' => array(
                    'template'            => 'template4',
                    'chat_header'         => array(
                        'name'    => sanitize_text_field(Arr::get($settings, 'chat_settings.template4.chat_header.name', __('Leo Connor', 'wp-social-reviews'))),
                        'caption' => sanitize_text_field(Arr::get($settings, 'chat_settings.template4.chat_header.caption', __('Sales Manager', 'wp-social-reviews'))),
                        'picture' => Arr::get($settings, 'chat_settings.template4.chat_header.picture', WPSOCIALREVIEWS_URL . 'assets/images/chat-imgs/user-profile4.png')
                    ),
                    'chat_body'           => array(
                        'greeting_msg' => static::greetingMessage($settings, 'template4')
                    ),
                    'chat_bubble'         => array(
                        'cb_button_text' => sanitize_text_field(Arr::get($settings, 'chat_settings.template4.chat_bubble.cb_button_text', __('', 'wp-social-reviews'))),
                        'cb_button_icon' => Arr::get($settings, 'chat_settings.template4.chat_bubble.cb_button_icon', 'icon2'),
                    )
                ),
            )
        );
    }
}