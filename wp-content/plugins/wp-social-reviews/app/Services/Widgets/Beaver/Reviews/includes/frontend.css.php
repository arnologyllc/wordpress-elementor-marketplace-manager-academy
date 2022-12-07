<?php if ( ! empty( $settings->header_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-business-info {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->header_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->header_rating_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-business-info .wpsr-rating-and-count, .fl-node-<?php echo esc_attr($id); ?> .wpsr-business-info .wpsr-rating-and-count .wpsr-total-rating {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->header_rating_text_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->header_war_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-business-info .wpsr-business-info-right .wpsr-write-review {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->header_war_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->header_war_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-business-info .wpsr-business-info-right .wpsr-write-review {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->header_war_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->name_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template .wpsr-review-info a h4{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->name_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->title_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template .wpsr-review-title{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->title_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template .wpsr-review-content p{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->description_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->platform_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template .wpsr-review-platform span{
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->platform_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->platform_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template .wpsr-review-platform span{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->platform_text_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->read_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_add_read_more .wpsr_read_more, .fl-node-<?php echo esc_attr($id); ?> .wpsr_add_read_more .wpsr_read_less{
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->read_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-reviews-loadmore span {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->load_more_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-reviews-loadmore span:hover {
    color: <?php echo FLBuilderColor::hex_or_rgb( $settings->load_more_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-reviews-loadmore span {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->load_more_bg_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-reviews-loadmore span:hover {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->load_more_bg_hover_color ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->box_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-review-template {
    background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->box_bg_color ); ?>;
}
<?php } ?>

<?php
// Header rating text Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'header_rating_text_typography',
	'selector' 		=> ".fl-node-$id .wpsr-business-info .wpsr-rating-and-count, .fl-node-$id .wpsr-business-info .wpsr-rating-and-count .wpsr-total-rating",
) );

// Write a review button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'header_war_typography',
	'selector' 		=> ".fl-node-$id .wpsr-business-info .wpsr-business-info-right .wpsr-write-review",
) );

// Name Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'name_typography',
	'selector' 		=> ".fl-node-$id .wpsr-review-template .wpsr-review-info a h4",
) );

// Title Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'title_typography',
	'selector' 		=> ".fl-node-$id .wpsr-review-template .wpsr-review-title",
) );

// Description Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'description_typography',
	'selector' 		=> ".fl-node-$id .wpsr-review-template .wpsr-review-content p",
) );

// Read More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'read_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_add_read_more .wpsr_read_more, .fl-node-$id .wpsr_add_read_more .wpsr_read_less",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr-reviews-loadmore span",
) );