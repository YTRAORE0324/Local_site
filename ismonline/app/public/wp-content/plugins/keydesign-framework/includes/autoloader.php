<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * KeyDesign autoloader.
 *
 * KeyDesign autoloader handler class is responsible for loading the different
 * classes needed to run the plugin.
 */
class Autoloader {

	/**
	 * Classes map.
	 *
	 * Maps KeyDesign classes to file names.
	 *
	 * @access private
	 * @static
	 *
	 * @var array Classes used by KeyDesign Framework.
	 */
	private static $classes_map;

	/**
	 * Default path for autoloader.
	 *
	 * @var string
	 */
	private static $default_path;

	/**
	 * Default namespace for autoloader.
	 *
	 * @var string
	 */
	private static $default_namespace;

	/**
	 * Run autoloader.
	 *
	 * Register a function as `__autoload()` implementation.
	 *
	 * @access public
	 * @static
	 */
	public static function run( $default_path = '', $default_namespace = '' ) {
		if ( '' === $default_path ) {
			$default_path = KEYDESIGN_PATH;
		}

		if ( '' === $default_namespace ) {
			$default_namespace = __NAMESPACE__;
		}

		self::$default_path = $default_path;
		self::$default_namespace = $default_namespace;

 		spl_autoload_register( [ __CLASS__, 'autoload' ] );
 	}

	public static function get_classes_map() {
		if ( ! self::$classes_map ) {
			self::init_classes_map();
		}

		return self::$classes_map;
	}

	private static function init_classes_map() {
		self::$classes_map = [
			'Utils' => 'includes/utils.php',
			'Widgets' => 'includes/widgets.php',
			'Theme_Features' => 'includes/theme-features.php',
			'Performance' => 'includes/performance.php',
			'Admin\Loader' => 'includes/admin/admin-loader.php',
			'Admin\System_Status' => 'includes/admin/system-status.php',
			'License\API' => 'includes/license/api.php',
			'License\Admin' => 'includes/license/admin.php',
			'License\Updater' => 'includes/license/updater.php',
			'Modules\Maintenance_Mode' => 'includes/modules/maintenance-mode/module.php',
			'Modules\Portfolio' => 'includes/modules/portfolio/module.php',
		];
	}

	/**
	 * Normalize Class Name
	 *
	 * Used to convert control names to class names.
	 *
	 * @param $string
	 * @param string $delimiter
	 *
	 * @return mixed
	 */
	private static function normalize_class_name( $string, $delimiter = ' ' ) {
		return ucwords( str_replace( '-', '_', $string ), $delimiter );
	}

	/**
	 * Load class.
	 *
	 * For a given class name, require the class file.
	 *
	 * @access private
	 * @static
	 *
	 * @param string $relative_class_name Class name.
	 */
	private static function load_class( $relative_class_name ) {
		$classes_map = self::get_classes_map();

		if ( isset( $classes_map[ $relative_class_name ] ) ) {
			$filename = self::$default_path . '/' . $classes_map[ $relative_class_name ];
		} else {
			$filename = strtolower(
				preg_replace(
					[ '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$relative_class_name
				)
			);

			$filename = self::$default_path . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {
			require $filename;
		}
	}

	/**
	 * Autoload.
	 *
	 * For a given class, check if it exist and load it.
	 *
	 * @access private
	 * @static
	 *
	 * @param string $class Class name.
	 */
	private static function autoload( $class ) {
		if ( 0 !== strpos( $class, self::$default_namespace . '\\' ) ) {
			return;
		}

		$relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $class );

		$final_class_name = self::$default_namespace . '\\' . $relative_class_name;

		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $relative_class_name );
		}
	}

}
