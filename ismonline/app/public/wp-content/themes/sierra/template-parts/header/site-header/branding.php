<?php
/**
 * Site branding & logo
 */

$site_name = get_option( 'blogname', '' );
$home_url = home_url( '/' );
$logo_id = get_theme_mod( 'custom_logo' );
?>

<div class="site-branding">
    <?php if ( class_exists( '\Elementor\Plugin' ) && '' != $logo_id ) {
        $logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
        if ( $logo_src ) {
            $logo_src = $logo_src[0];
        }
        if ( '' != $logo_src ) {
            echo '<div class="site-logo"><a href="' . esc_url( $home_url ) . '" itemprop="url"><img src="' . esc_url( $logo_src ) .'" alt="' . esc_attr( $site_name ) .'" /></a></div>';
        }
    } else { ?>
        <p class="site-title">
            <a href="<?php echo esc_url( $home_url ); ?>" rel="home"><?php echo esc_attr( $site_name ); ?></a>
        </p>
    <?php } ?>
</div>
