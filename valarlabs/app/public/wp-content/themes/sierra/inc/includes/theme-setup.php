<?php
/**
 * Theme setup
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'keydesign_setup' ) ) {
 	/**
 	 * Theme setup
 	 */
    function keydesign_setup() {

        /**
        * Register menu locations
        */
        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'sierra' ),
                'footer-menu' => __( 'Footer Menu', 'sierra' ),
            )
        );

        /**
        * Load textdomain.
        */
        load_theme_textdomain( 'sierra', KEYDESIGN_THEME_DIR . '/languages' );

        /**
        * Define content width in articles
        */
        if ( ! isset( $content_width ) ) {
            $content_width = 1140; // Pixels.
        }

    }
}
add_action( 'after_setup_theme', 'keydesign_setup' );

if ( ! function_exists( 'keydesign_theme_support' ) ) {
    /**
     * Build theme support
     */
    function keydesign_theme_support() {
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'navigation-widgets',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );

		add_theme_support(
			'post-formats',
			array(
				'gallery',
				'video',
				'audio',
			)
		);

		add_image_size( 'keydesign-medium-image', 710 );

        // WooCommerce in general.
		add_theme_support( 'woocommerce' );
		// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
		// zoom.
		add_theme_support( 'wc-product-gallery-zoom' );
		// lightbox.
		add_theme_support( 'wc-product-gallery-lightbox' );
		// swipe.
		add_theme_support( 'wc-product-gallery-slider' );

        // Disable block-based widget support
        remove_theme_support( 'widgets-block-editor' );
    }
}
add_action( 'after_setup_theme', 'keydesign_theme_support' );

if ( ! function_exists( 'keydesign_theme_scripts' ) ) {
    /**
     * Theme Scripts & Styles
     */
    function keydesign_theme_scripts() {
        $css_uri = KEYDESIGN_THEME_URI . 'assets/css/';
        $js_uri = KEYDESIGN_THEME_URI . 'assets/js/';

        // Enqueue variables.css
        wp_enqueue_style(
			'sierra-variables',
			$css_uri . 'variables.css',
			[],
			KEYDESIGN_THEME_VERSION
		);

        // Enqueue global.css
        wp_enqueue_style(
			'sierra-global',
			$css_uri . 'global.css',
			['sierra-variables'],
			KEYDESIGN_THEME_VERSION
		);

        // Enqueue jquery and front-end.js
        wp_enqueue_script( 'jquery-core' );
        wp_enqueue_script(
            'sierra-scripts',
            $js_uri . 'front-end.js',
            [],
            KEYDESIGN_THEME_VERSION,
            true
        );

        // Required comment-reply script
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'keydesign_theme_scripts' );

if ( ! function_exists( 'keydesign_admin_scripts' ) ) {
    /**
     * Admin Scripts & Styles
     */
    function keydesign_admin_scripts() {
        $css_uri = KEYDESIGN_THEME_URI . 'assets/css/';
        $js_uri = KEYDESIGN_THEME_URI . 'assets/js/';

        wp_enqueue_style(
			'sierra-admin-style',
			$css_uri . 'admin-style.css',
			[],
			KEYDESIGN_THEME_VERSION
		);
    }
}
add_action( 'admin_enqueue_scripts', 'keydesign_admin_scripts' );

if ( ! function_exists( 'keydesign_content_width' ) ) {
	/**
	 * Set default content width.
	 */
	function keydesign_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'keydesign_content_width', 1140 );
	}
}
add_action( 'after_setup_theme', 'keydesign_content_width', 0 );
