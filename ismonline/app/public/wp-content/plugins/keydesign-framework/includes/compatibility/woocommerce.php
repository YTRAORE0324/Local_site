<?php
namespace KeyDesign\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KeyDesign_WooCommerce {

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {

		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style(
				'keydesign-woocommerce',
				KEYDESIGN_ASSETS_URL . 'css/keydesign-woocommerce.css',
				[],
				KEYDESIGN_VERSION
			);
		}, 120 );
	}

}
KeyDesign_WooCommerce::instance();
