<?php

namespace WPSocialReviews\App\Services\Libs\SimpleDom;

class Helper
{
    public static function file_get_html($url, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = false, $stripRN = true, $defaultBRText = "\r\n", $defaultSpanText = " ")
    {
        // We DO force the tags to be terminated.
        $dom = new HtmlDom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
        // For sourceforge users: uncomment the next line and comment the retreive_url_contents line 2 lines down if it is not already done.
        $contents = file_get_contents($url, $use_include_path, $context, $offset);
        // Paperg - use our own mechanism for getting the contents as we want to control the timeout.
        //$contents = retrieve_url_contents($url);
        if (empty($contents) || strlen($contents) > 6000000) {
            return false;
        }

        // The second parameter can force the selectors to all be lowercase.
        $dom->load($contents, $lowercase, $stripRN);
        return $dom;
    }

    public static function str_get_html($str, $lowercase=true, $forceTagsClosed=true, $target_charset = 'UTF-8', $stripRN=true, $defaultBRText='\r\n', $defaultSpanText=' ')
    {
        $dom = new HtmlDom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
        if (empty($str) || strlen($str) > 6000000)
        {
            $dom->clear();
            return false;
        }
        $dom->load($str, $lowercase, $stripRN);

        return $dom;
    }

}
