<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\Database\DBMigrator;
use WPSocialReviews\Database\DBSeeder;

class ActivationHandler
{
    public function handle($network_wide = false)
    {
        DBMigrator::run($network_wide);
        update_option('_wp_social_ninja_version', WPSOCIALREVIEWS_VERSION, 'no');

        $this->setPluginInstallTime();
    }

    public function setPluginInstallTime()
    {
        $statuses = get_option( 'wpsr_statuses', []);
        if( !isset($statuses['installed_time']) ){
            $statuses['installed_time'] = strtotime("now") ;
            update_option('wpsr_statuses', $statuses, false);
        }
    }
}
