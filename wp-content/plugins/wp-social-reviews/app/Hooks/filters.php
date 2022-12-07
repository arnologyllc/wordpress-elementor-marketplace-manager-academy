<?php

/**
 * All registered filter's handlers should be in app\Hooks\Handlers,
 * addFilter is similar to add_filter and addCustomFlter is just a
 * wrapper over add_filter which will add a prefix to the hook name
 * using the plugin slug to make it unique in all wordpress plugins,
 * ex: $app->addCustomFilter('foo', ['FooHandler', 'handleFoo']) is
 * equivalent to add_filter('slug-foo', ['FooHandler', 'handleFoo']).
 */

/**
 * $app
 * @var WPFluent\Foundation\Application
 */

add_filter('cron_schedules', function ($schedules) {
    // Adds custom schedules to the existing schedules.

    if (!isset($schedules['5min'])) {
        $schedules['5min'] = array(
            'display'  => __('5 min', 'wp-social-reviews'),
            'interval' => 300,
        );
    }

    if (!isset($schedules['2days'])) {
        $schedules['2days'] = array(
            'display'  => __('Every 2 Day', 'wp-social-reviews'),
            'interval' => 172800,
        );
    }

    if (!isset($schedules['3days'])) {
        $schedules['3days'] = array(
            'display'  => __('Every 3 Day', 'wp-social-reviews'),
            'interval' => 259200,
        );
    }

    if (!isset($schedules['1week'])) {
        $schedules['1week'] = array(
            'display'  => __('Every 1 Week', 'wp-social-reviews'),
            'interval' => 604800,
        );
    }

    if (!isset($schedules['2weeks'])) {
        $schedules['2weeks'] = array(
            'display'  => __('Every 2 Week', 'wp-social-reviews'),
            'interval' => 1209600,
        );
    }

    if (!isset($schedules['1month'])) {
        $schedules['1month'] = array(
            'display'  => __('1 Month', 'wp-social-reviews'),
            'interval' => 60 * 60 * 24 * 30,
        );
    }

    if (!isset($schedules['1year'])) {
        $schedules['1year'] = array(
            'display'  => __('1 Year', 'wp-social-reviews'),
            'interval' => 60 * 60 * 24 * 365,
        );
    }

    return $schedules;
});

add_filter('admin_footer_text', function ($footer_text) {
    $current_screen = get_current_screen();
    $is_wpsn_screen = ($current_screen && false !== strpos($current_screen->id, 'wpsocialninja'));
    if ($is_wpsn_screen) {
        $footer_text = sprintf(
            __('We hope you are enjoying %1$s - %2$s - %3$s - %4$s', 'wp-social-reviews'),
            '<strong>' . __('WP Social Ninja', 'wp-social-reviews') . '</strong>',
            '<a href="https://wpsocialninja.com/docs/" target="_blank">Read Documentation</a>',
            '<a href="https://wpsocialninja.com/terms-conditions/" target="_blank">Terms & Conditions</a>',
            '<a href="https://wpsocialninja.com/privacy-policy/" target="_blank">Privacy Policy</a>'
        );
    }
    return $footer_text;
}, 11, 1);

/*
 * Exclude For WP Rocket Settings
 */
if (defined('WP_ROCKET_VERSION')) {
    add_filter('rocket_excluded_inline_js_content', function ($lines) {
        $lines[] = 'wpsr_popup_params';
        $lines[] = 'wpsr_ajax_params';
        $lines[] = 'WPSR_';
        $lines[] = 'wpsr_';
        return $lines;
    });

    add_filter('rocket_exclude_defer_js', function ($defers) {
        $defers[] = str_replace(ABSPATH, '/', WP_PLUGIN_DIR) . '/wp-social-reviews/assets/js/(.*).js';
        return $defers;
    });
}

// shortpixel plugin replace the IG cdn urls - we will add this filter by user feedback
//add_filter('shortpixel/ai/customRules', function($regexItems){
//    return [];
//});
