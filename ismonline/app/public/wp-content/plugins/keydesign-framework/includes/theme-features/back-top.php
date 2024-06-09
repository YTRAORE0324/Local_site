<?php
use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wrapper_class = $style_class = '';
$backtotop_progress = false;

// Wrapper class
$position = Utils::get_option( 'go_top_button_position' );
$color_scheme = Utils::get_option( 'go_top_button_color' );
$backtotop_style = Utils::get_option( 'go_top_button_style' );

if ( $backtotop_style == 'scroll-progress-style' ) {
    $backtotop_progress = true;
    $style_class = 'scroll-position-style';
}
$wrapper_class = implode( ' ', array( 'back-to-top', $position, $color_scheme, $style_class ) );

?>
<div class="<?php echo esc_attr( trim( $wrapper_class ) ); ?>">
    <span class="icon-arrow-up"></span>
    <?php if ( $backtotop_progress == true ) : ?>
        <svg height="50" width="50"><circle cx="25" cy="25" r="24" /></svg>
    <?php endif; ?>
</div>
