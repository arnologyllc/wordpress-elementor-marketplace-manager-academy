<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    public static function getUserAccounts($settings)
    {
        //for header
        $connected_accounts = isset($settings['source_settings']['account_ids']) ? $settings['source_settings']['account_ids'] : array();
        $header_account1    = (count($connected_accounts) && isset($connected_accounts[0])) ? $connected_accounts[0] : '';
        $header_account2    = isset($settings['header_settings']['account_to_show']) ? $settings['header_settings']['account_to_show'] : $header_account1;

        $connected_account = $header_account2;

        if (empty($connected_account)) {
            $connected_account = $header_account1;
        }

        $allAccounts = (new Common())->findConnectedAccounts();

        $headerAccountId = isset($allAccounts[$connected_account]) ? $connected_account : '';

        $actualConnectedIds = array_keys($allAccounts);
        $actualConnectedIds = array_map('strval', $actualConnectedIds);

        if (empty($headerAccountId) && count($actualConnectedIds)) {
            $headerAccountId = $actualConnectedIds[0];
        }

        if (empty($connected_accounts) && count($actualConnectedIds)) {
            $connected_accounts[] = $actualConnectedIds[0];
        }

        return array(
            'account_ids'          => $connected_accounts,
            'connected_account_id' => $headerAccountId,
        );
    }

    public static function getUserAccountInfo($settings = [])
    {
        $configs            = get_option('wpsr_instagram_verification_configs', []);
        $account_to_show    = Arr::get($settings, 'header_settings.account_to_show', null);
        $connected_accounts = Arr::get($configs, 'connected_accounts', []);

        return Arr::get($connected_accounts, $account_to_show, []);
    }
}