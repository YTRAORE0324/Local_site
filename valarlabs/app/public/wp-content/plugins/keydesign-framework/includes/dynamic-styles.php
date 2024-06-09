<?php
/**
 * Dynamic CSS
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use KeyDesign\Utils;

$title_bar_pt = Utils::get_option( 'title_bar_spacing' );
if ( $title_bar_pt != '' ) {
    $title_bar_pt = preg_match( '/(px|em|\%|pt|cm)$/', $title_bar_pt ) ? $title_bar_pt : $title_bar_pt . 'px';
}

$title_bar_pb = Utils::get_option( 'title_bar_spacing_bottom' );
if ( $title_bar_pb != '' ) {
    $title_bar_pb = preg_match( '/(px|em|\%|pt|cm)$/', $title_bar_pb ) ? $title_bar_pb : $title_bar_pb . 'px';
}

?>

body {
    <?php if ( '' != $title_bar_pt ) : ?>
	    --titlebar-spacing: <?php echo esc_attr( $title_bar_pt ); ?>;
    <?php endif; ?>
    <?php if ( '' != $title_bar_pb ) : ?>
        --titlebar-spacing-bottom: <?php echo esc_attr( $title_bar_pb ); ?>;
    <?php endif; ?>
}

<?php if ( '' != Utils::get_option( 'title_bar_content_width' ) ) : ?>
.page-header {
	--page-title-width: <?php echo esc_attr( Utils::get_option( 'title_bar_content_width' ) ); ?>px;
}
<?php endif; ?>

<?php /** Single blog page modern layout featured image **/
$blog_single_layout = apply_filters( 'keydesign_hook_blog_single_layout', Utils::get_option( 'blog_single_layout' ) );
if ( is_singular( 'post' ) && $blog_single_layout == 'blog-single-layout-modern' && ( has_post_thumbnail() || wp_get_attachment_image_src( get_post_thumbnail_id() ) ) ) {
    $blog_single_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
    .modern-entry-image { background-image: url( '<?php echo esc_url( $blog_single_featured_image[0] ); ?>' ); }
<?php } ?>

<?php if ( is_singular( 'post' ) && Utils::get_option( 'reading_bar_switch' ) && Utils::get_option( 'reading_bar_height' ) != '' ) : ?>
    .rebar-wrapper .rebar-element { height: <?php echo esc_attr( Utils::get_option( 'reading_bar_height' ) ); ?>px; }
<?php endif; ?>

<?php /** Main blog page featured image **/
    if ( is_home() && get_option( 'page_for_posts' ) && has_post_thumbnail( get_option( 'page_for_posts' ) ) ) {
        $blog_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_option( 'page_for_posts' ) ), 'full', false ); ?>
        .blog .page-header { background-image: url( '<?php echo esc_url( $blog_featured_image[0] ); ?>' ); background-size: cover; }
    <?php } ?>

<?php /** Shop page featured image **/
    if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $shop_page_id ), 'full', false ); ?>
        .woocommerce-shop .page-header { background-image: url( '<?php echo esc_url( $shop_featured_image[0] ); ?>' ); background-size: cover; }
    <?php } ?>