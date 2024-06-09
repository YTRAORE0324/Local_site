<?php
/**
 * The Template for displaying all single Give Forms.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

    <div id="primary" <?php keydesign_primary_class(); ?> data-attr="single-post">
        <?php
            do_action( 'give_before_single_form' );
            do_action( 'give_single_form_summary' );
            do_action( 'give_after_single_form' );
        ?>
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

<?php get_footer();