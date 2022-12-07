<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Youtube;

if (!defined('ABSPATH')) {
    exit;
}

class OAuth
{
    private $api = 'https://accounts.google.com/o/oauth2/token';
    private $redirect = 'urn:ietf:wg:oauth:2.0:oob';
    private $clientId = '324795500171-71lpnb3qr9qlk2jbijkpfivi3q9tgtlk.apps.googleusercontent.com';
    private $clientSecret = 'vzJCAiQq5hrRH2y-KzzZ3YQb';
    private $optionKey = 'wpsr_youtube_verification_configs';

    public function __construct()
    {

    }

    public function makeRequest($url = '', $bodyArgs = [], $type = 'GET', $headers = false)
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
        $request        = wp_remote_request($url, $args);
        if (is_wp_error($request)) {
            $message = $request->get_error_message();

            return new \WP_Error(423, $message);
        }
        $body = json_decode(wp_remote_retrieve_body($request), true);
        if (!empty($body['error'])) {
            $error = 'Unknown Error';
            if (isset($body['error_description'])) {
                $error = $body['error_description'];
            } else {
                if (!empty($body['error']['message'])) {
                    $error = $body['error']['message'];
                }
            }

            return new \WP_Error(423, $error);
        }

        return $body;
    }

    public function generateAccessKey($token)
    {
        $body = [
            'code'          => $token,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->redirect,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret
        ];

        return $this->makeRequest($this->api, $body, 'POST');
    }

    public function getAccessToken()
    {
        $tokens = get_option($this->optionKey);
        if (!$tokens) {
            return false;
        }
        if (($tokens['created_at'] + $tokens['expires_in'] - 30) < time()) {
            // It's expired so we have to re-issue again
            $refreshTokens = $this->refreshToken($tokens);
            if (!is_wp_error($refreshTokens)) {
                $tokens['access_token']     = $refreshTokens['access_token'];
                $tokens['expires_in']       = $refreshTokens['expires_in'];
                $tokens['created_at']       = time();
                $tokens['credentials_type'] = 'oauth2.0';
                $tokens['refresh_token']    = $tokens['refresh_token'];
                //not necessary but for the flow of verification configs
                $tokens['api_key']     = '';
                $tokens['access_code'] = '';
                update_option($this->optionKey, $tokens, 'no');
            } else {
                return false;
            }
        }

        return $tokens['access_token'];
    }

    private function refreshToken($tokens)
    {
        $args = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $tokens['refresh_token'],
            'grant_type'    => 'refresh_token'
        ];

        return $this->makeRequest($this->api, $args, 'POST');
    }
}
