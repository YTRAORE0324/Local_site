<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Theme_Options {

	public static $instance = null;
	public $config_autoload;
	public $layout_options;
	public $keydesign_get_option;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'init', [ $this, 'config_autoload' ] );
		add_filter( 'wpcfto_options_page_setup', [ $this, 'layout_options' ] );

		// Dequeue Nuxy scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'remove_nuxy_scripts' ], 99 );
	}

	public function config_autoload() {
		$config_map = array(
			'global-options',
			'layout',
			'blog',
			'portfolio',
			'woocommerce',
			'utility-pages',
			'custom-css',
		);

		foreach ( $config_map as $file ) {
			if ( file_exists( dirname( __FILE__ ) . '/theme-options/' . $file . '.php' ) ) {
				require_once dirname( __FILE__ ) . '/theme-options/' . $file . '.php';
			}
		}
	}

	public function layout_options( $setup ) {
		$cto = apply_filters( 'keydesign_theme_options', array() );

		$setup[] = array(
			/*
			 * Here we specify option name. It will be a key for storing in wp_options table
			 */
			'option_name' => 'keydesign_options',
	        'title' => __('Theme options', 'keydesign-framework'),
            'sub_title' => __('by KeyDesign Themes', 'keydesign-framework'),
            'logo' => '',

			/*
			 * Next we add a page to display our awesome settings.
			 * All parameters are required and same as WordPress add_menu_page.
			 */
			'page' => array(
				'parent_slug' => 'keydesign-dashboard',
				'page_title' => __( 'Theme Options', 'keydesign-framework' ),
				'menu_title' => __( 'Theme Options', 'keydesign-framework' ),
				'capability' => 'manage_options',
				'menu_slug' => 'theme-options',
				'position' => 1,
			),
	        'title' => __('Theme options', 'keydesign-framework'),
	        'sub_title' => __('by KeyDesign Themes', 'keydesign-framework'),
	        'logo' => plugin_dir_url( __FILE__ ) . 'theme-options/images/theme-options-logo.jpg',
			/*
			 * And Our fields to display on a page. We use tabs to separate settings on groups.
			 */
			'fields' => $cto,
		);

		return $setup;
	}

	public static function remove_nuxy_scripts() {
		wp_dequeue_style( 'nuxy-rtl' );
		wp_dequeue_style( 'linear-icons' );
		wp_dequeue_style( 'wpcfto-metaboxes.css' );
		wp_dequeue_style( 'font-awesome-min' );
	}
}

Theme_Options::instance();
