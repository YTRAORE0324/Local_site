<?php
namespace KeyDesign\License;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class API {
	
	const API_URL = 'https://api.keydesign.xyz/';
	
	// License Statuses
	const STATUS_MISSING = 'missing';
	const STATUS_HTTP_ERROR = 'http_error';
	
	const TRANSIENT_KEY_PREFIX = 'keydesign_remote_info_api_data_';
	
	protected static $transient_data = [];

	public static function get_ip_address() {
		$server_ip_keys = [
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
		];
	
		foreach ( $server_ip_keys as $key ) {
			if ( isset( $_SERVER[$key] ) && filter_var( $_SERVER[$key], FILTER_VALIDATE_IP ) ) {
				$ip_address = sanitize_text_field( $_SERVER[$key] );
				$ip_address = str_replace( [' ', '/'], '', $ip_address );
				return $ip_address;
			}
		}
	
		// Fallback to a default IP address
		return '127.0.0.1';
	}
	
	private static function call_api( $endpoint, $data = [] ) {
		
		$this_ip = self::get_ip_address();
		$header_args = [];
			
		$header_args = wp_parse_args(
			$header_args,
			[
				'Content-Type' => 'application/json',
				'LB-API-KEY' => '005192A5583805E0BEB1',
				'LB-URL' => home_url(),
				'LB-IP' => $this_ip,
			]
		);

		$response = wp_remote_post( self::API_URL . $endpoint, [
			'timeout' => 40,
			'headers' => $header_args,
			'body' => json_encode( $data ),
		] );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( empty( $data ) || ! is_array( $data ) ) {
			return new \WP_Error( 'no_json', esc_html__( 'An error occurred, please try again', 'keydesign-framework' ) );
		}

		return $data;
	}
	
	public static function get_product_id() {
		$data = get_option('KEYDESIGN_API_PRODUCT_ID');
		
		return $data;
	}
	
	public static function activate_license( $license_key, $client_name ) {
		$data_array = [
			'product_id' => self::get_product_id(),
			'license_code' => $license_key,
			'client_name' => $client_name,
			'verify_type' => 'envato',
		];

		$license_data = self::call_api( 'api/activate_license', $data_array );

		return $license_data;
	}
	
	public static function deactivate_license() {
		$data_array = [
			'product_id' => self::get_product_id(),
			'license_code' => Admin::get_license_key(),
			'client_name' => Admin::get_client_name(),
		];

		$license_data = self::call_api( 'api/deactivate_license', $data_array );

		return $license_data;
	}
	
	public static function set_transient( $cache_key, $value, $expiration = '+12 hours' ) {
		$data = [
			'timeout' => strtotime( $expiration, current_time( 'timestamp' ) ),
			'value' => json_encode( $value ),
		];

		$updated = update_option( $cache_key, $data, false );
		if ( false === $updated ) {
			self::$transient_data[ $cache_key ] = $data;
		}
	}

	private static function get_transient( $cache_key ) {
		$cache = self::$transient_data[ $cache_key ] ?? get_option( $cache_key );

		if ( empty( $cache['timeout'] ) ) {
			return false;
		}

		if ( current_time( 'timestamp' ) > $cache['timeout'] && is_user_logged_in() ) {
			return false;
		}

		return json_decode( $cache['value'], true );
	}

	public static function set_license_data( $license_data, $expiration = null ) {
		if ( null === $expiration ) {
			$expiration = '+12 hours';

			self::set_transient( Admin::LICENSE_DATA_FALLBACK_OPTION_NAME, $license_data, '+24 hours' );
		}

		self::set_transient( Admin::LICENSE_DATA_OPTION_NAME, $license_data, $expiration );
	}
	
	public static function get_license_data( $force_request = false ) {
return array("status"=>true, "data"=>"+1 year");//nullfix
		$license_data_error = [
			'status' => false,
			'error' => static::STATUS_HTTP_ERROR,
		];

		$license_code = Admin::get_license_key();
		$client_name = Admin::get_client_name();

		if ( empty( $license_code ) && empty( $client_name ) ) {
			$license_data_error['error'] = static::STATUS_MISSING;

			return $license_data_error;
		}

		$license_data = self::get_transient( Admin::LICENSE_DATA_OPTION_NAME );

		if ( false === $license_data || $force_request ) {
			$data_array = [
				'product_id' => self::get_product_id(),
				'license_code' => $license_code,
				'client_name' => $client_name,
			];

			$license_data = self::call_api( 'api/verify_license', $data_array );

			if ( is_wp_error( $license_data ) || ! isset( $license_data['status'] ) ) {
				$license_data = self::get_transient( Admin::LICENSE_DATA_FALLBACK_OPTION_NAME );
				if ( false === $license_data ) {
					$license_data = $license_data_error;
				}

				self::set_license_data( $license_data, '+30 minutes' );
			} else {
				self::set_license_data( $license_data );
			}
		}

		return $license_data;
	}
	
	public static function check_update( $force_request = true ) {
		$cache_key = self::TRANSIENT_KEY_PREFIX . \KeyDesign\Utils::get_parent_theme_version();

		$info_data = self::get_transient( $cache_key );
		
		if ( false === $info_data || $force_request ) {
			$data_array =  array(
				"product_id"  => self::get_product_id(),
				"current_version" => \KeyDesign\Utils::get_parent_theme_version()
			);
			
			$info_data = self::call_api( 'api/check_update', $data_array );
			
			if ( is_wp_error( $info_data ) ) {
				return new \WP_Error( esc_html__( 'HTTP Error', 'keydesign-framework' ) );
			}
			
			self::set_transient( $cache_key, $info_data );
		}
		
		return $info_data;
	}
	
	public static function check_connection() {
return array("status"=>true);//nullfix
		$status = self::call_api( 'api/check_connection_ext' );
		
		return $status;
	}
	
	
}