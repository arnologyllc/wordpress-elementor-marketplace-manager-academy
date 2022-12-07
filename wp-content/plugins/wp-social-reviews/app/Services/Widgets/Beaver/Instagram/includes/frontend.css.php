<?php if ( ! empty( $settings->ig_header_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-header .wpsr-ig-header-inner {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_header_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_username_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-name a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_username_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_statistics_label_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-statistics .wpsr-ig-header-statistic-item {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_statistics_label_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_fullname_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-fullname {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_fullname_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-header .wpsr-ig-header-inner .wpsr-ig-header-info .wpsr-ig-header-description p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_follow_btn_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-follow-btn a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_follow_btn_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_follow_btn_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-follow-btn a {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_follow_btn_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_content_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_content_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_hashtag_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p a{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_hashtag_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_statistics_count_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_statistics_count_color ); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->ig_load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_load_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_load_more_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_load_more_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_load_more_bg_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->ig_box_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->ig_box_bg_color ); ?>;
}
<?php } ?>

<?php
// Follow button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'ig_follow_btn_typography',
	'selector' 		=> ".fl-node-$id .wpsr-ig-follow-btn a",
) );

// Content Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'ig_content_typography',
	'selector' 		=> ".fl-node-$id .wpsr-ig-post .wpsr-ig-post-info .wpsr-ig-post-caption p",
) );

// Count Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'ig_statistics_count_typography',
	'selector' 		=> ".fl-node-$id .wpsr-ig-post-info .wpsr-ig-post-statistics .wpsr-ig-post-single-statistic span",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'ig_load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_more",
) );

