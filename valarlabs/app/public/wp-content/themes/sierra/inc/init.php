<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

defined( 'ABSPATH' ) || exit;

/**
 * Define constants
 */
define( 'KEYDESIGN_THEME_VERSION', '1.1' );
define( 'KEYDESIGN_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'KEYDESIGN_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Includes
 */

// Theme setup
require_once KEYDESIGN_THEME_DIR . 'inc/includes/theme-setup.php';

// Theme hooks
require_once KEYDESIGN_THEME_DIR . 'inc/includes/theme-hooks.php';

// Framework sync
require_once KEYDESIGN_THEME_DIR . 'inc/includes/framework-sync.php';

// Nav Walker
require_once KEYDESIGN_THEME_DIR . 'inc/includes/nav-walker.php';

// Widgets
require_once KEYDESIGN_THEME_DIR . 'inc/includes/widgets.php';

if ( is_admin() ) {
    // TGM Plugin Activation class
    require_once KEYDESIGN_THEME_DIR . 'inc/includes/class-tgm-plugin-activation.php';
    require_once KEYDESIGN_THEME_DIR . 'inc/includes/plugin-activation.php';
}

/**
 * Theme helper and common functions
 */

// Helper functions
require_once KEYDESIGN_THEME_DIR . 'inc/functions/helper-functions.php';

// Template functions
require_once KEYDESIGN_THEME_DIR . 'inc/functions/template-functions.php';
require_once KEYDESIGN_THEME_DIR . 'inc/functions/template-extras.php';

/**
 * Template tags
 */
require_once KEYDESIGN_THEME_DIR . 'inc/template-tags/breadcrumbs.php';
require_once KEYDESIGN_THEME_DIR . 'inc/template-tags/single-comment.php';

/**
 * Plugin compatibility
 */
require_once KEYDESIGN_THEME_DIR . 'inc/compatibility/woocommerce.php';
