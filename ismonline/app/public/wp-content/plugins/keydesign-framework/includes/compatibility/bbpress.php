<?php
namespace KeyDesign\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'bbPress' ) ) {
	return;
}

class KeyDesign_bbPress {
	
	private static $instance;
	
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function __construct() {
		
		add_action( 'widgets_init', [ $this, 'register_widget_location' ], 15 );
		
	}
	
	public function register_widget_location() {
		register_sidebar(
			apply_filters(
				'keydesign_bbpress_sidebar',
				array(
					'name' => esc_html__( 'bbPress Sidebar', 'keydesign-framework' ),
					'id' => 'bbpress-sidebar',
					'description' => '',
					'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				)
			)
		);
	}
}
KeyDesign_bbPress::instance();