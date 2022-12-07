<?php

namespace WPSocialReviews\App\Hooks\Handlers;

class DeactivationHandler
{
    public function handle()
    {
        // deprecated schedule hook will remove in future release
	    wp_clear_scheduled_hook('wpsr_cron_job');
    }
}
