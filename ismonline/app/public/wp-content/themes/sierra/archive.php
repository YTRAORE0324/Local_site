<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

    <div id="primary" <?php keydesign_primary_class(); ?>>
        <?php
        keydesign_content_primary_top();
        keydesign_content_loop();
        the_posts_pagination();
        keydesign_content_primary_bottom();
        ?>
    </div><!-- #primary -->
    
    <?php get_sidebar(); ?>

<?php get_footer();
