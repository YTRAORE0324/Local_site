<?php
namespace KeyDesign\License;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Updater {
	
	public $theme_name;
	private $transient;

	public function __construct() {
		$this->theme_name = wp_get_theme()->get_template();
		$this->transient = 'keydesign_updater_' . md5( sanitize_key( $this->theme_name ) );
		
		$this->init_actions();
		$this->clear_transient_forced();
	}
	
	private function init_actions() {
		add_filter( 'http_request_args', array( $this, 'update_check' ), 5, 2 );
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'update_theme' ) );
		add_filter( 'pre_set_transient_update_themes', array( $this, 'update_theme' ) );
		add_action( 'delete_site_transient_update_themes', [$this, 'clear_transient'], 10, 2 );
	}
	
	public function clear_transient(): void {
        delete_transient( $this->transient );
    }
	
	private function clear_transient_forced(): void {
		global $pagenow;

		if ( 'update-core.php' === $pagenow && isset( $_GET['force-check'] ) ) {
			$this->clear_transient();
		}
    }
	
	public function update_check( $request, $url ) {
		$keydesign_theme = $this->theme_name;
		if ( false !== strpos( $url, '//api.wordpress.org/themes/update-check/1.1/' ) ) {
			$data = json_decode( $request['body']['themes'] );
			unset( $data->$keydesign_theme );
			$request['body']['themes'] = wp_json_encode( $data );
		}
		return $request;
	}
	
	public function update_theme( $transient ) {
		if ( ! is_object( $transient ) ) {
			return $transient;
		}
		
		$license_key = Admin::get_license_key();
		if ( '' != $license_key ) {
			$update_data = API::check_update();
			$current_version = \KeyDesign\Utils::get_parent_theme_version();
			
			if ( is_wp_error( $update_data ) || empty( $update_data['status'] ) ) {
				return $transient;
			}

			$_theme = [
				'theme'        => $this->theme_name,
				'new_version'  => $update_data['version'],
				'url'          => '',
				'package'      => '',
			];

			if ( '' !== $update_data['version'] ) {
				$_theme['package'] .= $update_data['summary'];
			}

			if ( $update_data[ 'status' ] && ( version_compare( $current_version, $update_data['version'], '<' ) ) ) {
				$transient->response[ $this->theme_name ] = $_theme;
			} else {
				$transient->no_update[ $this->theme_name ] = $_theme;
			}
		}

		return $transient;
	}
}