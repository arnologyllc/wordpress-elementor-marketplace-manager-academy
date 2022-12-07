<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Instagram;

use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;

if (!defined('ABSPATH')) {
    exit;
}

class RefreshToken
{
    public $api = 'https://graph.instagram.com/refresh_access_token';
    public $grant_type = 'ig_refresh_token';
    public $optionKey = 'wpsr_instagram_verification_configs';

    public function __construct()
    {

    }

    public function makeRequest($url, $bodyArgs, $type = 'GET', $headers = false)
    {
        if (!$headers) {
            $headers = array(
                'Content-Type'              => 'application/http',
                'Content-Transfer-Encoding' => 'binary',
                'MIME-Version'              => '1.0',
            );
        }
        $args = [
            'headers' => $headers
        ];
        if ($bodyArgs) {
            $args['body'] = json_encode($bodyArgs);
        }
        $args['method'] = $type;

        $url     = $url . '?grant_type=ig_refresh_token&access_token=' . $bodyArgs['access_token'];
        $request = wp_remote_request($url);

        if (is_wp_error($request)) {
            $message = $request->get_error_message();

            return new \WP_Error(423, $message);
        }
        $body = json_decode(wp_remote_retrieve_body($request), true);

        return $body;
    }

    public function generateAccessKey($token)
    {
        $body = [
            'grant_type'   => $this->grant_type,
            'access_token' => $token,
        ];

        return $this->makeRequest($this->api, $body);
    }

    public function getAccessToken($connected_account)
    {
        $options            = get_option('wpsr_instagram_verification_configs', array());
        $connected_accounts = isset($options['connected_accounts']) ? $options['connected_accounts'] : array();

        $connectedId = isset($connected_account['user_id']) ? $connected_account['user_id'] : '';

        if ($this->should_attempt_refresh($connected_account)) {
            // It's expired so we have to re-issue again
            $refreshTokens = $this->refreshToken($connected_account);

            // return errors
            if ((new Common())->instagramError($refreshTokens)) {
                return $refreshTokens;
            }

            if (!is_wp_error($refreshTokens)) {
                $accessToken = isset($refreshTokens['access_token']) ? $refreshTokens['access_token'] : '';
                if (!empty($accessToken)) {
                    $connected_accounts[$connectedId] = array(
                        'access_token' => $accessToken,
                        'expires_in'   => isset($refreshTokens['expires_in']) ? $refreshTokens['expires_in'] : '',
                        'created_at'   => time(),
                        'user_id'      => $connectedId,
                        'username'     => isset($connected_account['username']) ? $connected_account['username'] : '',
                        'api_type'     => isset($connected_account['api_type']) ? $connected_account['api_type'] : '',
                        'user_avatar'  => isset($connected_account['user_avatar']) ? $connected_account['user_avatar'] : '',
                        'name'         => isset($connected_account['name']) ? $connected_account['name'] : ''
                    );
                    update_option($this->optionKey, array('connected_accounts' => $connected_accounts, 'no'));

                    foreach ($connected_accounts as $connected_account) {
						if ($connected_account['api_type'] == 'personal') {
							(new CacheHandler('instagram'))->createOrUpdateCache(
								'wpsr_instagram_verification_configs_' . $connected_account['user_id'],
								$connected_account['user_id'],
								7 * 24 * 60 * 60
							);
						}
                    }
                }

                return $accessToken;

            } else {
                return false;
            }
        }

        return $connected_account['access_token'];
    }

    public function should_attempt_refresh($connected_account)
    {
        if (isset($connected_account['expires_in']) && !empty($connected_account['expires_in'])) {
            $expiration_timestamp = isset($connected_account['expires_in']) ? $connected_account['expires_in'] : time();
            $current_time         = time();
            $refresh_time         = $connected_account['created_at'] + $expiration_timestamp - (50 * 86400);

            if ($refresh_time < $current_time) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function refreshToken($token)
    {
        $args = [
            'access_token' => $token['access_token'],
            'grant_type'   => $this->grant_type
        ];

        return $this->makeRequest($this->api, $args);
    }
}
