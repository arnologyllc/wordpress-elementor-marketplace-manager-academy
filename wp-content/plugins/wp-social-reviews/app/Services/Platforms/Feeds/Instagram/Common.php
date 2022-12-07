<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Common
{
    /**
     * Connect to the Instagram API
     *
     * @param string $url
     *
     * @return array
     * @since 1.3.0
     */
    public function makeRequest($url)
    {
        $args     = array(
            'timeout'   => 60,
            'sslverify' => false
        );
        $response = wp_remote_get($url, $args);

        if (!is_wp_error($response)) {
            $response = json_decode(wp_remote_retrieve_body($response), true);
        }

        return $response;
    }

    /**
     * Add Comments For Ig Feeds
     *
     * @param array $accountDetails
     * @param array $response
     *
     * @return array
     * @since 1.3.0
     */
    public function expandWithComments($accountDetails, $response)
    {
        $response = Arr::get($response, 'data');

        return apply_filters('wpsocialreviews/fetch_instagram_comments', $response, $accountDetails);
    }

    /**
     * Ig Feeds
     *
     * @param string $apiUrl
     *
     * @return array
     * @since 1.3.0
     */
    public function expandWithoutComments($apiUrl)
    {
        return $this->makeRequest($apiUrl);
    }

    /**
     * Formatted Verified Accounts
     *
     * @return array
     * @since 1.3.0
     */
    public function findConnectedAccounts()
    {
        $connected_ids = get_option('wpsr_instagram_verification_configs', array());
        $connected_ids = isset($connected_ids['connected_accounts']) ? $connected_ids['connected_accounts'] : array();

        return $connected_ids;
    }

    /**
     * Weather Response Has Error or Not
     *
     * @param array $response
     *
     * @return boolean
     * @since 1.3.0
     */
    public function instagramError($response)
    {
        return (isset($response->errors) || isset($response['meta']['error_type']) || isset($response['error']['message']) || isset($response['error']) || isset($response['errors']));
    }
}