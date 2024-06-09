<?php
namespace KeyDesign\License;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Admin {

	const LICENSE_KEY_OPTION_NAME = 'keydesign_license_key';
	const CLIENT_NAME_OPTION_NAME = 'keydesign_client_name';
	
	const LICENSE_DATA_OPTION_NAME = '_keydesign_license_data';
	const LICENSE_DATA_FALLBACK_OPTION_NAME = self::LICENSE_DATA_OPTION_NAME . '_fallback';
	
	public static function deactivate() {
		API::deactivate_license();

		delete_option( self::LICENSE_KEY_OPTION_NAME );
		delete_option( self::LICENSE_DATA_OPTION_NAME );
		delete_option( self::LICENSE_DATA_FALLBACK_OPTION_NAME );
	}
	
	public static function get_license_key() {
		return trim( get_option( self::LICENSE_KEY_OPTION_NAME ) );
	}
	
	public static function get_client_name() {
		return trim( get_option( self::CLIENT_NAME_OPTION_NAME ) );
	}

	public static function set_license_key( $license_key ) {
		return update_option( self::LICENSE_KEY_OPTION_NAME, $license_key );
	}
	
	public static function set_client_name( $client_name ) {
		return update_option( self::CLIENT_NAME_OPTION_NAME, $client_name );
	}
	
	public function action_activate_license() {
		check_admin_referer( 'keydesign-license' );

		$license_key = $_POST[ 'keydesign_license_code' ];
		$client_name = $_POST[ 'keydesign_client_name' ];

		$data = API::activate_license( $license_key, $client_name );
		
		if ( ! $data['status'] ) {
			$error_msg = $data['message'];
			wp_die( wp_kses_post( $error_msg ), esc_html__( 'KeyDesign Framework', 'keydesign-framework' ), [
				'back_link' => true,
			] );
		}

		self::set_license_key( $license_key );
		self::set_client_name( $client_name );
		API::set_license_data( $data );
		
		// Set Theme Options default library
		$theme_options = get_option( 'keydesign_options' );

		// Check if $theme_options is false, and initialize as array if necessary
		if ( $theme_options === false ) {
			$theme_options = array();
		}

		$theme_options['elementor_default_library'] = 'keydesign-library';
		update_option( 'keydesign_options', $theme_options );
		
		// Clear Elementor transient cache
		\KeyDesign\Utils::clear_transient_cache();

		$this->safe_redirect( admin_url( 'admin.php?page=keydesign-dashboard' ) );
	}
	
	public static function get_masked_license_key() {
		$input_string = self::get_license_key();

		$start = 9;
		$length = mb_strlen( $input_string ) - $start - 13;

		$mask_string = preg_replace( '/\S/', 'X', $input_string );
		$mask_string = mb_substr( $mask_string, $start, $length );
		$input_string = substr_replace( $input_string, $mask_string, $start, $length );

		return $input_string;
	}

	protected function safe_redirect( $url ) {
		wp_safe_redirect( $url );
		die;
	}

	public function action_deactivate_license() {
		check_admin_referer( 'keydesign-license' );

		$this->deactivate();

		$this->safe_redirect( admin_url( '?page=keydesign-dashboard' ) );
	}
	
	public function register_actions() {
		add_action( 'admin_post_keydesign_activate_license', [ $this, 'action_activate_license' ] );
		add_action( 'admin_post_keydesign_deactivate_license', [ $this, 'action_deactivate_license' ] );
	}
}