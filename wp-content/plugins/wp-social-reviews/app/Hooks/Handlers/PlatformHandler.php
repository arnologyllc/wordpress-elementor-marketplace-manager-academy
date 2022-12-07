<?php

namespace WPSocialReviews\App\Hooks\Handlers;

use WPSocialReviews\App\Services\Platforms\Feeds\Facebook\FacebookFeed;
use WPSocialReviews\App\Services\Platforms\Reviews\GoogleMyBusiness;
use WPSocialReviews\App\Services\Platforms\Reviews\Airbnb;

use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\TwitterFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\Youtube\YoutubeFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\Instagram\InstagramFeed;
use WPSocialReviews\App\Services\Platforms\Chats\SocialChat;

class PlatformHandler
{
    public function register()
    {
        (new GoogleMyBusiness())->registerHooks();
        (new Airbnb())->registerHooks();
        (new TwitterFeed())->registerHooks();
        (new YoutubeFeed())->registerHooks();
        (new InstagramFeed())->registerHooks();
        (new FacebookFeed())->registerHooks();
        (new SocialChat())->registerHooks();
    }
}