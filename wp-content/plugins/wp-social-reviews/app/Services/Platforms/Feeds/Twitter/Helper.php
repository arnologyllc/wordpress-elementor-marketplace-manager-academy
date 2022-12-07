<?php

namespace WPSocialReviews\App\Services\Platforms\Feeds\Twitter;

use WPSocialReviews\App\Models\Review;
use WPSocialReviews\App\Services\Platforms\Feeds\Twitter\Helper as TwitterHelper;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{

    /**
     * Format the tweet text (links, hashtags, mentions)
     *
     * @return array
     * @since 1.1.0
     */
    public static function formatTweet($tweet)
    {
        $linkified    = '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@';
        $hashified    = '/(^|[\n\s])#([^\s"\t\n\r<:]*)/is';
        $mentionified = '/(^|[\n\s])@([^\s"\t\n\r<:]*)/is';

        $prettyTweet = preg_replace(
            array(
                $linkified,
                $hashified,
                $mentionified
            ),
            array(
                '<a href="$1" class="wpsr-link-tweet" target="_blank" rel="nofollow">$1</a>',
                '$1<a class="wpsr-link-hashtag" href="https://twitter.com/hashtag/$2" target="_blank" rel="nofollow">#$2</a>',
                '$1<a class="wpsr-link-mention" href="http://twitter.com/$2" target="_blank" rel="nofollow">@$2</a>'
            ),
            $tweet
        );

        return $prettyTweet;
    }

    public static function replaceTweetUrls($feed)
    {
        // actual tweet as a string
        $text = '';
        if (isset($feed['full_text'])) {

            $text = isset($feed['retweeted_status']) ? $feed['retweeted_status']['full_text'] : $feed['full_text'];

        }
        $tweetText = $text;
        // create an array to hold urls
        $tweetEntities = array();
        $urls          = isset($feed['retweeted_status']['entities']['urls']) ? $feed['retweeted_status']['entities']['urls'] : $feed['entities']['urls'];
        $user_mentions = isset($feed['retweeted_status']['entities']['user_mentions']) ? $feed['retweeted_status']['entities']['user_mentions'] : $feed['entities']['user_mentions'];
        $hashtags      = isset($feed['retweeted_status']['entities']['hashtags']) ? $feed['retweeted_status']['entities']['hashtags'] : $feed['entities']['hashtags'];

        // add each user mention to the array
        foreach ($user_mentions as $mention) {
            $string          = mb_substr($tweetText, $mention['indices'][0],
                ($mention['indices'][1] - $mention['indices'][0]), "UTF-8");
            $tweetEntities[] = array(
                'type'    => 'mention',
                'curText' => mb_substr($tweetText, $mention['indices'][0],
                    ($mention['indices'][1] - $mention['indices'][0]), "UTF-8"),
                'newText' => "<a class='wpsr-link-mention' href='http://twitter.com/" . $mention['screen_name'] . "' target='_blank'>$string</a>"
            );
        }  // end foreach

        // add each hashtag to the array
        foreach ($hashtags as $tag) {
            $string = mb_substr($tweetText, $tag['indices'][0], ($tag['indices'][1] - $tag['indices'][0]), "UTF-8");

            $tweetEntities[] = array(
                'type'    => 'hashtag',
                'curText' => mb_substr($tweetText, $tag['indices'][0], ($tag['indices'][1] - $tag['indices'][0]),
                    "UTF-8"),
                'newText' => "<a class='wpsr-link-hashtag' href='http://twitter.com/search?q=%23" . $tag['text'] . "&src=hash' target='_blank'>" . $string . "</a>"
            );
        }  // end foreach

        // add each url to the array
        foreach ($urls as $url) {
            // hide twitter.com url from string
            $hide_link = strpos($url['display_url'], "twitter.com") !== false ? 'wpsr-hide-link' : '';

            $tweetEntities[] = array(
                'type'    => 'url',
                'curText' => mb_substr($tweetText, $url['indices'][0], ($url['indices'][1] - $url['indices'][0]),
                    "UTF-8"),
                'newText' => '<a class="wpsr-link-tweet ' . esc_attr($hide_link) . '" href="' . $url['expanded_url'] . '" target="_blank">' . $url['display_url'] . '</a>'
            );
        }  // end foreach

        // replace the old text with the new text for each entity
        foreach ($tweetEntities as $entity) {
            $tweetText = str_replace($entity['curText'], $entity['newText'], $tweetText);
        } // end foreach

        // remove t.com urls from string
        if (isset($feed['retweeted_status']['entities']['media'][0]['url'])) {
            $default_url = $feed['retweeted_status']['entities']['media'][0]['url'];
        } elseif (isset($feed['quoted_status']['entities']['media'][0]['url'])) {
            $default_url = $feed['quoted_status']['entities']['media'][0]['url'];
        } else {
            $default_url = isset($feed['entities']['media'][0]['url']) ? $feed['entities']['media'][0]['url'] : '';
        }
        $tweetText = str_replace($default_url, '', $tweetText);

        return nl2br($tweetText);
    }

    public static function getVideoVariants($feed = [])
    {
        $variants = [];
        if (isset($feed['extended_entities']['media'][0]['video_info']['variants'])) {
            $variants = $feed['extended_entities']['media'][0]['video_info']['variants'];
        } elseif (isset($feed['retweeted_status']['extended_entities']['media'][0]['video_info']['variants'])) {
            $variants = $feed['retweeted_status']['extended_entities']['media'][0]['video_info']['variants'];
        } elseif (isset($feed['quoted_status']['extended_entities']['media'][0]['video_info']['variants'])) {
            $variants = $feed['quoted_status']['extended_entities']['media'][0]['video_info']['variants'];
        }

        return $variants;
    }

    public static function getHighQualityVideo($feed = [])
    {
        $variants      = static::getVideoVariants($feed);
        $max           = null;
        $max_value_url = null;
        foreach ($variants as $key => $value) {
            if ((isset($value['bitrate']) && $value['content_type'] === 'video/mp4') && ($value['bitrate'] > $max || !$max)) {
                $max           = $value['bitrate'];
                $max_value_url = $value['url'];
            }
        }

        return $max_value_url;
    }

    public static function getFeedImageUrl($feed = [], $key = 'entities', $media_type = '')
    {
        if (!empty($feed[$key]['media'][0]['media_url_https']) && $media_type !== 'video') {
            $media_url = $feed[$key]['media'][0]['media_url_https'];
        } elseif (!empty($feed['retweeted_status'][$key]['media'][0]['media_url_https'])) {
            $media_url = $feed['retweeted_status'][$key]['media'][0]['media_url_https'];
        } elseif (!empty($feed['quoted_status'][$key]['media'][0]['media_url_https'])) {
            $media_url = $feed['quoted_status'][$key]['media'][0]['media_url_https'];
        } else {
            $media_url = '';
        }

        return $media_url;
    }

    public static function getMediaType($feed = [])
    {
        $media_type = '';
        if (isset($feed['extended_entities']['media'][0]['type'])) {
            $media_type = $feed['extended_entities']['media'][0]['type'];
        } elseif (isset($feed['retweeted_status']['extended_entities']['media'][0]['type'])) {
            $media_type = $feed['retweeted_status']['extended_entities']['media'][0]['type'];
        } elseif (isset($feed['quoted_status']['extended_entities']['media'][0]['type'])) {
            $media_type = $feed['quoted_status']['extended_entities']['media'][0]['type'];
        } elseif (isset($feed['retweeted_status']['quoted_status']['extended_entities']['media'][0]['type'])) {
            $media_type = $feed['retweeted_status']['quoted_status']['extended_entities']['media'][0]['type'];
        }

        return $media_type;
    }

    public static function getExternalMediaUrl($feed = [])
    {
        if (isset($feed['quoted_status']['entities']['media'][0]['type'])) {
            $external_media_url = isset($feed['quoted_status']['entities']['media'][0]['expanded_url']) && $feed['quoted_status']['entities']['media'][0]['expanded_url'] === 'video' ? $feed['quoted_status']['entities']['media'][0]['expanded_url'] : '';
        } elseif (isset($feed['retweeted_status']['entities']['urls'][0]['expanded_url'])) {
            $external_media_url = isset($feed['retweeted_status']['entities']['urls'][0]['expanded_url']) ? $feed['retweeted_status']['entities']['urls'][0]['expanded_url'] : '';
        } else {
            $external_media_url = isset($feed['entities']['urls'][0]['expanded_url']) ? $feed['entities']['urls'][0]['expanded_url'] : '';
        }

        return $external_media_url;
    }

    public static function hasExternalMedia($feed = [])
    {
        $external_media_url = static::getExternalMediaUrl($feed);
        if (strpos($external_media_url, 'youtu.be')) {
            return true;
        } elseif (strpos($external_media_url, 'youtube.com/watch')) {
            return true;
        } elseif (strpos($external_media_url, 'youtube.com/embed')) {
            return true;
        } elseif (strpos($external_media_url, 'vimeo')) {
            return true;
        } elseif (strpos($external_media_url, 'soundcloud.com')) {
            return true;
        } elseif (strpos($external_media_url, 'open.spotify.com')) {
            return true;
        }
    }

    public static function generateCardAttrs($feed = [], $media_type = '')
    {
        $twitter_card_attrs = [];
        if ((isset($feed['entities']['urls'][0]['expanded_url']) || isset($feed['retweeted_status']['entities']['urls'][0]['expanded_url'])) && ($media_type !== 'video')) {
            $twitter_card_url = '';
            if (isset($feed['retweeted_status']['entities']['urls'][0]['expanded_url'])) {
                $twitter_card_url = $feed['retweeted_status']['entities']['urls'][0]['expanded_url'];
            } elseif (isset($feed['entities']['urls'][0]['expanded_url'])) {
                $twitter_card_url = $feed['entities']['urls'][0]['expanded_url'];
            }

            $ssl_only = str_replace('http:', 'https:', $twitter_card_url);
            if (strpos($ssl_only, "https://bit.ly") === false) {
                $url                            = str_replace('&', '038', $twitter_card_url);
                $twitter_card_attrs['card_url'] = 'data-cardurl="' . esc_url_raw($url) . '" data-id="' . $feed['id'] . '"';
                $twitter_card_attrs['classes']  = 'wpsr-has-card-url';
                //  $twitter_card_attrs['classes']  = $template_meta['advance_settings']['show_card_for_third_party_url'] === 'true' ? 'wpsr-active-video-card' : '';
            }
        }

        return $twitter_card_attrs;
    }

    public static function getIframeVideoUrl($feed)
    {
        $external_media_url = static::getExternalMediaUrl($feed);

        $iframe_video_url = '';
        if (strpos($external_media_url, 'youtu.be') || strpos($external_media_url,
                'youtube.com/watch') || strpos($external_media_url, 'youtube.com/embed')) {
            $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
            preg_match($pattern, $external_media_url, $matches);
            $video_id         = $matches[1];
            $iframe_video_url = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=0';
        }

        if (strpos($external_media_url, 'vimeo')) {
            if (strpos($external_media_url, 'staffpicks') > 0) {
                $parsed_url = $external_media_url;
                $parsed_url = parse_url($parsed_url);
                $video_id   = preg_replace('/\D/', '', $parsed_url['path']);
            } else {
                $video_id = (int)substr(parse_url($external_media_url, PHP_URL_PATH), 1);
            }
            $iframe_video_url = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=0';
        }

        return $iframe_video_url;
    }

    public static function getSvgIcons($key = '')
    {
        $icons = array(
            'twitter_logo'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                <rect style="fill:none;" width="40" height="40"/>
                <path d="M153.62,301.59c94.34,0,145.94-78.16,145.94-145.94,0-2.22,0-4.43-.15-6.63A104.36,104.36,0,0,0,325,122.47a102.38,102.38,0,0,1-29.46,8.07,51.47,51.47,0,0,0,22.55-28.37,102.79,102.79,0,0,1-32.57,12.45,51.34,51.34,0,0,0-87.41,46.78A145.62,145.62,0,0,1,92.4,107.81a51.33,51.33,0,0,0,15.88,68.47A50.91,50.91,0,0,1,85,169.86c0,.21,0,.43,0,.65a51.31,51.31,0,0,0,41.15,50.28,51.21,51.21,0,0,1-23.16.88,51.35,51.35,0,0,0,47.92,35.62,102.92,102.92,0,0,1-63.7,22A104.41,104.41,0,0,1,75,278.55a145.21,145.21,0,0,0,78.62,23"/>
            </svg>',
            'video_player'     => '<svg viewBox="0 0 24 24">
                <g>
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16.036 11.58l-6-3.82a.5.5 0 0 0-.77.42v7.64a.498.498 0 0 0 .77.419l6-3.817c.145-.092.23-.25.23-.422s-.085-.33-.23-.42z"></path>
                    <path d="M12 22.75C6.072 22.75 1.25 17.928 1.25 12S6.072 1.25 12 1.25 22.75 6.072 22.75 12 17.928 22.75 12 22.75zm0-20C6.9 2.75 2.75 6.9 2.75 12S6.9 21.25 12 21.25s9.25-4.15 9.25-9.25S17.1 2.75 12 2.75z"></path>
                </g>
            </svg>',
            'verified'         => '<svg viewBox="0 0 24 24" aria-label="Verified account">
                <g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z">
                </path></g>
            </svg>',
            'action_favourite' => '<svg viewBox="0 0 24 24">
                   <g>
                      <path
                         d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path>
                   </g>
            </svg>',
            'action_reply'     => '<svg viewBox="0 0 24 24">
                <g>
                    <path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
                </g>
            </svg>',
            'action_retweet'   => '<svg viewBox="0 0 24 24">
                    <g>
                        <path
                            d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path>
                    </g>
            </svg>',
            'retweeted'        => '<svg viewBox="0 0 24 24" class="r-1re7ezh r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xzupcd">
                <g>
                    <path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path>
                </g>
            </svg>'
        );

        return $icons[$key];
    }
}