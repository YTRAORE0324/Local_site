<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {

	public static $instance = null;

	public $utils;
	public $widgets;
	public $theme_features;
	public $performance;
    public $maintenance_mode;
	public $portfolio;
	public $admin_loader;
	public $license_admin;
	public $updater;

    /**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @static
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();

            /**
			 * KeyDesign loaded.
			 *
			 * Fires when KeyDesign was fully loaded and instantiated.
			 */
			do_action( 'keydesign/loaded' );
		}

		return self::$instance;
	}

    /**
	 * Init.
	 *
	 * Initialize KeyDesign Plugin.
	 *
	 * @access public
	 */
    public function init() {
		/**
		 * KeyDesign init.
		 *
		 * Fires when KeyDesign components are initialized.
		 *
		 * After KeyDesign finished loading but before any headers are sent.
		 */

		if ( defined( 'WC_PLUGIN_BASENAME' ) ) {
			require_once KEYDESIGN_PATH . '/includes/compatibility/woocommerce.php';
		}
		
		do_action( 'keydesign/init' );
	}

    /**
	 * Init components.
	 *
	 * Initialize KeyDesign components.
	 *
	 * @access private
	 */
	private function init_components() {
		$this->utils = new Utils();
		$this->widgets = new Widgets();
		$this->theme_features = new Theme_Features();
		$this->performance = new Performance();
        $this->maintenance_mode = new Modules\Maintenance_Mode();
		$this->portfolio = new Modules\Portfolio();

		$this->admin_loader = new Admin\Loader();
		$this->license_admin = new License\Admin();

		if ( is_admin() ) {
			$this->license_admin->register_actions();
			$this->updater = new License\Updater();
		}

		$this->load_plugin_compatibility();
    }

    /**
	 * Register autoloader.
	 *
	 * KeyDesign autoloader loads all the classes needed to run the plugin.
	 *
	 * @access private
	 */
	private function register_autoloader() {
		require_once KEYDESIGN_PATH . '/includes/autoloader.php';

		Autoloader::run();
	}

	/**
	 * Load external libraries
	 *
	 * @access private
	 */
	private function load_dependencies() {
		require_once KEYDESIGN_PATH . '/includes/admin/lib/nuxy/NUXY.php';
		require_once KEYDESIGN_PATH . '/includes/admin/lib/theme-options-init.php';

		require_once KEYDESIGN_PATH . '/includes/admin/lib/ocdi/one-click-demo-import.php';
		require_once KEYDESIGN_PATH . '/includes/admin/lib/demo-import-init.php';
	}

	private function load_plugin_compatibility() {
		require_once KEYDESIGN_PATH . '/includes/compatibility/woocommerce.php';
		require_once KEYDESIGN_PATH . '/includes/compatibility/bbpress.php';
		require_once KEYDESIGN_PATH . '/includes/compatibility/givewp.php';

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
			require_once KEYDESIGN_PATH . '/includes/compatibility/elementor.php';
		}

		require_once KEYDESIGN_PATH . '/includes/compatibility/elementskit-lite.php';

	}

	private function enqueue_assets() {
		wp_enqueue_style(
			'keydesign-frontend',
			KEYDESIGN_ASSETS_URL . 'css/keydesign-framework.css',
			[],
			KEYDESIGN_VERSION
		);

		wp_enqueue_script(
			'keydesign-scripts',
			KEYDESIGN_ASSETS_URL . 'js/keydesign-framework.js',
			[],
			KEYDESIGN_VERSION,
			true
		);

		// Inline styles
        wp_add_inline_style( 'keydesign-frontend', Utils::get_dynamic_styles() );

		// Inline scripts
        if ( '' != Utils::get_option( 'custom_js' ) ) {
            wp_add_inline_script( 'keydesign-scripts', Utils::get_option( 'custom_js' ) );
        }
	}

	private function frontend_performance() {
		// Disable WP Classic Theme Styles
		wp_dequeue_style( 'classic-theme-styles' );
	}

	private function actions() {
		add_action( 'wp_enqueue_scripts', function () {
			$this->enqueue_assets();
		}, 100 );

		add_action( 'wp_enqueue_scripts', function () {
			$this->frontend_performance();
		} );
	}

    /**
	 * Plugin constructor.
	 *
	 * Initializing KeyDesign plugin.
	 *
	 * @access private
	 */
	private function __construct() {
        $this->register_autoloader();
        $this->load_dependencies();
		$this->init_components();

		// Activation, deactivation and uninstall hooks
		Utils::init();

		add_action( 'init', [ $this, 'init' ], 0 );

		$this->actions();
	}
}

Plugin::instance();
