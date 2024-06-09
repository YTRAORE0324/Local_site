<?php
namespace KeyDesign\Compatibility;

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ElementsKit_Lite' ) ) {
	return;
}

class KeyDesign_ElementsKit_Lite {

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {

		// Header builder markup
		add_action( 'elementskit/template/before_header', [ $this, 'header_builder_before_header_markup' ] );
		add_action( 'elementskit/template/after_header', [ $this, 'header_builder_after_header_markup' ] );

		// Footer builder markup
		add_action( 'elementskit/template/before_footer', [ $this, 'footer_builder_before_footer_markup' ] );
		add_action( 'elementskit/template/after_footer', [ $this, 'footer_builder_after_footer_markup' ] );

		// Admin menu actions
		add_action( 'admin_menu', [ $this, 'admin_menu_actions' ], -1 );

		// Remove dashboard widgets
		add_action( 'wp_dashboard_setup', [ $this, 'remove_dashboard_widgets' ] );

		// Set onboarding status
		add_action( 'init', [ $this, 'onboarded_status' ] );

		// Dismiss banners
		add_filter( 'elementskit/license/hide_banner', '__return_true' );

		// Overwrite widget controls
		require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementskit/widget-controls.php';

		// Update ElementsKit Google Map API key
		$this->update_elementskit_google_api();

	}

	public function header_builder_before_header_markup() {
		echo '<div id="page" class="site"><header id="site-header" ' . keydesign_site_header_class( '' , $echo = false ) . '><div class="site-header-wrapper">';
	}

	public function header_builder_after_header_markup() {
		echo '</div></header>
			<div id="content" class="site-content">';
			do_action( 'keydesign_content_top' );
	}

	public function footer_builder_before_footer_markup() {
		do_action( 'keydesign_content_bottom' );
		echo '</div><!-- #content -->';
		do_action( 'keydesign_content_after' );
		do_action( 'keydesign_footer_before' );
		echo '<footer id="site-footer" ' . keydesign_site_footer_class( '' , $echo = false ) . ' role="contentinfo">';
		do_action( 'keydesign_footer_top' );
	}

	public function footer_builder_after_footer_markup() {
		do_action( 'keydesign_footer_bottom' );
		echo '</footer>';
		do_action( 'keydesign_footer_after' );
		echo '</div><!-- #page -->';
		do_action( 'keydesign_body_bottom' );
	}

	public function admin_menu_actions() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		add_menu_page(
			__( 'Headers', 'keydesign-framework' ),
			__( 'Headers', 'keydesign-framework' ),
			'manage_options',
			'edit.php?post_type=elementskit_template&elementskit_type_filter=header',
			'',
			'dashicons-align-center',
			30
		);

		add_menu_page(
			__( 'Footers', 'keydesign-framework' ),
			__( 'Footers', 'keydesign-framework' ),
			'manage_options',
			'edit.php?post_type=elementskit_template&elementskit_type_filter=footer',
			'',
			'dashicons-align-center',
			35
		);
	}

	public function remove_dashboard_widgets() {
		remove_meta_box( 'wpmet-stories', 'dashboard', 'normal' );
	}

	public function onboarded_status() {

		add_option('default_ekit_settings', 1);
		if ( get_option('default_ekit_settings') == 1 ) {

			update_option( 'elements_kit_onboard_status', 'onboarded' );

			$elemkit_options = get_option( 'elementskit_options' );

			if ( !isset( $elemkit_options ) || !is_array( $elemkit_options ) ) {
				$elemkit_options = array();
			}

			$elemkit_options[ 'module_list' ][ 'elementskit-icon-pack' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'header-footer' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'megamenu' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'onepage-scroll' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'sticky-content' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'copy-paste-cross-domain' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'advanced-tooltip' ][ 'status' ] = 'active';
			$elemkit_options[ 'module_list' ][ 'masking' ][ 'status' ] = 'active';

			$elemkit_options[ 'module_list' ][ 'widget-builder' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'facebook-messenger' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'conditional-content' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'pro-form-reset-button' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'google_sheet_for_elementor_pro_form' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'particles' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'module_list' ][ 'parallax' ][ 'status' ] = 'active';

			$elemkit_options[ 'widget_list' ][ 'drop-caps' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'dual-button' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'tablepress' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'back-to-top' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'advanced-accordion' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'chart' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'table' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'unfold' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'whatsapp' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'team-slider' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'flip-box' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'content-ticker' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'coupon-code' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'category-list' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'post-grid' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'post-tab' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'vertical-menu' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'caldera-forms' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'we-forms' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'wp-forms' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'ninja-forms' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'fluent-forms' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'twitter-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'instagram-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'behance-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'dribble-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'facebook-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'pinterest-feed' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'zoom' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'facebook-review' ][ 'status' ] = 'inactive';
			$elemkit_options[ 'widget_list' ][ 'yelp' ][ 'status' ] = 'inactive';

			update_option( 'elementskit_options', $elemkit_options );
			update_option('default_ekit_settings', 0);
		}

		// echo "<pre style='margin-left: 160px'>"; var_dump(get_option( 'elementskit_options' )); echo "</pre>";
	}

	public static function update_elementskit_google_api() {
		$api_code = Utils::get_option( 'google_maps_api' );

		if ( '' == $api_code ) {
			return;
		}

		$elemkit_options = get_option( 'elementskit_options' );

		if ( $elemkit_options[ 'user_data' ][ 'google_map' ][ 'api_key' ] != $api_code ) {
			$elemkit_options[ 'user_data' ][ 'google_map' ][ 'api_key' ] = $api_code;
			update_option( 'elementskit_options', $elemkit_options );
		}
	}
}
KeyDesign_ElementsKit_Lite::instance();
