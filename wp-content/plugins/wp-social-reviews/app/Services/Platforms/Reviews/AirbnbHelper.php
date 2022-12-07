<?php

namespace WPSocialReviews\App\Services\Platforms\Reviews;

use WPSocialReviews\App\Services\Libs\SimpleDom\Helper;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle Airbnb Business
 * @since 1.0.0
 */
class AirbnbHelper
{
    public function getExperienceBusinessDetails($businessName)
    {
        $searchUrl = 'https://www.airbnb.com/s/'.$businessName.'/experiences';

        $fileUrlContents = wp_remote_get($searchUrl);

        if(is_wp_error($fileUrlContents)) {
            throw new \Exception($fileUrlContents->get_error_message());
        }

        $fileUrlContents = wp_remote_retrieve_body(wp_remote_get($searchUrl));

        if (empty($fileUrlContents)) {
            throw new \Exception(
                __('Can\'t fetch reviews due to slow network, please try again', 'wp-social-reviews')
            );
        }

        $html = Helper::str_get_html($fileUrlContents);

        $container = null;
        if($html->find('div._kbiv5c', 0)) {
            if ($html->find('div._kbiv5c', 0)->find('div._2mo5u1', 0)) {
                if ($html->find('div._kbiv5c', 0)->find('div._2mo5u1', 0)->find('div._1xizdrk')) {
                    $container = $html->find('div._kbiv5c', 0)->find('div._2mo5u1', 0)->find('div._1xizdrk', 0);
                }
            }
        }

        if(empty($container)) {
            throw new \Exception(
                __('Can\'t fetch reviews due to slow network, please try again', 'wp-social-reviews')
            );
        }

        $businessinfo = [];
        if(!empty($container)) {
            if($container->find('a.l4a2xp4', 0)) {
                $businessName = $container->find('a.l4a2xp4', 0)->{'aria-label'};
            }

            $businessinfo = [
                'business_url'  => $this->getBusinessUrl($container),
                'business_name' => $businessName,
                'avg_rating'    => $this->getAvgRating($container),
                'total_rating'  => $this->getTotalRating($container)
            ];
        }

        return $businessinfo;
    }

    public function getRoomsBusinessDetails($searchName)
    {
        $searchUrl = 'https://www.airbnb.com/s/'.$searchName.'/homes';
        $fileUrlContents = wp_remote_get($searchUrl);

        if(is_wp_error($fileUrlContents)) {
            throw new \Exception($fileUrlContents->get_error_message());
        }

        $fileUrlContents = wp_remote_retrieve_body(wp_remote_get($searchUrl));

        if (empty($fileUrlContents)) {
            throw new \Exception(
                __('Can\'t fetch reviews due to slow network, please try again', 'wp-social-reviews')
            );
        }

        $html = Helper::str_get_html($fileUrlContents);

        $scripts = $html->find('script[id=data-deferred-state]', 0);

        $scripts = $scripts->innertext;

        $data = json_decode($scripts, true);

        $businessData = [];
        if(!empty($data)) {
            $businesses = isset($data['niobeMinimalClientData'][0][1]['data']['presentation']['explore']['sections']['sections']) ? $data['niobeMinimalClientData'][0][1]['data']['presentation']['explore']['sections']['sections'] : [];
            foreach ($businesses as $business) {
                if(isset($business['section']['layers'][0]['items'][0]['listing'])) {
                    $businessData = isset($business['section']['layers'][0]['items'][0]['listing']) ? $business['section']['layers'][0]['items'][0]['listing'] : [];
                    break;
                }
            }
        }

        $businessinfo = [];
        if(!empty($businessData)) {
            $businessinfo = [
                'business_url'  => isset($businessData['id']) ? 'https://www.airbnb.com/rooms/' . $businessData['id'] : '',
                'business_name' => Arr::get($businessData, 'name', ''),
                'avg_rating'    => Arr::get($businessData, 'avgRating', ''),
                'total_rating'  => Arr::get($businessData, 'reviewsCount', '')
            ];
        }

        return $businessinfo;
    }

    public function getBusinessUrl($content)
    {
        $businessUrl = $content->find('a.l4a2xp4', 0)->href;
        $businessUrl = 'https://www.airbnb.com'.strtok($businessUrl, '?');
        return $businessUrl;
    }

    public function getAvgRating($content)
    {
        $avgRating = 0;
        if($content->find('div.c1accnih', 0)) {
            if($content->find('div.c1accnih', 0)->find('span.rpz7y38', 0)) {
                    $avgRating = strip_tags(trim($content->find('div.c1accnih', 0)->find('span.rpz7y38', 0)));
            }
        }
        return $avgRating;
    }

    public function getTotalRating($content)
    {
        $totalRating = 0;
        if($content->find('div.c1accnih', 0)) {
            if ($content->find('div.c1accnih', 0)->find('span.r1xr6rtg', 0)) {
                $totalRating = $content->find('div.c1accnih', 0)->find('span.r1xr6rtg', 0);
            }
        }
        $totalRating = filter_var(strip_tags(trim($totalRating)), FILTER_SANITIZE_NUMBER_INT);

        return $totalRating;
    }
}