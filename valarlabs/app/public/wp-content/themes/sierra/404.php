<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>
    <div id="primary" <?php keydesign_primary_class(); ?>>
        <?php
            keydesign_content_primary_top();
            keydesign_content_404_page();
            keydesign_content_primary_bottom();
        ?>
    </div><!-- #primary -->
<?php get_footer();
