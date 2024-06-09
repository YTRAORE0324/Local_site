<?php
namespace KeyDesign\Compatibility;

defined( 'ABSPATH' ) || die();

class Widgets extends KeyDesign_Elementor {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		// Register the widgets.
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
	}

	private function include_widgets_files() {
		$widgetFiles = [
		    'widgets/portfolio.php',
		    'widgets/logo.php',
		];

		foreach ( $widgetFiles as $file ) {
		    require_once $file;
		}
	}

	public function register_widgets() {
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		$widgets = [
		    new Elementor\Widgets\KD_Widget_Portfolio(),
		    new Elementor\Widgets\KD_Widget_Site_Logo(),
		];

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

		foreach ( $widgets as $widget ) {
		    $widgets_manager->register( $widget );
		}
	}
}

Widgets::instance();
