<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds;

use WPSocialReviews\Framework\Support\Arr;

abstract class BaseFeed
{
    public $platform;

    public function __construct($platform)
    {
        $this->platform = $platform;
    }

    public function registerHooks()
    {
        add_filter('wpsocialreviews/available_valid_feed_platforms', array($this, 'pushValidPlatform'));

        //handle verification credentials
        add_action('wpsocialreviews/verify_credential_' . $this->platform, array($this, 'handleCredential'));
        add_action('wpsocialreviews/get_verification_configs_' . $this->platform,
            array($this, 'getVerificationConfigs'));
        add_action('wpsocialreviews/clear_verification_configs_' . $this->platform,
            array($this, 'clearVerificationConfigs'));

        //handle editor meta
        add_action('wpsocialreviews/get_editor_settings_' . $this->platform, array($this, 'getEditorSettings'));
        add_action('wpsocialreviews/edit_editor_settings_' . $this->platform, array($this, 'editEditorSettings'), 10,
            2);
        add_action('wpsocialreviews/update_editor_settings_' . $this->platform, array($this, 'updateEditorSettings'),
            10, 2);

        //handle advance settings
        add_action('wpsocialreviews/save_advance_settings_' . $this->platform, array($this, 'saveAdvanceSettings'), 10,
            2);
        add_action('wpsocialreviews/get_advance_settings_' . $this->platform, array($this, 'getAdvanceSettings'));
        add_action('wpsocialreviews/clear_cache_' . $this->platform, array($this, 'clearCache'));

        //handle cron job
        add_action('wpsr_' . $this->platform . '_feed_update', array($this, 'doCronEvent'));
    }

    /**
     * Get Advance Settings
     *
     * @return json
     * @since 1.2.5
     */
    public function getAdvanceSettings()
    {
        $settings = get_option('wpsr_' . $this->platform . '_global_settings');
        wp_send_json_success([
            'message'  => __('success', 'wp-social-reviews'),
            'settings' => $settings
        ], 200);
    }

    public function saveAdvanceSettings($settings = array())
    {
        update_option('wpsr_' . $this->platform . '_global_settings', $settings, 'no');

        wp_send_json_success([
            'message' => __('Settings Saved Successfully', 'wp-social-reviews'),
        ], 200);
    }

	public function doCronEvent()
	{
		$expiredCaches = $this->cacheHandler->getExpiredCaches();

		if ($expiredCaches) {
			$caches = [];

			foreach ($expiredCaches as $name => $cache) {
				$caches[] = [
					'option_name' => $name,
					'option_value' => $cache
				];
			}

			$this->updateCachedFeeds($caches);
		}
	}
}
