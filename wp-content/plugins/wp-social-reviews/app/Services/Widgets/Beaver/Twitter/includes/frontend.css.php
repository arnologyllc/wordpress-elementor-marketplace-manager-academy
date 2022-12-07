<?php if ( ! empty( $settings->tw_header_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_full_name_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-name {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_full_name_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_username_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-info-name-wrapper .wpsr-twitter-user-info-username {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_username_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-bio p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_location_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-contact span {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_location_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_statistics_label_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-name {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_statistics_label_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_statistics_count_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-header .wpsr-twitter-user-info-wrapper .wpsr-twitter-user-info .wpsr-twitter-user-statistics .wpsr-twitter-user-statistics-item .wpsr-twitter-user-statistics-item-data {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_statistics_count_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_follow_btn_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-user-follow-btn {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_follow_btn_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_header_follow_btn_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-user-follow-btn {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_header_follow_btn_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_fullname_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_fullname_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_fullname_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_fullname_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_content_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_content_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_meta_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name, .fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_meta_text_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_meta_text_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name:hover, .fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_meta_text_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_hashtag_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p a{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_hashtag_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_actions_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_actions_text_color ); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->tw_actions_icon_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-actions a svg {
    fill: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_actions_icon_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_load_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_load_more_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_load_more_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_load_more_bg_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tw_box_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-twitter-feed-wrapper .wpsr-twitter-tweet {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->tw_box_bg_color ); ?>;
}
<?php } ?>

<?php
// Follow button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tw_header_follow_btn_typography',
	'selector' 		=> ".fl-node-$id .wpsr-twitter-user-follow-btn",
) );

// fullname Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tw_fullname_typography',
	'selector' 		=> ".fl-node-$id .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links a.wpsr-tweet-author-name",
) );

// Meta Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tw_meta_typography',
	'selector' 		=> ".fl-node-$id .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-user-name,.fl-node-$id .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-author-info .wpsr-tweet-author-links .wpsr-tweet-time",
) );

// Content Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tw_content_typography',
	'selector' 		=> ".fl-node-$id .wpsr-twitter-tweet .wpsr-twitter-author-tweet .wpsr-tweet-content p",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tw_load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_more",
) );
