<?php

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function portfolio_single_template_actions() {
    if ( is_singular( 'keydesign-portfolio' ) ) {

		/* Remove sidebar */
        add_filter( 'keydesign_show_sidebar', '__return_false' );

		/* Remove keydesign-container markup */
		remove_action( 'keydesign_content_top', 'keydesign_container_top_markup', 20 );
        remove_action( 'keydesign_content_bottom', 'keydesign_container_bottom_markup' );

		/* Comment form */
		remove_action( 'keydesign_single_entry_content_bottom', 'keydesign_comment_form', 25 );
		add_action( 'keydesign_content_bottom', 'keydesign_portfolio_comment_form', 10 );

		/* Related posts */
		add_action( 'keydesign_content_bottom', 'keydesign_portfolio_related_posts', 15 );

		/* Post navigation */
		add_action( 'keydesign_content_bottom', 'keydesign_portfolio_navigation', 20 );

    }
}
add_action( 'wp', 'portfolio_single_template_actions', 15 );

function portfolio_archive_template_actions() {
    if ( 'keydesign-portfolio' == get_post_type() && is_archive() ) {

		/* Remove sidebar */
        add_filter( 'keydesign_show_sidebar', '__return_false' );

		/* Container Portfolio grid class */
		add_filter( 'keydesign_container_class', 'keydesign_portfolio_classes' );

		/* Replace featured image */
		remove_action( 'keydesign_entry_top', 'keydesign_blog_featured_item', 10 );
		add_action( 'keydesign_entry_top', 'keydesign_portfolio_featured_image', 10 );

		/* Replace post category entry */
		remove_action( 'keydesign_entry_wrapper_top', 'keydesign_display_post_categories', 5 );
		add_action( 'keydesign_entry_wrapper_top', 'keydesign_display_portfolio_categories', 5 );

		/* Display card button */
		add_action( 'keydesign_entry_content_card', 'keydesign_display_card_button' );
    }
}
add_action( 'wp', 'portfolio_archive_template_actions', 15 );

function keydesign_portfolio_featured_image() {

	if ( has_post_thumbnail() ) { ?>
		<div class="entry-image medium-size-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'keydesign-medium-image' ); ?></a>
		</div>
	<?php }

}

function keydesign_display_portfolio_categories() {
	include KEYDESIGN_MODULES_PATH . '/portfolio/template-parts/category.php';
}

function keydesign_display_card_button() { ?>
	<div class="entry-button-wrapper">
		<a class="keydesign-button" href="<?php the_permalink(); ?>"><?php echo apply_filters( 'portfolio_archive_button_text', esc_html__( "View project", "keydesign-framework" ) ); ?></a>
	</div>
	<?php
}

function keydesign_portfolio_comment_form() {
	if ( ( comments_open() || get_comments_number() ) && Utils::get_option( 'portfolio_comments_switch' ) ) : ?>
        <section class="portfolio-comments">
            <div class="keydesign-container e-con">
                <?php comments_template(); ?>
            </div>
        </section>
    <?php endif;
}

function keydesign_portfolio_related_posts() {
    if ( Utils::get_option( 'portfolio_related_switch' ) ) {
        include_once KEYDESIGN_MODULES_PATH . '/portfolio/template-parts/related.php';
    }
}

function keydesign_portfolio_navigation() {
    if ( Utils::get_option( 'portfolio_pagination_switch' ) ) {
        include_once KEYDESIGN_MODULES_PATH . '/portfolio/template-parts/navigation.php';
    }
}

function keydesign_portfolio_classes( $classes ) {

	$classes[] = 'blog-layout-grid';

    return $classes;
}

/* Overwrite portfolio cpt and category slug */
$portfolio_cpt_slug = Utils::get_option( 'portfolio_cpt_slug' );
$portfolio_cpt_category_slug = Utils::get_option( 'portfolio_cpt_category_slug' );

add_filter( 'keydesign_portfolio_slug', function( $args ) use ( $portfolio_cpt_slug ) {
    if ( isset( $portfolio_cpt_slug ) && $portfolio_cpt_slug != '' ) {
        return $portfolio_cpt_slug;
    }
    return $args;
});

add_filter( 'keydesign_portfolio_category_slug', function( $args ) use ( $portfolio_cpt_category_slug ) {
    if ( isset( $portfolio_cpt_category_slug ) && $portfolio_cpt_category_slug != '' ) {
        return $portfolio_cpt_category_slug;
    }
    return $args;
});
