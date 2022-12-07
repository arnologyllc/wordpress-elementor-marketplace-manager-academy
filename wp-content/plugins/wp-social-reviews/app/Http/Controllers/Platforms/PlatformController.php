<?php

namespace WPSocialReviews\App\Http\Controllers\Platforms;

use WPSocialReviews\App\Http\Controllers\Controller;
use WPSocialReviews\Framework\Request\Request;
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;
use WPSocialReviews\App\Services\DashboardNotices;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Helper::validPlatforms();

        return [
            'message'   => 'success',
            'platforms' => $platforms
        ];
    }

    public function updateDashboardNotices(Request $request, DashboardNotices $notices)
    {
        $args = $request->get('args');
        $notices->updateNotices($args);

        wp_send_json_success([
            'displayNotice' => $notices->getNoticesStatus()
        ], 200);
    }

    public function enabledPlatforms(Request $request, DashboardNotices $notices)
    {
        $reviewsPlatforms   = apply_filters('wpsocialreviews/available_valid_reviews_platforms', []);
        $feedPlatforms      = apply_filters('wpsocialreviews/available_valid_feed_platforms', []);
        $platforms = $reviewsPlatforms + $feedPlatforms;

        return [
            'displayNotice' => $notices->getNoticesStatus(),
            'platforms'   => $platforms
        ];
    }
}
