<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Youtube;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{

    public static function getVideoId($feed = [])
    {
        $videoId = Arr::get($feed, 'snippet.resourceId.videoId', null);
        if (empty($videoId)) {
            $videoId = isset($feed['id']['videoId']) ? $feed['id']['videoId'] : '';
        }
        if (empty($videoId)) {
            $videoId = isset($feed['id']) ? $feed['id'] : '';
        }

        return $videoId;
    }

    public static function getFeedById($feedId, $feeds)
    {
        foreach($feeds as $feed) {
            if(!strcmp(static::getVideoId($feed), $feedId)) {
                return $feed;
            }
        }
    }

    public static function formatContent($content)
    {
        $linkified = '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@';
        $hashified = '/(^|[\n\s])#([^\s"\t\n\r<:]*)/is';

        $prettyYt = preg_replace(
            array(
                $linkified,
                $hashified
            ),
            array(
                '<a href="$1" class="wpsr-yt-link" target="_blank" rel="nofollow">$1</a>',
                '$1<a class="wpsr-yt-hashtag" href="https://www.youtube.com/results?search_query=%23$2" target="_blank" rel="nofollow">#$2</a>'
            ),
            $content
        );

        return $prettyYt;
    }

}