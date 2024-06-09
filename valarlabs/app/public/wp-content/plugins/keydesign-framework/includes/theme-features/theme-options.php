<?php

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function keydesign_404_page_title( $value ) {
    if ( '' != Utils::get_option( 'error_page_title' ) ) {
        $value = Utils::get_option( 'error_page_title' );
    }
    return $value;
}
add_filter( '404_page_title_hook', 'keydesign_404_page_title' );

function keydesign_404_page_subtitle( $value ) {
    if ( '' != Utils::get_option( 'error_page_subtitle' ) ) {
        $value = Utils::get_option( 'error_page_subtitle' );
    }
    return $value;
}
add_filter( '404_page_subtitle_hook', 'keydesign_404_page_subtitle' );

// Hide blog page title bar
function keydesign_hide_blog_title_bar() {
    if ( is_home() && get_option( 'page_for_posts' ) ) {
        if ( Utils::get_option( 'blog_hide_title_bar' ) == true ) {
            remove_action( 'keydesign_content_top', 'keydesign_display_page_title' );
        }
    }
}
add_action( 'wp', 'keydesign_hide_blog_title_bar' );

// Hide signle blog post featured image
function keydesign_hide_blog_featured_image() {
    if ( Utils::get_option( 'blog_single_hide_featured_image' ) == true ) {
        remove_action( 'keydesign_single_entry_content_top', 'keydesign_blog_featured_item', 20 );
    }
}
add_action( 'init', 'keydesign_hide_blog_featured_image' );