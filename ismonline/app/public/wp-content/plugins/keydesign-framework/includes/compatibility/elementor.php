<?php
namespace KeyDesign\Compatibility;

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class KeyDesign_Elementor {

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		// Register elementor locations
		add_action( 'elementor/theme/register_locations', [ $this, 'register_locations' ] );

		// Get body classes
		add_filter( 'body_class', [ $this, 'elementor_body_classes' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'load_elementor_styles' ] );

		require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/widgets.php';
		require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/site-settings.php';
		require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/widget-controls.php';
		require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/library-template-layout.php';

		if ( '' != \KeyDesign\Utils::get_option( 'typekit_id' ) ) {
			require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/typekit.php';
		}

		add_action( 'init', [ $this, 'update_default_elementor_kit' ] );

		add_action( 'elementor/init', [ $this, 'load_keydesign_library' ], 15 );
		add_action( 'init', [ $this, 'clear_library_cache' ] );

		add_filter( 'elementor_page_title_switch', [ $this, 'check_hide_title' ] );

		add_action( 'after_switch_theme', [ $this, 'enable_cpt_support' ] );
		add_action( 'after_switch_theme', [ $this, 'dismiss_plugin_notices' ] );

		add_action( 'wp_dashboard_setup', [ $this, 'remove_dashboard_widgets' ] );
		add_action( 'admin_menu', [ $this, 'elementor_free_menu' ], 801 );

		add_action( 'admin_enqueue_scripts', [ $this, 'elementor_free_styles' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'elementor_free_styles' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'elementor_editor_styles' ] );

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'elementor_performance_actions' ] );

		add_filter( 'elementor/init', [ $this, 'update_experiments_data' ] );
	}

	public static function elementor_body_classes( $classes ) {
		$classes[] = '';

		if ( 'keydesign-library' == \KeyDesign\Utils::get_option( 'elementor_default_library' ) ) {
			$classes[] = 'keydesign-elementor-library';
		}

		return $classes;
	}

	public static function load_keydesign_library() {
		$license_key = \KeyDesign\License\Admin::get_license_key();
		if ( $license_key && 'keydesign-library' == \KeyDesign\Utils::get_option( 'elementor_default_library' ) ) {
			include KEYDESIGN_COMPATIBILITY_PATH . '/elementor/library.php';
			$unregister_source = function($id) {
				unset( $this->_registered_sources[ $id ] );
			};
			$unregister_source->call( \Elementor\Plugin::instance()->templates_manager, 'remote');
			\Elementor\Plugin::instance()->templates_manager->register_source( 'Elementor\TemplateLibrary\KeyDesign_Source' );
		}
	}

	public static function clear_library_cache() {
		if ( get_option( 'library_force_update' ) != \KeyDesign\Utils::get_option( 'elementor_default_library' ) ) {
			\KeyDesign\Utils::clear_transient_cache();
		}
		update_option( 'library_force_update', \KeyDesign\Utils::get_option( 'elementor_default_library' ) );
	}

	public function register_locations( $manager ) {
		$manager->register_all_core_location();
	}

	public function load_elementor_styles() {
		\Elementor\Plugin::$instance->frontend->enqueue_styles();
	}

	public function update_default_elementor_kit() {

		if ( ! \KeyDesign\Utils::is_keydesign_theme() ) {
			return;
		}

		add_option( 'default_keydesign_kit', 1 );
		if ( get_option( 'default_keydesign_kit' ) == 1 ) {

			$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();

			if ( ! $kit->get_id() ) {
				return;
			}

			$kit->update_settings( [
				'container_width' => array(
					'size' => "1240",
				),
				'system_colors' => array(
					 0 => array(
						'_id' => 'primary',
						'title' => 'Primary',
						'color' => KEYDESIGN_ELEMENTOR_PRIMARY_COLOR,
					 ),
					 1 => array(
						'_id' => 'secondary',
						'title' => 'Secondary',
						'color' => KEYDESIGN_ELEMENTOR_SECONDARY_COLOR,
					 ),
					 2 => array(
						'_id' => 'text',
						'title' => 'Text',
						'color' => KEYDESIGN_ELEMENTOR_TEXT_COLOR,
					 ),
					 3 => array(
						'_id' => 'accent',
						'title' => 'Accent',
						'color' => KEYDESIGN_ELEMENTOR_ACCENT_COLOR,
					 ),
					 4 => array(
						'_id' => 'light',
						'title' => 'Light Background',
						'color' => KEYDESIGN_ELEMENTOR_LIGHT_COLOR,
					 ),
				),
				'system_typography' => array(
					0 => array(
					   '_id' => 'primary',
					   'title' => 'Primary',
					   'typography_typography' => 'custom',
					   'typography_font_family' => KEYDESIGN_ELEMENTOR_PRIMARY_FONT_FAMILY,
					   'typography_font_weight' => KEYDESIGN_ELEMENTOR_PRIMARY_FONT_WEIGHT,
					),
					1 => array(
						'_id' => 'secondary',
						'title' => 'Secondary',
						'typography_typography' => 'custom',
						'typography_font_family' => KEYDESIGN_ELEMENTOR_SECONDARY_FONT_FAMILY,
						'typography_font_weight' => KEYDESIGN_ELEMENTOR_SECONDARY_FONT_WEIGHT,
					 ),
					 2 => array(
						'_id' => 'text',
						'title' => 'Text',
						'typography_typography' => 'custom',
						'typography_font_family' => KEYDESIGN_ELEMENTOR_TEXT_FONT_FAMILY,
						'typography_font_weight' => KEYDESIGN_ELEMENTOR_TEXT_FONT_WEIGHT,
					 ),
					 3 => array(
						'_id' => 'accent',
						'title' => 'Accent',
						'typography_typography' => 'custom',
						'typography_font_family' => KEYDESIGN_ELEMENTOR_ACCENT_FONT_FAMILY,
						'typography_font_weight' => KEYDESIGN_ELEMENTOR_ACCENT_FONT_WEIGHT,
					 ),
			   ),
			] );

			\Elementor\Plugin::instance()->files_manager->clear_cache();
			update_option( 'default_keydesign_kit', 0 );
		}
	}

	public static function get_site_settings_link() {
		$kit_id = get_option( 'elementor_active_kit' );
		$site_settings_url = '';

		if ( $kit_id ) {
			$site_settings_url = \Elementor\Plugin::$instance->documents->get( $kit_id )->get_edit_url();
		}

		return $site_settings_url;
	}

	public static function elementor_free_styles() {
		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			return;
		}

		wp_enqueue_style(
			'keydesign-elementor-free',
			KEYDESIGN_ASSETS_URL . 'css/keydesign-elementor-free.css',
			[],
			KEYDESIGN_VERSION
		);
	}

	public static function elementor_editor_styles() {
		wp_enqueue_style(
			'keydesign-elementor-styles',
			KEYDESIGN_ASSETS_URL . 'css/keydesign-elementor-editor.css',
			[],
			KEYDESIGN_VERSION
		);
	}

	public static function elementor_performance_actions() {
		if ( is_admin() || current_user_can( 'manage_options' ) ) {
            return;
        }
		wp_dequeue_style( 'elementor-icons' );
	}

	public function check_hide_title( $val ) {
		$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
		if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
			$val = false;
		}

		return $val;
	}

	public function enable_cpt_support() {
		$cpt_support = get_option( 'elementor_cpt_support' );
		if ( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', 'keydesign-portfolio' ];
			update_option( 'elementor_cpt_support', $cpt_support );
		} else if ( ! in_array( 'keydesign-portfolio', $cpt_support ) ) {
			$cpt_support[] = 'keydesign-portfolio';
			update_option( 'elementor_cpt_support', $cpt_support );
		}
	}

	public function remove_dashboard_widgets() {
		remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal' );
	}

	public static function elementor_free_menu() {
		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			return;
		}
		remove_submenu_page( 'elementor', 'e-form-submissions' );
		remove_submenu_page( 'elementor', 'elementor_custom_fonts' );
		remove_submenu_page( 'elementor', 'elementor_custom_icons' );
		remove_submenu_page( 'elementor', 'elementor_custom_custom_code' );
		remove_submenu_page( 'elementor', 'go_elementor_pro' );
	}

	public static function update_experiments_data() {
		// Enable the Container experiment by default
		if ( ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'container' ) ) {
			update_option( 'elementor_experiment-container', 'active' );
		}

		// Disable the Inline Font Icons experiment - Beta Status
		if ( \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_font_icon_svg' ) ) {
			update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
		}
	}

	public static function dismiss_plugin_notices() {
		update_option( 'elementor_tracker_notice', '1' );
	}

}
KeyDesign_Elementor::instance();
