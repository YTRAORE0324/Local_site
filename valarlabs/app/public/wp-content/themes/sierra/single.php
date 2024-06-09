<?php
/**
 * The Template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

    <div id="primary" <?php keydesign_primary_class(); ?> data-attr="single-post">
        <?php
            keydesign_content_primary_top();
            keydesign_content_single();
            keydesign_content_primary_bottom();
        ?>
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

<?php get_footer();
