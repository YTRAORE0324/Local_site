<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
