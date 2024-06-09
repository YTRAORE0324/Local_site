<?php
/**
 * Helper functions
 */

defined( 'ABSPATH' ) || exit;

// Return Theme options.
if ( ! function_exists( 'keydesign_get_option' ) ) {
    function keydesign_get_option( $option, $default = '' ) {
        $setting = 'keydesign_options';
        $options = get_option( $setting, array() );

        if ( ! empty( $options[ $option ] ) ) {
            return apply_filters( 'keydesign_option_' . $option, $options[ $option ] );
        }

        return $default;
    }
}

// Check if archive page
if ( ! function_exists( 'keydesign_is_blog_archive' ) ) {
    function keydesign_is_blog_archive() {
        return apply_filters( 'keydesign_is_blog_archive', ( is_home() || ( 'post' == get_post_type() && ( is_tax() || is_archive() ) ) ) ? true : false );
    }
}

// Check if WooCommerce page
if ( ! function_exists( 'keydesign_is_woocommerce_page' ) ) {
	function keydesign_is_woocommerce_page() {
		$val = apply_filters( 'keydesign_is_woocommerce_page', ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product() || is_cart() ) ) ? true : false );

		return $val;
	}
}

// Check if Elementor page
if ( ! function_exists( 'is_elementor_page' ) ) {
    function is_elementor_page() {
        if ( class_exists( '\Elementor\Plugin' ) ) {
            // Check static pages
            if ( is_attachment() || is_search() || is_404() ) {
                return false;
            }

            // Check blog pages
            if ( keydesign_is_blog_archive() || is_archive() || is_singular('post') ) {
                return false;
            }

            // Check WooCommerce pages
            if ( keydesign_is_woocommerce_page() ) {
                return false;
            }

            // Check elementor
            $current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );

            if ( ! $current_doc ) {
                return false;
            }

            if ( $current_doc->is_built_with_elementor() ) {
                return true;
            }
        }

        return false;
    }
}
