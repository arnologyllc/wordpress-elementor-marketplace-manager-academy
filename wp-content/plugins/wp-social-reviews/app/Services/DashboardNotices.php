<?php

namespace WPSocialReviews\App\Services;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * DashboardNotices
 * @since 3.7.1
 */
class DashboardNotices
{
    private $templateCount = null;

    /**
     * Option name
     * @var string
     * @since 3.7.1
     **/
    private $option_name = 'wpsr_statuses';

    private function getTemplateCount()
    {
        if(null === $this->templateCount){
            $templates = get_posts([
                'post_type' => ['wp_social_reviews', 'wpsr_reviews_notify', 'wpsr_social_chats'],
                'post_status' => 'publish',
                'numberposts' => -1
            ]);
            $this->templateCount = count($templates);
        }

        return $this->templateCount;
    }

    public function noticeTracker()
    {
        if ( !current_user_can('manage_options') ) {
            return false;
        }

        $statuses = get_option($this->option_name, []);
        $rescue_me = Arr::get($statuses, 'rescue_me');
        if($rescue_me === '1' || $rescue_me === '3'){
            return false;
        }

        $installDate = Arr::get($statuses, 'installed_time');

        $remind_me = Arr::get($statuses, 'remind_me', strtotime('now'));
        $remind_due = strtotime('+15 days', $remind_me);
        $past_date = strtotime("-10 days");
        $now = strtotime("now");

        if($this->getTemplateCount() > 0){
            if($now >= $remind_due){
                return true;
            } elseif ($past_date >= $installDate && $rescue_me !== '2') {
                return true;
            }
        }
    }


    public function updateNotices($args = [])
    {
        $value = sanitize_text_field(Arr::get($args, 'value'));
        $notice_type = sanitize_text_field(Arr::get($args, 'notice_type'));

        $statuses = get_option( 'wpsr_statuses', []);

        if($notice_type === 'rescue_me' && $value === '1'){
            $statuses['rescue_me'] = '1';
            update_option($this->option_name, $statuses, false);
        }

        if($notice_type === 'remind_me' && $value === '1'){
            $statuses['remind_me'] = strtotime('now');
            $statuses['rescue_me'] = '2';
            update_option($this->option_name, $statuses, false);
        }

        if($notice_type === 'already_rated' && $value === '1'){
            $statuses['already_rated'] = 'yes';
            $statuses['rescue_me'] = '3';
            update_option($this->option_name, $statuses, false);
        }
    }

    public function getNoticesStatus()
    {
        return $this->noticeTracker();
    }
}