<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Common;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class FeedFilters
{

    private $platform;

    /**
     * getTimestamp feed time handler
     *
     * @param array $feed
     *
     * @return date
     * @since 1.3.0
     */
    public function getTimestamp(array $feed)
    {
        $date = null;
        if ($this->platform === 'youtube') {
            $date = Arr::get($feed, 'snippet.publishedAt', null);
        } elseif ($this->platform === 'twitter') {
            $date = Arr::get($feed, 'created_at', null);
        } elseif ($this->platform === 'instagram') {
            $date = Arr::get($feed, 'timestamp', null);
        } elseif ($this->platform === 'facebook_feed') {
            $date = Arr::get($feed, 'created_time', null);
        }

        if (!empty($date)) {
            $date = strtotime($date);
        }

        return $date;
    }

    /**
     * filterFeedResponse filter the feed response
     *
     * @param array $filterSettings filter settings
     * @param array $response response
     *
     * @return array
     * @since 1.3.0
     *
     */
    public function filterFeedResponse($platform, $filterSettings, $response)
    {
        if ($filterSettings && $response && !empty($response) && !empty($filterSettings)) {
            $this->platform = $platform;
            $filterResponse = $feeds = $header = array();

            $header = isset($response['header']) ? $response['header'] : array();
            $feeds  = isset($response['items']) ? $response['items'] : array();

            //filter by date
            if (($filterSettings['post_order'] === 'ascending' || $filterSettings['post_order'] === 'descending')) {
                $multiply = ($filterSettings['post_order'] === 'ascending') ? -1 : 1;
                usort($feeds, function ($m1, $m2) use ($multiply) {
                    $timestamp1 = $this->getTimestamp($m1);
                    $timestamp2 = $this->getTimestamp($m2);

                    // If both have dates
                    if ($timestamp1 !== null && $timestamp2 !== null) {
                        if($timestamp1 == $timestamp2) {
                            return 0;
                        }

                        if($timestamp1 < $timestamp2) {
                            return -1 * $multiply;
                        }

                        return 1 * $multiply;
                    }

                    // If m2 has no date, consider it as more recent
                    if ($timestamp1 !== null) {
                        return $multiply;
                    }

                    // If m1 has no date, consider it as more recent
                    if ($timestamp2 !== null) {
                        return -$multiply;
                    }

                    // Neither have dates
                    return 0;
                });
            }

            if ($this->platform === 'instagram') {
                //filter by popularity
                if (($filterSettings['post_order'] === 'most_popular' || $filterSettings['post_order'] === 'least_popular')) {
                    $feeds = apply_filters('wpsocialreviews/instagram_feeds_by_popularity', $feeds,
                        $filterSettings['post_order']);
                }

                $feeds = array_map(function ($value) {
                    if(isset($value['media_url'])) {
                        return $value;
                    }
                }, $feeds);

                $feeds = array_filter($feeds);
            }

            if ($this->platform === 'youtube') {
                //filter by popularity
                if (($filterSettings['post_order'] === 'most_popular' || $filterSettings['post_order'] === 'least_popular')) {
                    $feeds = apply_filters('wpsocialreviews/youtube_feeds_by_popularity', $feeds,
                        $filterSettings['post_order']);
                }
            }

            if ($this->platform === 'twitter') {
                //filter by popularity
                if (($filterSettings['post_order'] === 'most_popular' || $filterSettings['post_order'] === 'least_popular')) {
                    $feeds = apply_filters('wpsocialreviews/twitter_feeds_by_popularity', $feeds,
                        $filterSettings['post_order']);
                }
            }

            if ($this->platform === 'facebook_feed') {
                //filter by popularity
                if (($filterSettings['post_order'] === 'most_popular' || $filterSettings['post_order'] === 'least_popular')) {
                    $feeds = apply_filters('wpsocialreviews/facebook_feeds_by_popularity', $feeds,
                        $filterSettings['post_order']);
                }
                // hide shared posts
                if(Arr::get($filterSettings, 'hide_shared_posts') === true){
                    $feeds = array_map(function ($value) {
                        $type = Arr::get($value, 'attachments.data.0.type');
                        if($type !== 'native_templates'){
                            return $value;
                        }
                    }, $feeds);
                    $feeds = array_filter($feeds);
                }
            }

            //filter by randomly
            if ($filterSettings['post_order'] === 'random') {
                $feeds = apply_filters('wpsocialreviews/feeds_by_random', $feeds);
            }

            $totalPosts = Arr::get($filterSettings, 'total_posts_number');
            $numOfPosts = wp_is_mobile() ? Arr::get($totalPosts, 'mobile') : Arr::get($totalPosts, 'desktop');

            //we have to get include or exclude feeds from here
            $includesWords = array();
            $excludesWords = array();
            $hidePostIds   = array();
            $hasHidePost   = false;

            if (!empty($filterSettings['includes_inputs'])) {
                $includesWords = array_map('trim', explode(",", $filterSettings['includes_inputs']));
            }
            if (!empty($filterSettings['excludes_inputs'])) {
                $excludesWords = array_map('trim', explode(",", $filterSettings['excludes_inputs']));
            }
            if (!empty($filterSettings['hide_posts_by_id'])) {
                $hidePostIds = array_map('trim', explode(",", $filterSettings['hide_posts_by_id']));
            }

            $totalPostsIterator = 0;
            foreach ($feeds as $index => $feed) {
                $text_description = '';
                $feed_id          = '';
                $text_title       = '';

                if ($this->platform === 'instagram') {
                    $text_description = Arr::get($feed, 'caption', '');
                    $feed_id          = Arr::get($feed, 'permalink', '');
                }

                if ($this->platform === 'youtube') {
                    $text_description = Arr::get($feed, 'snippet.description', '');
                    $feed_id          = Arr::get($feed, 'id', '');
                    $text_title       = Arr::get($feed, 'snippet.title', '');
                }

                if ($this->platform === 'twitter') {
                    if (isset($feed['id_str'])) {
                        $feed_id = $feed['id_str'];
                    } elseif (isset($feed['quoted_status']['id_str'])) {
                        $feed_id = $feed['quoted_status']['id_str'];
                    } elseif (isset($feed['retweeted_status']['id_str'])) {
                        $feed_id = $feed['retweeted_status']['id_str'];
                    }
                    $text_description = isset($feed['retweeted_status']) ? $feed['retweeted_status']['full_text'] : $feed['full_text'];
                }

                if ($this->platform === 'facebook_feed') {
                    $feed_id = Arr::get($feed, 'id', '');
                    $text_description = Arr::get($feed, 'message', '');
                    if(empty($text_description) && Arr::get($feed, 'description', '')) {
                        $text_description = Arr::get($feed, 'description', '');
                    }
                }

                $post_caption = ' ' . str_replace(array('+', '%0A'), ' ',
                        urlencode(str_replace(array('#', '@'), array(' HASHTAG', ' MENTION'),
                            strtolower($text_description)))) . ' ';

                //start of 1st filter: Numbers Of Posts To Display
                if ($totalPostsIterator >= ($numOfPosts)) {
                    break;
                }
                //end of 1st filter: Numbers Of Posts To Display

                $hasIncludeWord = false;
                $hasExcludeWord = false;

                if (!empty($includesWords)) {
                    $hasIncludeWord = apply_filters('wpsocialreviews/include_or_exclude_feed', true, $includesWords,
                        $post_caption);

                    if(!empty($text_title)) {
                        $hasIncludeWord2 = apply_filters('wpsocialreviews/include_or_exclude_feed', true, $includesWords,
                            $text_title);
                        $hasIncludeWord = $hasIncludeWord || $hasIncludeWord2;
                    }
                }

                if (!empty($excludesWords)) {
                    $hasExcludeWord = apply_filters('wpsocialreviews/include_or_exclude_feed', false, $excludesWords,
                        $post_caption);
                    if(!empty($text_title)) {
                        $hasExcludeWord2 = apply_filters('wpsocialreviews/include_or_exclude_feed', false, $excludesWords,
                            $text_title);
                        $hasExcludeWord = $hasExcludeWord || $hasExcludeWord2;
                    }
                }

                if (!empty($hidePostIds)) {
                    $hasHidePost = apply_filters('wpsocialreviews/hide_feed', $hidePostIds, $feed_id);
                }

                if (!defined('WPSOCIALREVIEWS_PRO')) {
                    $hasHidePost = false;
                }

                $word_filter_passed = false;
                if (!empty($excludesWords) && !empty($includesWords)) {
                    $word_filter_passed = $hasIncludeWord && !$hasExcludeWord;
                } elseif (!empty($includesWords)) {
                    $word_filter_passed = $hasIncludeWord;
                } else {
                    $word_filter_passed = !$hasExcludeWord;
                }

                if ($word_filter_passed) {
                    if ($this->platform === 'instagram' && !$hasHidePost) {
                        // 3rd filter: start of filters for Types Of Posts
                        if ($filterSettings['post_type'] === 'all') {
                            $filterResponse[] = $feed;
                        } elseif (isset($feed['media_type']) && ($feed['media_type'] === "IMAGE" || $feed['media_type'] === 'CAROUSEL_ALBUM') && $filterSettings['post_type'] === 'images') {
                            $filterResponse[] = $feed;
                        } elseif (isset($feed['media_type']) && $feed['media_type'] === "VIDEO" && $filterSettings['post_type'] === 'videos') {
                            $filterResponse[] = $feed;
                        }
                        //3rd filter: end of filters for Types Of Posts
                        $totalPostsIterator++;
                    }

                    if (($this->platform === 'youtube' || $this->platform === 'twitter' || $this->platform === 'facebook_feed') && !$hasHidePost) {
                        $filterResponse[] = $feed;
                        $totalPostsIterator++;
                    }
                }
            }

            return array(
                'header' => $header,
                'items'  => $filterResponse
            );
        }

        return $response;
    }
}