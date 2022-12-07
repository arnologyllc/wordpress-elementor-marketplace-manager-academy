<?php if ( ! empty( $settings->fb_header_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_header_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_header_page_name_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_header_page_name_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_header_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_header_description_color ); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->fb_header_likes_count_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_header_likes_count_color ); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->fb_feed_button_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_feed_button_text_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_feed_button_background_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_feed_button_background_color ); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->fb_content_author_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-author .wpsr-fb-feed-author-info a{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_content_author_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_content_date_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-author .wpsr-fb-feed-time, .fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_content_date_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_title_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_title_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_title_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a:hover{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_title_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_content_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-inner p{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_content_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_content_link_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-inner p a{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_content_link_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_content_link_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-inner p a:hover{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_content_link_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_post_content_rm_link_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_content_rm_link_color ); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->fb_post_sc_domain_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_sc_domain_color ); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->fb_post_sc_title_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_sc_title_color ); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->fb_post_sc_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_post_sc_description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_load_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_load_more_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_load_more_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_load_more_bg_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->fb_box_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-fb-feed-item .wpsr-fb-feed-inner {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->fb_box_bg_color ); ?>;
}
<?php } ?>

<?php
// Header PageName Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_header_page_name_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a",
) );

// Header Description Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_header_page_description_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p",
) );

// Header Likes Counter Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_header_page_likes_counter_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span",
) );


// Like and Share button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_feed_button_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a",
) );

// Post Author Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_content_author_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-author .wpsr-fb-feed-author-info a",
) );

// Post Date Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_content_date_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-author .wpsr-fb-feed-time, .fl-node-$id .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item",
) );

// Post Title Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_post_title_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3",
) );

// Post Content Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_post_content_typography',
	'selector' 		=> ".fl-node-$id .wpsr-fb-feed-inner p",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'fb_load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_more",
) );