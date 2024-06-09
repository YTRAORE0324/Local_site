<?php
namespace KeyDesign\Modules;

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * KeyDesign maintenance mode.
 */
class Maintenance_Mode {

	/**
	 * Template redirect.
	 *
	 * Redirect to the "Maintenance Mode" template.
	 *
	 * @access public
	 */
	public function template_redirect() {

		if ( is_user_logged_in() ) {
			return;
		}

		$is_enabled = Utils::get_option( 'maintenance_mode_switch' );

		if ( $is_enabled ) {
			$protocol = wp_get_server_protocol();
			header( "$protocol 503 Service Unavailable", true, 503 );
			header( 'Content-Type: text/html; charset=utf-8' );
			header( 'Retry-After: 600' );

			$template = KEYDESIGN_MODULES_PATH . '/maintenance-mode/views/maintenance-view.php';
			include $template;
			exit();
		}
	}

	/**
	 * Add menu in admin bar.
	 *
	 * @access public
	 */
	public function add_menu_in_admin_bar( \WP_Admin_Bar $wp_admin_bar ) {
		$url = admin_url( 'admin.php?page=theme-options#utility-pages' );
		$wp_admin_bar->add_node( [
			'id' => 'keydesign-maintenance-on',
			'title' => esc_html__( 'Maintenance Mode ON', 'keydesign-framework' ),
			'href'  => $url,
		] );
	}

	/**
	 * Print style.
	 *
	 * @access public
	 */
	public function print_style() {
		?>
		<style>#wpadminbar #wp-admin-bar-keydesign-maintenance-on { background-color: #dc3232; }
			#wp-admin-bar-keydesign-maintenance-on > .ab-item:before { content: "\f160"; top: 2px; }</style>
		<?php
	}

	/**
	 * Maintenance mode constructor.
	 *
	 * Initializing KeyDesign maintenance mode.
	 *
	 * @access public
	 */
	public function __construct() {

		$is_enabled = Utils::get_option( 'maintenance_mode_switch' );

		if ( ! $is_enabled ) {
			return;
		}

		add_action( 'admin_bar_menu', [ $this, 'add_menu_in_admin_bar' ], 300 );
		add_action( 'admin_head', [ $this, 'print_style' ] );
		add_action( 'wp_head', [ $this, 'print_style' ] );

		add_action( 'wp_enqueue_scripts', function () {
			if ( is_admin() ) {
				return;
			}
			if ( Utils::get_option( 'maintenance_mode_countdown_switch' ) ) {
				wp_enqueue_script(
					'keydesign-countdown',
					KEYDESIGN_URL . 'assets/js/countdown.js',
					[],
					KEYDESIGN_VERSION,
					true
				);
			}
		} );

		add_action( 'template_redirect', [ $this, 'template_redirect' ], 11 );
	}
}
