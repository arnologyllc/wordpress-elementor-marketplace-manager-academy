<?php
/*
Plugin Name:  WP Social Ninja
Plugin URI:   https://wpsocialninja.com/
Description:  WP Social Ninja - is an all-in-one WordPress Social plugin to automatically integrate your social media reviews, news feeds, and chat functionalities on your website.
Version:      3.7.2
Author:       WPManageNinja LLC
Author URI:   https://wpmanageninja.com
License:      GPLv2 or later
Text Domain:  wp-social-reviews
Domain Path:  /language
*/

defined('ABSPATH') or die;

define('WPSOCIALREVIEWS_VERSION', '3.7.2');
define('WPSOCIALREVIEWS_DB_VERSION', 120);
define('WPSOCIALREVIEWS_MAIN_FILE', __FILE__);
define('WPSOCIALREVIEWS_BASENAME', plugin_basename(__FILE__));
define('WPSOCIALREVIEWS_URL', plugin_dir_url(__FILE__));
define('WPSOCIALREVIEWS_DIR', plugin_dir_path(__FILE__));

require __DIR__.'/vendor/autoload.php';

call_user_func(function($bootstrap) {
    $bootstrap(__FILE__);
}, require(__DIR__.'/boot/app.php'));


// Handle Newtwork new Site Activation
add_action('wp_insert_site', function ($blog) {
    switch_to_blog($blog->blog_id);

    if(!class_exists('\WPSocialReviews\App\Hooks\Handlers\ActivationHandler')) {
        include_once plugin_dir_path(__FILE__) . 'app/Hooks/Handlers/ActivationHandler.php';
    }

    (new \WPSocialReviews\App\Hooks\Handlers\ActivationHandler())->handle();
    restore_current_blog();
});

add_action('init', function () {
    load_plugin_textdomain('wp-social-reviews', false, basename(dirname(__FILE__)) . '/language');
});
