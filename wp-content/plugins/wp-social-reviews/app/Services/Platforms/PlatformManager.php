<?php
namespace WPSocialReviews\App\Services\Platforms;

class PlatformManager
{


    /**
     * Set all feed platform name.
     *
     * @return array
     */
    public function feedPlatforms()
    {
        return [
            'twitter',
            'youtube',
            'instagram',
            'facebook_feed'
        ];
    }

    /**
     *  Set all review platform name.
     *
     * @return array
     */
    public function reviewsPlatforms()
    {
        return [
            'google',
            'airbnb',
            'yelp',
            'tripadvisor',
            'amazon',
            'aliexpress',
            'booking.com',
            'facebook',
        ];
    }

}



