<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widgets {
	
	private function include_widgets_files() {
		include_once KEYDESIGN_PATH . 'includes/widgets/recent-posts/widget.php';
	}

	public function register_widgets() {
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		register_widget( 'KeyDesign_Widget_Recent_Posts' );
	}

	public function __construct() {
		// Register the widgets.
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}
}