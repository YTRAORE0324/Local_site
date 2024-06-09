<?php
/**
 * Plugin Name: KeyDesign Framework
 * Description: KeyDesign Themes core plugin.
 * Version: 1.6.1
 * Author: KeyDesign Themes
 * Author URI: https://www.keydesign.xyz/
 * Text Domain: keydesign-framework
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Set constants.
 */
define( 'KEYDESIGN_VERSION', '1.6.1' );

define( 'KEYDESIGN_FILE', __FILE__ );
define( 'KEYDESIGN_PLUGIN_BASE', plugin_basename( KEYDESIGN_FILE ) );
define( 'KEYDESIGN_PATH', plugin_dir_path( KEYDESIGN_FILE ) );
define( 'KEYDESIGN_URL', plugin_dir_url( KEYDESIGN_FILE ) );

define( 'KEYDESIGN_COMPATIBILITY_PATH', KEYDESIGN_PATH . 'includes/compatibility' );
define( 'KEYDESIGN_MODULES_PATH', KEYDESIGN_PATH . 'includes/modules' );
define( 'KEYDESIGN_ASSETS_PATH', KEYDESIGN_PATH . 'assets/' );
define( 'KEYDESIGN_ASSETS_URL', KEYDESIGN_URL . 'assets/' );

add_action( 'plugins_loaded', 'keydesign_load_plugin_textdomain' );

/**
 * Load KeyDesign textdomain.
 *
 * Load gettext translate for KeyDesign text domain.
 *
 * @return void
 */
function keydesign_load_plugin_textdomain() {
	load_plugin_textdomain( 'keydesign-framework', false, dirname( KEYDESIGN_PLUGIN_BASE ) . '/languages' );
}

function is_keydesign_theme() {
	$author_name = 'Key-Design';

	$theme = wp_get_theme( get_template() );
	if ( ! $theme->parent() ) {
		$theme_author = $theme->get( 'Author' );
	} else {
		$theme_author = $theme->parent( 'Author' );
	}

	if ( $author_name == $theme_author ) {
		return true;
	}

	return false;
}

/* Allow SVG upload */
add_filter( 'wp_check_filetype_and_ext', function( $data, $file, $filename, $mimes ) {

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext' => $filetype['ext'],
      'type' => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function allow_svg_upload( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );

if ( ! version_compare( PHP_VERSION, '7.0', '>=' ) ) {
    add_action( 'admin_notices', 'keydesign_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '6.0', '>=' ) ) {
    add_action( 'admin_notices', 'keydesign_fail_wp_version' );
} else {
	if ( is_keydesign_theme() ) {
    	require KEYDESIGN_PATH . 'includes/plugin.php';
	}
}

function keydesign_fail_php_version() {
	$message = sprintf(
		esc_html__( 'KeyDesign Framework isn’t running because PHP is outdated. Update to PHP version %1$s.', 'keydesign-framework' ),
		'7.0',
	);
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

function keydesign_fail_wp_version() {
	$message = sprintf(
		esc_html__( 'KeyDesign Framework isn’t running because WordPress is outdated. Update to version %1$s.', 'keydesign-framework' ),
		'5.9',
	);
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}
