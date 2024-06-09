<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

    <div id="primary" <?php keydesign_primary_class(); ?> data-attr="single-page">
        <?php
            keydesign_content_primary_top();
            keydesign_content_page();
            keydesign_content_primary_bottom();
        ?>
    </div><!-- #primary -->

<?php get_footer();
