<?php

namespace WPSocialReviews\App\Http\Policies;

use WPSocialReviews\Framework\Foundation\Policy;
use WPSocialReviews\Framework\Request\Request;

class PlatformPolicy extends Policy
{
    /**
     * Check user permission for any method
     * @param  \WPSocialReviews\Framework\Request\Request $request
     * @return Boolean
     */
    public function verifyRequest(Request $request)
    {
        if(current_user_can('manage_options')){
            return true;
        } else {
            return false;
        }
    }

}
