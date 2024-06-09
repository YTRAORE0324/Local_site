<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Performance {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'disable_classic_editor_features' ] );
	}
	
	public function disable_classic_editor_features() {
		
        // Disable Gutenberg colors
        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	}
}