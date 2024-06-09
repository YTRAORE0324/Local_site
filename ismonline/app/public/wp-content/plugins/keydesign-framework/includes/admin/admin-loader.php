<?php
namespace KeyDesign\Admin;

use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Loader {
    public function __construct() {

		add_action( 'admin_menu', [ $this, 'register_admin_menu' ], -1 );
        add_action( 'admin_bar_menu', [ $this, 'register_admin_bar_menu' ], 99 );

		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_styles' ] );
    }

	public static function admin_enqueue_styles() {

		$current_screen = get_current_screen();

		wp_enqueue_style(
			'keydesign-admin',
			KEYDESIGN_ASSETS_URL . 'css/keydesign-admin.css',
			[],
			KEYDESIGN_VERSION
		);

		if ( strpos( $current_screen->base, 'theme-options' ) === false ) {
        	return;
    	} else {
			wp_enqueue_style(
				'keydesign-admin-theme-options',
				KEYDESIGN_ASSETS_URL . 'css/keydesign-admin-theme-options.css',
				[],
				KEYDESIGN_VERSION
			);
		}
	}

	private function check_permissions() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die(
				esc_html(__('You do not have sufficient permissions to access this page.', 'keydesign-framework'))
			);
		}
	}

    private function render_page_template( $template ) {
        $this->check_permissions();
        require_once KEYDESIGN_PATH . 'includes/admin/views/' . $template . '-view.php';
    }

	public function dashboard_page_template() {
		$this->render_page_template( 'dashboard' );
	}

	public function system_status_page_template() {
		$this->render_page_template( 'system-status' );
	}

	public function help_page_template() {
		$this->render_page_template( 'help' );
	}

    public function register_admin_menu() {
		if ( ! \KeyDesign\Utils::is_keydesign_theme() ) {
			return;
		}

		$capability = 'manage_options';
		$parent_menu_item = 'keydesign-dashboard';

		if ( ! current_user_can( $capability ) ) {
			return;
		}

        add_menu_page(
            __( 'KeyDesign Dashboard', 'keydesign-framework' ),
            __( 'KeyDesign', 'keydesign-framework' ),
            $capability,
            $parent_menu_item,
            '',
            'none',
            2
        );

        add_submenu_page(
            $parent_menu_item,
            __( 'KeyDesign Dashboard', 'keydesign-framework' ),
            __( 'Dashboard', 'keydesign-framework' ),
            $capability,
            $parent_menu_item,
            [ $this, 'dashboard_page_template' ],
            0
        );

		add_submenu_page(
            $parent_menu_item,
            __( 'System Status', 'keydesign-framework' ),
            __( 'System Status', 'keydesign-framework' ),
            $capability,
            'keydesign-system-status',
            [ $this, 'system_status_page_template' ],
            10
        );

		add_submenu_page(
            $parent_menu_item,
            __( 'Help', 'keydesign-framework' ),
            __( 'Help', 'keydesign-framework' ),
            $capability,
            'keydesign-help',
            [ $this, 'help_page_template' ],
            15
        );
    }

    public static function register_admin_bar_menu( $wp_admin_bar ) {

		if ( ! current_user_can( 'edit_theme_options' ) ) {
		    return;
		}
		$parent_menu_item = 'keydesign-dashboard';

		$args = [
			'id'    => $parent_menu_item,
			'title' => Utils::get_parent_theme_name(),
			'href'  => admin_url( 'admin.php?page=keydesign-dashboard' ),
		];
		$wp_admin_bar->add_node( $args );

		$args = [
			'id' => 'keydesign-admin',
			'title' => esc_html__( 'Dashboard', 'keydesign-framework' ),
			'href' => admin_url( 'admin.php?page=keydesign-dashboard' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );

		$args = [
			'id' => 'theme-options',
			'title' => esc_html__( 'Theme Options', 'viva-addon' ),
			'href' => admin_url( 'admin.php?page=theme-options' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
			$args = [
				'id' => 'keydesign-site-settings',
				'title' => esc_html__( 'Site Settings', 'keydesign-framework' ),
				'href' => \KeyDesign\Compatibility\KeyDesign_Elementor::get_site_settings_link(),
				'parent' => $parent_menu_item,
			];
			$wp_admin_bar->add_node( $args );
		}

		$args = [
			'id' => 'install-required-plugins',
			'title' => 'Plugins',
			'href' => admin_url( 'admin.php?page=install-required-plugins' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );

    	$args = [
			'id' => 'import-demos',
			'title' => esc_html__( 'Starter Sites', 'keydesign-framework' ),
			'href' => admin_url( 'admin.php?page=import-demos' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );

		$args = [
			'id' => 'keydesign-system-status',
			'title' => esc_html__( 'System Status', 'keydesign-framework' ),
			'href' => admin_url( 'admin.php?page=keydesign-system-status' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );

		$args = [
			'id' => 'keydesign-help',
			'title' => esc_html__( 'Help', 'keydesign-framework' ),
			'href' => admin_url( 'admin.php?page=keydesign-help' ),
			'parent' => $parent_menu_item,
		];
		$wp_admin_bar->add_node( $args );
	}
}
