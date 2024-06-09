<?php

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( Utils::get_option( 'maintenance_mode_page_title_label' ) ) {
	$maintenance_title_label = Utils::get_option( 'maintenance_mode_page_title_label' );
} else {
	$maintenance_title_label = __( 'we’ll be back shortly!', 'keydesign-framework' );
}

if ( Utils::get_option( 'maintenance_mode_page_title' ) ) {
	$maintenance_title = Utils::get_option( 'maintenance_mode_page_title' );
} else {
	$maintenance_title = __( 'The website is under maintenance.', 'keydesign-framework' );
}

if ( Utils::get_option( 'maintenance_mode_page_content' ) ) {
	$maintenance_content = Utils::get_option( 'maintenance_mode_page_content' );
} else {
	$maintenance_content = __( 'Custom maintenance mode page. In an ideal world this website wouldn’t exist, a client acknowledge.', 'keydesign-framework' );
}

$default_bg_id = Utils::get_option( 'maintenance_mode_image' );
$default_bg = wp_get_attachment_image_src( $default_bg_id, 'full' );
?><!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( 'maintenance-mode' ); ?>>
        <div class="maintenance-inner">
            <div class="maintenance-column maintenance-content">
                <div class="maintenance-content-inner">
					<h6 class="maintenance-title-label"><?php echo esc_html( $maintenance_title_label ); ?></h6>

                    <h1 class="maintenance-title"><?php echo esc_html( $maintenance_title ); ?></h1>
					
                    <p><?php echo wp_kses_post( $maintenance_content ); ?></p>

                    <?php if ( Utils::get_option( 'maintenance_mode_countdown_switch' ) ) :?>
                        <div class="keydesign-countdown countdown" data-count-year="<?php echo esc_attr( Utils::get_option( 'maintenance_mode_countdown_year') ); ?>" data-count-month="<?php echo esc_attr( Utils::get_option( 'maintenance_mode_countdown_month') ); ?>" data-count-day="<?php echo esc_attr( Utils::get_option( 'maintenance_mode_countdown_day') ); ?>" data-count-hour="12" data-count-minute="0" data-text-days="Days" data-text-hours="Hours" data-text-minutes="Minutes" data-text-seconds="Seconds"></div>
                    <?php endif; ?>
                </div>
            </div>
			<?php if ( '' != $default_bg ) : ?>
				<div class="maintenance-column maintenance-image" style="background-image: url(<?php echo esc_url( $default_bg[0] ); ?>);"></div>
			<?php endif; ?>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
