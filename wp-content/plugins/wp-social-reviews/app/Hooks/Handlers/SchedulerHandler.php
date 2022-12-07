<?php

namespace WPSocialReviews\App\Hooks\Handlers;

class SchedulerHandler
{
    private $feed_platforms = ['instagram', 'twitter', 'youtube', 'facebook_feed'];

	private $all_platforms = [
		'google',
		'airbnb',
		'zomato',
		'yelp',
		'tripadvisor',
		'amazon',
		'aliexpress',
		'booking.com',
		'facebook',
		'twitter',
		'youtube',
		'instagram',
        'facebook_feed'
	];

	/**
	 * @param $platform
	 * @return bool
	 */
	public function isActivePlatform($platform)
	{
        if(in_array($platform, $this->feed_platforms)) {
            return get_option('wpsr_' . $platform . '_verification_configs');
        } else {
            return  get_option('wpsr_reviews_' . $platform . '_settings');
        }
	}

	public function handle()
	{
		$platforms = apply_filters('wpsocialreviews/platforms', $this->all_platforms);
		foreach ($platforms as $platform) {
            $is_active = $this->isActivePlatform($platform);
			if ($is_active) {
				if (in_array($platform, $this->feed_platforms)){
					do_action('wpsr_' . $platform . '_feed_update');
					if ($platform === 'instagram') {
						do_action('wpsr_instagram_access_token_refresh_weekly');
					}
				} else {
					do_action('wpsr_' . $platform . '_reviews_update');
				}
			}
		}
	}
}
