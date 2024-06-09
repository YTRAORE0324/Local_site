<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

defined( 'ABSPATH' ) || exit;

$sidebar_name = apply_filters( 'keydesign_get_sidebar', 'sidebar-1' );
$sidebar_switch = apply_filters( 'keydesign_show_sidebar', true );

if ( ! is_active_sidebar( $sidebar_name ) || $sidebar_switch == false ) {
	return;
}
?>
<aside id="secondary" class="widget-area keydesign-sidebar" role="complementary">
	<?php
		keydesign_sidebars_before();
		if ( is_active_sidebar( $sidebar_name ) ) {
			dynamic_sidebar( $sidebar_name );
		}
		keydesign_sidebars_after();
	?>
</aside><!-- #secondary -->
