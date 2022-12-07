<?php

namespace WPSocialReviews\App\Services;

use WP_Widget;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register a widget that render a feed shortcode
 * @since 1.3.0
 */
class SidebarWidgets extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'wpsn-widget',
            __('WP Social Ninja', 'wp-social-reviews'),
            array('description' => __('Display your feed in a widget', 'wp-social-reviews'))
        );
    }

    public function widget($args, $instance)
    {

        $title   = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $content = isset($instance['content']) ? strip_tags($instance['content']) : '';

        Helper::printInternalString($args['before_widget']);

        if (!empty($title)) {
            echo Arr::get($args, 'before_title') . esc_html($title) . Arr::get($args, 'after_title');
        }

        echo do_shortcode($content); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

        Helper::printInternalString($args['after_widget']);
    }

    public function form($instance)
    {

        $title   = isset($instance['title']) ? $instance['title'] : '';
        $content = isset ($instance['content']) ? strip_tags($instance['content']) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('content')); ?>"
                  rows="10"><?php echo strip_tags($content); ?></textarea>
        <?php
    }


    public function update($new_instance, $old_instance)
    {
        $instance            = array();
        $instance['title']   = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['content'] = (!empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';

        return $instance;
    }
}