<?php
/**
 * The template for displaying header.
 */

defined( 'ABSPATH' ) || exit;
?>

<header id="site-header" <?php keydesign_site_header_class(); ?>>
    <div class="site-header-wrapper">
        <div class="nav-container">
            <div class="keydesign-container e-con">
                <?php keydesign_header_top(); ?>
                <?php get_template_part( 'template-parts/header/site-header/branding' ); ?>
                <?php get_template_part( 'template-parts/header/site-header/navigation' ); ?>
                <?php keydesign_header_bottom(); ?>
            </div>
        </div><!-- .nav-container -->
    </div>
</header>
