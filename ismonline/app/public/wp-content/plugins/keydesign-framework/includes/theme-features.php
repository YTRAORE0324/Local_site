<?php
namespace KeyDesign;

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Theme_Features {

	public function get_backtotop_markup() {
		include_once KEYDESIGN_PATH . 'includes/theme-features/back-top.php';
	}

	public static function get_social_sharing_markup() {
		if ( is_singular( 'post' ) ) {
			include_once KEYDESIGN_PATH . 'includes/theme-features/social-sharing.php';
		}
	}

	public function get_rebar_markup() {
		echo '<div class="rebar-wrapper ' . Utils::get_option( 'reading_bar_color' ) . '"><div class="rebar-element"></div></div>';
	}

	public function display_rebar() {
		if ( is_singular( 'post' ) && Utils::get_option( 'reading_bar_switch' ) ) {
			add_action( 'keydesign_body_bottom', [ $this, 'get_rebar_markup' ] );

			add_action( 'wp_enqueue_scripts', function () {
				wp_enqueue_script(
					'keydesign-rebar',
					KEYDESIGN_ASSETS_URL . 'js/reading-bar.js',
					array( 'jquery' ),
					KEYDESIGN_VERSION,
					false
				);
			} );
		}
	}

	public static function static_page_subtitle() {
		$blog_subtitle = Utils::get_option( 'blog_subtitle' );
		$shop_subtitle = Utils::get_option( 'woo_subtitle' );
		if ( '' != $blog_subtitle && is_home() ) {
			$blog_subtitle = '<p class="entry-subtitle">' . $blog_subtitle . '</p>';
			echo wp_kses_post( wpautop( $blog_subtitle ) );
		}

		if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
			if ( '' != $shop_subtitle && is_shop() ) {
				$shop_subtitle = '<p class="entry-subtitle">' . $shop_subtitle . '</p>';
				echo wp_kses_post( wpautop( $shop_subtitle ) );
			}
		}
	}

	public function theme_features_body_classes( $classes ) {
		$classes[] = '';

		if ( Utils::get_option( 'link_effect' ) != 'default-link-effect' ) {
			$classes[] = Utils::get_option( 'link_effect' );
		}

		if ( Utils::get_option( 'button_effect' ) != 'default-button-effect' ) {
			$classes[] = Utils::get_option( 'button_effect' );
		}

		if ( Utils::get_option( 'layout_style' ) == 'keydesign-boxed' ) {
			$classes[] = Utils::get_option( 'layout_style' );
			$classes[] = Utils::get_option( 'boxed_layout_background_color' );

			if ( Utils::get_option( 'boxed_layout_content_border' ) ) {
				$classes[] = 'keydesign-border';
			}
		}

		return $classes;
	}

	public function __construct() {

		include_once KEYDESIGN_PATH . 'includes/theme-features/theme-options.php';

		add_action( 'template_redirect', [ $this, 'display_rebar' ] );

		add_action( 'keydesign_page_header_content', [ $this, 'static_page_subtitle' ], 12 );

		if ( Utils::get_option( 'go_top_button' ) == true ) {
			add_action( 'keydesign_body_bottom', [ $this, 'get_backtotop_markup' ] );

			add_action( 'wp_enqueue_scripts', function () {
				wp_enqueue_script(
					'keydesign-go-top',
					KEYDESIGN_ASSETS_URL . 'js/back-to-top.js',
					array( 'jquery' ),
					KEYDESIGN_VERSION,
					false
				);
			} );
		}

		if ( Utils::get_option( 'blog_single_social_share' ) ) {
			add_action( 'keydesign_single_entry_content_top', [ $this, 'get_social_sharing_markup' ] );
		}

		if ( Utils::get_option( 'smooth_scroll_switch' ) ) {
			add_action( 'wp_enqueue_scripts', function () {
				wp_enqueue_script(
					'keydesign-smooth-scroll',
					KEYDESIGN_ASSETS_URL . 'js/smooth-scroll.js',
					array( 'jquery' ),
					KEYDESIGN_VERSION,
					false
				);
			} );
		}

		add_filter( 'body_class', [ $this, 'theme_features_body_classes' ] );
	}
}
