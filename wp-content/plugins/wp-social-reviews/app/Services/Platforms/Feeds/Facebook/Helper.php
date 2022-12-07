<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Facebook;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    public static function getConncetedSourceList()
    {
        $configs = get_option('wpsr_facebook_feed_connected_sources_config', []);
        $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];
        return $sourceList;
    }

    public static function getTotalFeedReactions($feed = [])
    {
        $sum = 0;
        $sum += Arr::get($feed, 'like.summary.total_count', null);
        $sum += Arr::get($feed, 'love.summary.total_count', null);
        $sum += Arr::get($feed, 'wow.summary.total_count', null);
        $sum += Arr::get($feed, 'haha.summary.total_count', null);
        $sum += Arr::get($feed, 'sad.summary.total_count', null);
        $sum += Arr::get($feed, 'angry.summary.total_count', null);
        return $sum;
    }

    public static function secondsToMinutes($time)
    {
       $hours = floor($time / 3600);
       $minutes = floor(($time % 3600) / 60);
       $seconds = floor($time % 60);

       $value = "";
       if ($hours > 0) {
          $value .= "" . $hours . ":" . ($hours < 10 ? "0" : "");
       }
       $value .= "" . $minutes . ":" . ($seconds < 10 ? "0" : "");
       $value .= "" . $seconds;

       // return like "M:S" or "HH:MM:SS" or "HH"MM:SS"
       return $value;
    }

    public static function getSiteUrl($attachment = [], $domain = false)
    {
        $url = Arr::get($attachment, 'target.url');
        if($url){
            $query_str = parse_url($url, PHP_URL_QUERY);
            parse_str($query_str, $query_params);
            $site_url = Arr::get($query_params, 'u');
            if($site_url){
                $host = parse_url($site_url);
                return $domain ? $host['host'] : $site_url;
            }
        } else {
            return false;
        }
    }
}