<?php
use WPSocialReviews\App\Services\Platforms\Reviews\Helper;

if (!empty($reviews)) {
    foreach ($reviews as $index => $review) {
        $reviewer_url = $review->platform_name === 'facebook' ? 'https://www.facebook.com/'.$review->source_id.'/reviews' : $review->reviewer_url;

        /**
         * reviews_template_item_wrappers_before hook.
         *
         * @hooked ReviewsTemplateHandler::renderTemplateItemParentWrapper - 10 (outputs opening divs for the review item)
         * */
        do_action('wpsocialreviews/reviews_template_item_wrappers_before', $template_meta);
        ?>
            <div class="wpsr-review-template wpsr-review-template-three <?php echo ($review->platform_name) ? 'wpsr-review-template-' . esc_attr($review->platform_name) : ''; ?>"
                 style="height:<?php echo ($template_meta['equal_height'] === 'true') && $template_meta['contentType'] === 'excerpt' ? $template_meta['equalHeightLen'] . 'px' : ''; ?>"
                 data-index="<?php echo esc_attr($index); ?>"
                 data-review_platform="<?php echo esc_attr($review->platform_name); ?>"
            >
                <?php if (($template_meta['isPlatformIcon'] === 'true' && !Helper::is_tp($review->platform_name)) || ($template_meta['isPlatformIcon'] === 'true' && $template_meta['display_tp_brand'] === 'true' && Helper::is_tp($review->platform_name ))) { ?>
                    <div class="wpsr-review-platform">
                        <span><?php echo (empty($template_meta['platform_label']) || !in_array($review->platform_name, ['custom', 'fluent_forms'])) ? strtok($review->platform_name, '_') : $template_meta['platform_label']; ?></span>
                    </div>
                <?php } ?>
                <?php
                /**
                 * review_title hook.
                 *
                 * @hooked ReviewsTemplateHandler::renderReviewTitleHtml 10
                 * */
                do_action('wpsocialreviews/review_title', $template_meta['display_review_title'], $review->review_title, $review->platform_name);

                /**
                 * reviewer_rating hook.
                 *
                 * @hooked ReviewsTemplateHandler::renderReviewerRatingHtml 10
                 * */
                do_action('wpsocialreviews/reviewer_rating', $template_meta['reviewerrating'],
                    $template_meta['rating_style'], $review->rating, $review->platform_name,
                    $review->recommendation_type);

                /**
                 * review_content hook.
                 *
                 * @hooked ReviewsTemplateHandler::renderReviewContentHtml 10
                 * */
                do_action('wpsocialreviews/review_content',
                    $template_meta['isReviewerText'],
                    $template_meta['content_length'],
                    $template_meta['contentType'],
                    $review->reviewer_text,
                    $template_meta['contentLanguage']
                );
                ?>
                <div class="wpsr-review-header">
                    <?php
                    /**
                     * reviewer_image hook.
                     *
                     * @hooked ReviewsTemplateHandler::renderReviewerImageHtml 10
                     * */
                    do_action('wpsocialreviews/reviewer_image', $template_meta['reviewer_image'],
                        $reviewer_url, $review->reviewer_img, $review->reviewer_name);
                    ?>
                    <div class="wpsr-review-info">
                        <?php
                        /**
                         * reviewer_name hook.
                         *
                         * @hooked ReviewsTemplateHandler::renderReviewerNameHtml 10
                         * */
                        do_action('wpsocialreviews/reviewer_name', $template_meta['reviewer_name'],
                            $reviewer_url, $review->reviewer_name);
                        /**
                         * review_date hook.
                         *
                         * @hooked ReviewsTemplateHandler::renderReviewDateHtml 10
                         * */
                        do_action('wpsocialreviews/review_date', $template_meta['timestamp'],
                            $review->review_time);
                        ?>
                    </div>
                </div>
            </div>
        <?php
        /**
         * reviews_template_item_wrappers_after hook.
         *
         * @hooked ReviewsTemplateHandler::renderTemplateItemParentWrapperEnd - 10 (outputs closing divs for the review item)
         * */
        do_action('wpsocialreviews/reviews_template_item_wrappers_after');
    }
}