<?php
 /**
  * Theme Hook Alliance hook stub list.
  *
  * @link https://github.com/zamoose/themehookalliance
  */

add_theme_support( 'keydesign_hooks', array(
	'all',
	'html',
	'body',
	'head',
	'header',
	'content',
	'entry',
	'comments',
	'sidebars',
	'sidebar',
	'footer',
) );

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'keydesign_hooks', 'header' ) )
 * 	  		add_action( 'keydesign_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 *
 * @return bool
 */
function keydesign_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-keydesign_hooks', 'keydesign_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $keydesign_supports[] = 'html;
 */
function keydesign_html_before() {
	do_action( 'keydesign_html_before' );
}
/**
 * HTML <body> hooks
 * $keydesign_supports[] = 'body';
 */
function keydesign_body_top() {
	do_action( 'keydesign_body_top' );
}

function keydesign_body_bottom() {
	do_action( 'keydesign_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $keydesign_supports[] = 'head';
 */
function keydesign_head_top() {
	do_action( 'keydesign_head_top' );
}

function keydesign_head_bottom() {
	do_action( 'keydesign_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $keydesign_supports[] = 'header';
 */
function keydesign_header_before() {
	do_action( 'keydesign_header_before' );
}

function keydesign_header_after() {
	do_action( 'keydesign_header_after' );
}

function keydesign_header_top() {
	do_action( 'keydesign_header_top' );
}

function keydesign_header_bottom() {
	do_action( 'keydesign_header_bottom' );
}

function keydesign_header() {
	do_action( 'keydesign_header' );
}

function keydesign_page_header_before() {
	do_action( 'keydesign_page_header_before' );
}

function keydesign_page_header_after() {
	do_action( 'keydesign_page_header_after' );
}

function keydesign_page_header_top() {
	do_action( 'keydesign_page_header_top' );
}

function keydesign_page_header_bottom() {
	do_action( 'keydesign_page_header_bottom' );
}

function keydesign_page_header_content() {
	do_action( 'keydesign_page_header_content' );
}

/**
 * Semantic <content> hooks
 *
 * $keydesign_supports[] = 'content';
 */
function keydesign_content_before() {
	do_action( 'keydesign_content_before' );
}

function keydesign_content_after() {
	do_action( 'keydesign_content_after' );
}

function keydesign_content_top() {
	do_action( 'keydesign_content_top' );
}

function keydesign_content_bottom() {
	do_action( 'keydesign_content_bottom' );
}

function keydesign_content_primary_top() {
	do_action( 'keydesign_content_primary_top' );
}

function keydesign_content_primary_bottom() {
	do_action( 'keydesign_content_primary_bottom' );
}

function keydesign_content_while_before() {
	do_action( 'keydesign_content_while_before' );
}

function keydesign_content_while_after() {
	do_action( 'keydesign_content_while_after' );
}

function keydesign_content_page() {
	do_action( 'keydesign_content_page' );
}

function keydesign_content_single() {
	do_action( 'keydesign_content_single' );
}

function keydesign_content_loop() {
	do_action( 'keydesign_content_loop' );
}

function keydesign_content_404_page() {
	do_action( 'keydesign_content_404_page' );
}

/**
 * Semantic <entry> hooks
 *
 * $keydesign_supports[] = 'entry';
 */
function keydesign_entry_before() {
	do_action( 'keydesign_entry_before' );
}

function keydesign_entry_after() {
	do_action( 'keydesign_entry_after' );
}

function keydesign_entry_content_before() {
	do_action( 'keydesign_entry_content_before' );
}

function keydesign_entry_content_after() {
	do_action( 'keydesign_entry_content_after' );
}

function keydesign_entry_top() {
	do_action( 'keydesign_entry_top' );
}

function keydesign_entry_bottom() {
	do_action( 'keydesign_entry_bottom' );
}

function keydesign_entry_wrapper_top() {
	do_action( 'keydesign_entry_wrapper_top' );
}

function keydesign_entry_wrapper_bottom() {
	do_action( 'keydesign_entry_wrapper_bottom' );
}

function keydesign_entry_content_card() {
	do_action( 'keydesign_entry_content_card' );
}

function keydesign_single_entry_content_top() {
	do_action( 'keydesign_single_entry_content_top' );
}

function keydesign_single_entry_content_bottom() {
	do_action( 'keydesign_single_entry_content_bottom' );
}

/**
 * Post meta hooks
 */
function keydesign_post_meta_top() {
	do_action( 'keydesign_post_meta_top' );
}

function keydesign_post_meta_bottom() {
	do_action( 'keydesign_post_meta_bottom' );
}

/**
 * Comments block hooks
 *
 * $keydesign_supports[] = 'comments';
 */
function keydesign_comments_before() {
	do_action( 'keydesign_comments_before' );
}

function keydesign_comments_after() {
	do_action( 'keydesign_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $keydesign_supports[] = 'sidebar';
 */
function keydesign_sidebars_before() {
	do_action( 'keydesign_sidebars_before' );
}

function keydesign_sidebars_after() {
	do_action( 'keydesign_sidebars_after' );
}

/**
 * Related posts block hooks
 */

function keydesign_related_content_before() {
	do_action( 'keydesign_related_content_before' );
}

function keydesign_related_content_after() {
	do_action( 'keydesign_related_content_after' );
}

function keydesign_related_content_top() {
	do_action( 'keydesign_related_content_top' );
}

function keydesign_related_content_bottom() {
	do_action( 'keydesign_related_content_bottom' );
}
/**
 * Semantic <footer> hooks
 *
 * $keydesign_supports[] = 'footer';
 */
function keydesign_footer_before() {
	do_action( 'keydesign_footer_before' );
}

function keydesign_footer_after() {
	do_action( 'keydesign_footer_after' );
}

function keydesign_footer_top() {
	do_action( 'keydesign_footer_top' );
}

function keydesign_footer_bottom() {
	do_action( 'keydesign_footer_bottom' );
}

function keydesign_footer() {
	do_action( 'keydesign_footer' );
}

/**
 *  Backwards compatibility for wp_body_open()
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
