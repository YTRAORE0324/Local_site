<?php
/**
 * Page title bar
 */

defined( 'ABSPATH' ) || exit;

$keydesign_title_switch = true;
if ( class_exists( '\KeyDesign\Plugin' ) ) {
	$keydesign_title_switch = keydesign_get_option( 'title_bar_switch' );
}
$elementor_title_switch = apply_filters( 'elementor_page_title_switch', true );
if ( $keydesign_title_switch == false || $elementor_title_switch == false ) {
	return;
}
?>
<?php keydesign_page_header_before(); ?>
<header id="page-header" <?php keydesign_page_header_class(); ?>>
	<div class="keydesign-container e-con">
		<?php
			keydesign_page_header_top();
			keydesign_page_header_content();
			keydesign_page_header_bottom();
		?>
	</div>
</header>
<?php keydesign_page_header_after(); ?>