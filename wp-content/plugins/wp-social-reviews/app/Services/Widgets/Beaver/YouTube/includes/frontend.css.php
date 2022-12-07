<?php if ( ! empty( $settings->yt_header_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header .wpsr-yt-header-inner {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_header_channel_name_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-name a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_channel_name_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_header_statistics_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-statistics .wpsr-yt-header-statistic-item {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_statistics_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_header_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header .wpsr-yt-header-inner .wpsr-yt-header-info .wpsr-yt-header-channel-description p {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_header_follow_btn_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header-subscribe-btn a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_follow_btn_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_header_follow_btn_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-header-subscribe-btn a {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_header_follow_btn_bg_color ); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->yt_load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_load_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_load_more_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_load_more_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_load_more_bg_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-description {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_title_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-video .wpsr-yt-video-info h3 a {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_title_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_statistics_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_statistics_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->yt_box_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-yt-video {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->yt_box_bg_color ); ?>;
}
<?php } ?>

<?php
// Follow button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'yt_header_follow_btn_typography',
	'selector' 		=> ".fl-node-$id .wpsr-yt-header-subscribe-btn a",
) );

// Title Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'yt_title_typography',
	'selector' 		=> ".fl-node-$id .wpsr-yt-video .wpsr-yt-video-info h3",
) );

// Statistics Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'yt_statistics_typography',
	'selector' 		=> ".fl-node-$id .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-statistics .wpsr-yt-video-statistic-item",
) );

// Description Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'yt_description_typography',
	'selector' 		=> ".fl-node-$id .wpsr-yt-video .wpsr-yt-video-info .wpsr-yt-video-description",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'yt_load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_more",
) );
