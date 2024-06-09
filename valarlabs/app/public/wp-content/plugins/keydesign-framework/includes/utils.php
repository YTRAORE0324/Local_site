<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Utils {

	const TEMPLATES_DATA_TRANSIENT_KEY_PREFIX = 'elementor_remote_templates_data_';

	public static function init() {
		register_activation_hook( KEYDESIGN_PLUGIN_BASE, [ __CLASS__, 'activation' ] );
		register_deactivation_hook( KEYDESIGN_PLUGIN_BASE, [ __CLASS__, 'deactivation' ] );
		register_uninstall_hook( KEYDESIGN_PLUGIN_BASE, [ __CLASS__, 'uninstall' ] );
	}

	public static function activation() {
		flush_rewrite_rules();
		static::clear_transient_cache();
	}

	public static function deactivation() {
		flush_rewrite_rules();
		static::clear_transient_cache();
	}

	public static function uninstall() {
		flush_rewrite_rules();
		static::clear_transient_cache();
	}

	public static function clear_transient_cache() {

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		$templates_data_cache_key = static::TEMPLATES_DATA_TRANSIENT_KEY_PREFIX . ELEMENTOR_VERSION;

		if ( ! get_transient( $templates_data_cache_key ) ) {
			return;
		}

		if ( wp_doing_ajax() ) {
			return;
		}

		delete_transient( $templates_data_cache_key );
	}

	public static function get_option( $option, $default = '' ) {
        $setting = 'keydesign_options';
        $options = get_option( $setting, array() );

        if ( ! empty( $options[ $option ] ) ) {
            return apply_filters( 'keydesign_option_' . $option, $options[ $option ] );
        }

        return $default;
    }

	// Get theme name
    public static function get_parent_theme_name() {

		$theme = wp_get_theme( get_template() );
		if ( ! $theme->parent() ) {
			$theme_name = $theme->get( 'Name' );
		} else {
			$theme_name = $theme->parent( 'Name' );
		}

		return $theme_name;

	}

	// Get theme version
    public static function get_parent_theme_version() {

		$theme = wp_get_theme( get_template() );
		if ( ! $theme->parent() ) {
			$theme_version = $theme->get( 'Version' );
		} else {
			$theme_version = $theme->parent( 'Version' );
		}

		return $theme_version;

	}

	// Get theme author
    public static function get_parent_theme_author() {

		$theme = wp_get_theme( get_template() );
		if ( ! $theme->parent() ) {
			$theme_name = $theme->get( 'Author' );
		} else {
			$theme_name = $theme->parent( 'Author' );
		}

		return $theme_name;

	}

	public static function is_keydesign_theme() {
		$author_name = 'Key-Design';

		if ( $author_name == Utils::get_parent_theme_author() ) {
			return true;
		}

		return false;
	}

	// Compress and minify dynamic styles
    public static function compress_css( $css = '' ) {
            if ( ! empty( $css ) ) {
                $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
                $css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
                $css = str_replace( ', ', ',', $css );
            }
            return $css;
    }

	// Render theme dynamic styles
    public static function get_dynamic_styles() {
        ob_start();
        include_once KEYDESIGN_PATH . 'includes/dynamic-styles.php';
        $dynamic_css = ob_get_clean();

        // Get custom CSS
        $custom_css = self::get_option( 'custom_css' );
        if ( '' != $custom_css ) {
            $dynamic_css .= $custom_css;
        }

        $dynamic_css = self::compress_css( $dynamic_css );
        return $dynamic_css;
    }
}
