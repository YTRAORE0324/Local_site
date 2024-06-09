<?php
namespace KeyDesign\Admin;

use KeyDesign\License\API;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

class System_Status {

	const MIN_MEMORY_LIMIT = 134217728; // 128 MB
	const MIN_PHP_VERSION = '7.4';

	private static $system_status_vars = [];

	public function __construct() {
	}

	public static function let_to_num( $size ) {
		$l   = substr( $size, - 1 );
		$ret = (int) substr( $size, 0, - 1 );

		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			// No break.
			case 'T':
				$ret *= 1024;
			// No break.
			case 'G':
				$ret *= 1024;
			// No break.
			case 'M':
				$ret *= 1024;
			// No break.
			case 'K':
				$ret *= 1024;
			// No break.
		}

		return $ret;
	}

	public static function init_vars() {
		global $wpdb;

		// Theme name
		self::$system_status_vars['theme_name'] = \KeyDesign\Utils::get_parent_theme_name();

		// Theme version
		self::$system_status_vars['theme_version'] =  \KeyDesign\Utils::get_parent_theme_version();

		// Check if current theme is child theme
		self::$system_status_vars['is_child_theme'] = is_child_theme();

		// WordPress Home URL
		self::$system_status_vars['wp_home_url'] = home_url();

		// WordPress Site URL
		self::$system_status_vars['wp_site_url'] = site_url();

		// WordPress Absolute Path
		self::$system_status_vars['wp_abspath'] = ABSPATH;

		// WordPress Content Dir
		self::$system_status_vars['wp_content_dir'] = WP_CONTENT_DIR;

		// WordPress Version
		self::$system_status_vars['wp_version'] = $GLOBALS['wp_version'];

		// WordPress Multisite
		self::$system_status_vars['wp_multisite'] = is_multisite();

		// WordPress Memory Limit
		$wp_memory_limit = self::let_to_num( WP_MEMORY_LIMIT );

		if ( function_exists( 'memory_get_usage' ) ) {
			$wp_memory_limit = max( $wp_memory_limit, self::let_to_num( @ini_get( 'memory_limit' ) ) );
		}

		self::$system_status_vars['wp_memory_limit'] = $wp_memory_limit;

		// WordPress Debug
		self::$system_status_vars['wp_debug'] = defined( 'WP_DEBUG' ) && WP_DEBUG;

		// WordPress Language
		self::$system_status_vars['wp_language'] = get_locale();

		// Server info
		self::$system_status_vars['server_info'] = $_SERVER['SERVER_SOFTWARE'];

		// PHP version
		self::$system_status_vars['php_version'] = phpversion();

		// PHP post max size
		self::$system_status_vars['php_post_max_size'] = self::let_to_num( ini_get( 'post_max_size' ) );

		// PHP max execution time
		self::$system_status_vars['max_execution_time'] = (int) ini_get( 'max_execution_time' );

		// PHP input vars
		self::$system_status_vars['max_input_vars'] = (int) ini_get( 'max_input_vars' );

		// Max upload size
		self::$system_status_vars['max_upload_size'] = wp_max_upload_size();

		// MySQL version
		self::$system_status_vars['mysql_version'] = 'N/A';

		if ( ! empty( $wpdb->is_mysql ) ) {

			if ( $wpdb->use_mysqli ) {
				$server_info = mysqli_get_server_info( $wpdb->dbh );
			} else {
				$server_info = mysql_get_server_info( $wpdb->dbh );
			}

			self::$system_status_vars['mysql_version'] = $server_info;
		}

		// Curl Version
		$curl_version = '';

		if ( function_exists( 'curl_version' ) ) {
			$curl_version = curl_version();
			$curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
		} elseif ( extension_loaded( 'curl' ) ) {
			$curl_version = esc_html( 'cURL installed but unable to retrieve version.', 'keydesign-framework' );
		}

		self::$system_status_vars['curl_version'] = $curl_version;

		// DOMDocument
		self::$system_status_vars['domdocument'] = class_exists( 'DOMDocument' );

		// Secure connection
		self::$system_status_vars['secure_connection'] = 'https' === substr( home_url(), 0, 5 );
	}

	public static function get_var( $name ) {

		if ( isset( self::$system_status_vars[ $name ] ) ) {
			return self::$system_status_vars[ $name ];
		}

		return null;
	}

	public static function yes_no( $value ) {
		return boolval( $value ) ? 'Yes' : 'No';
	}

	public static function yes_null( $value ) {
		return boolval( $value ) ? 'Yes' : '-';
	}

	public static function green_text( $text ) {
		return sprintf( '<mark class="yes">%s</mark>', wp_kses_post( $text ) );
	}

	public static function red_text( $text ) {
		return sprintf( '<mark class="no">%s</mark>', wp_kses_post( $text ) );
	}

	public static function display_theme_version() {
		$theme_version = self::get_var( 'theme_version' );
		echo esc_html( $theme_version );
	}

	public static function display_wp_version() {
		$wp_version = self::get_var( 'wp_version' );

		// Retrieve latest version available for WordPress
		$version_check = wp_remote_get( 'https://api.wordpress.org/core/version-check/1.7/' );
		$api_response  = json_decode( wp_remote_retrieve_body( $version_check ), true );

		if ( $api_response && isset( $api_response['offers'], $api_response['offers'][0], $api_response['offers'][0]['version'] ) ) {
			$latest_version = $api_response['offers'][0]['version'];
		} else {
			$latest_version = null;
		}

		// Display WP version
		if ( is_null( $latest_version ) ) {
			echo sprintf( esc_html__( '%s - Your server doesn\'t allow to check for latest version of WordPress.', 'keydesign-framework' ), $wp_version );
		} else if ( version_compare( $wp_version, $latest_version, '>=' ) ) {
			echo self::green_text( $wp_version );
		} else {
			echo sprintf( esc_html__( '%1$s - There is a newer version of WordPress available (%2$s).', 'keydesign-framework' ), self::red_text( $wp_version ), $latest_version );
		}
	}

	public static function display_memory_limit() {

		$memory_limit = self::get_var( 'wp_memory_limit' );
		$memory_limit_formatted = size_format( $memory_limit );

		if ( $memory_limit >= self::MIN_MEMORY_LIMIT ) {
			echo self::green_text( $memory_limit_formatted );
		} else {
			echo self::red_text( sprintf( esc_html__( '%1$s - We recommend setting memory to at least %2$s.', 'keydesign-framework' ), $memory_limit_formatted, size_format( self::MIN_MEMORY_LIMIT ) ) );
		}
	}

	public static function display_php_version() {

		// PHP version
		$php_version = self::$system_status_vars['php_version'];

		// Minimum required PHP version by the theme
		if ( version_compare( $php_version, self::MIN_PHP_VERSION, '>=' ) ) {
			echo self::green_text( $php_version );
		} // Under PHP 7.4
		else if ( version_compare( $php_version, '7.4', '<' ) ) {

			$php_version_display = $php_version;

			if ( version_compare( $php_version, '7', '<' ) ) {
				$php_version_display = self::red_text( $php_version );
			}

			// Make the php version bold
			$php_version_display = sprintf( '<strong>%s</strong>', $php_version_display );

			echo sprintf( esc_html__( '%s - We recommend using PHP version 7.4 or above for greater performance and security.', 'keydesign-framework' ), $php_version_display );
		}
	}

	public static function display_php_max_execution_time() {
		$max_execution_time = self::get_var( 'max_execution_time' );
		$demo_content_execution_time = 90;

		// Correct execution time
		if ( $max_execution_time >= 30 ) {
			$max_execution_time_green = self::green_text( $max_execution_time );

			if ( $max_execution_time < $demo_content_execution_time ) {
				echo sprintf( esc_html__( '%1$s - We recommend setting max execution time at least %2$s when you are importing demo content. See: %3$s', 'keydesign-framework' ), $max_execution_time_green, $demo_content_execution_time, '<a href="https://wordpress.org/documentation/article/common-wordpress-errors/#maximum-execution-time-exceeded" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Increasing max execution to PHP', 'keydesign-framework' ), '</a>' );
			} else {
				echo $max_execution_time_green;
			}
		} else {
			echo sprintf( esc_html__( '%s - Minimum recommended PHP execution time limit should be 30 seconds.', 'keydesign-framework' ), self::red_text( $max_execution_time ) );
		}
	}

	public static function display_php_max_input_vars() {
		$max_input_vars = System_Status::get_var( 'max_input_vars' );
		$req_input_vars = 2500;

		if ( $max_input_vars >= $req_input_vars ) {
			echo $max_input_vars;
		} else {
			echo sprintf( esc_html__( '%1$s - The minimum recommended limit is %2$s.', 'keydesign-framework' ), self::red_text( $max_input_vars ), $req_input_vars );
		}
	}

	public static function display_api_connection_status() {
		$connection_status = false;

		$api_data = API::check_connection();
		$connection_status = false;
		if ( !is_wp_error( $api_data ) ) {
			if ( $api_data['status'] ) {
				$connection_status = true;
			}
		}

		// Display connection status
		echo self::yes_no( $connection_status );

		if ( ! $connection_status ) {
			echo self::red_text( esc_html__( ' - KeyDesign API server is not accessible at this url.', 'keydesign-framework' ) );
		}
	}

	public static function display_secure_connection() {
		$secure_connection = self::get_var( 'secure_connection' );

		// Secure connection state
		echo self::yes_no( $secure_connection );

		// More information
		if ( false === $secure_connection ) {
			echo self::red_text( esc_html__( ' - Your site is not using HTTPS.', 'keydesign-framework' ) );
		}
	}
}