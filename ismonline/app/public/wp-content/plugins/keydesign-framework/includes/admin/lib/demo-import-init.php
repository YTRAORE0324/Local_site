<?php
namespace KeyDesign;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Demo_Import {

    public static $instance = null;
    public $import_demo_files;
    public $config_after_import;
    public $before_widgets_import;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function __construct() {
		add_filter( 'pt-ocdi/import_files', array( $this, 'import_demo_files' ) );
        add_action( 'pt-ocdi/after_import', array( $this, 'config_after_import' ) );
        add_action( 'pt-ocdi/before_widgets_import', array( $this, 'before_widgets_import' ) );

        // Disable thumbnail regenerate during the content import
        add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

        // Disable OCDI branding
        add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}

    public function import_demo_files() {
        $demos_array = array();
        if( function_exists( 'keydesign_demo_content' ) ) {
            $keydesign_demo = keydesign_demo_content();
            foreach ( $keydesign_demo as $value ) {

                $import_inner_pages = true; // Default is to import inner pages
				if ( isset( $value[ 'disable_inner_pages' ] ) && $value[ 'disable_inner_pages' ] ) {
					$import_inner_pages = false; // Set to false to disable inner pages import
				}

                $demos_array[ $value[ 'id' ] ] = array (
                    'import_file_name' => $value[ 'name' ],
                    'categories' => array( 'Demos' ),
                    'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/demos/' . $value[ 'file' ] . '/' . $value[ 'file' ] . '.xml',
                    'local_import_innerpages_file' => $import_inner_pages ? trailingslashit(get_template_directory()) . 'inc/demo-import/demos/general/website-content.xml' : '',
                    'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/demos/general/widgets.wie',
                    'local_import_redux' => array(
                        array(
                            'file_path' => trailingslashit( get_template_directory() ) . 'inc/demo-import/demos/' . $value[ 'file' ] . '/' . $value[ 'file' ] . '.json',
                            'option_name' => 'keydesign_options',
                        ),
                    ),
                    'import_preview_image_url' => trailingslashit( get_template_directory_uri() ) . 'inc/demo-import/screenshots/' . $value[ 'file' ] . '.jpg',
                    'preview_url' => $value[ 'preview' ],
                );
            }
        }
        return $demos_array;
    }

    // Automatically assign "Front page", "Posts page" and menu locations after the importer is done
    // Assign the demo Default Kit for Elementor
    public function config_after_import( $selected_import ) {

        // Set Default Kit
		$kit_name = $selected_import['import_file_name']. ' Kit';
		$kit_page_array = get_posts([
			'title' => $kit_name,
			'post_type' => 'elementor_library',
		]);
		$kit_page_id = $kit_page_array[0];
		$kit_id = $kit_page_id->ID;
		update_option( 'elementor_active_kit', $kit_id );

        if ( isset( $selected_import['categories'] ) && $selected_import['categories'] != '' ) {
            $import_categories = $selected_import['categories'];
        }

        if ( in_array( "Demos", $import_categories ) ) {
        	// Assign main menu
        	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

            set_theme_mod( 'nav_menu_locations',
                array(
                    'header-menu' => $main_menu->term_id,
        		)
            );

            // Assign front page and posts page
            $front_page_name = 'Home ' . $selected_import['import_file_name'];
            $front_page_array = get_posts([
				'title' => $front_page_name,
				'post_type' => 'any',
			]);
			$front_page = $front_page_array[0];
			$front_page_id = $front_page->ID;

			$blog_page_array = get_posts([
				'title' => 'Blog',
				'post_type' => 'any',
			]);
			$blog_page = $blog_page_array[0];
			$blog_page_id = $blog_page->ID;

        	update_option( 'show_on_front', 'page' );
        	update_option( 'page_on_front', $front_page_id );
        	update_option( 'page_for_posts', $blog_page_id );

            // Set permalink structure
            global $wp_rewrite;
        	$wp_rewrite->set_permalink_structure( '/%postname%/' );
            flush_rewrite_rules();
        }
    }

    // Remove default widgets on demo import
    public function before_widgets_import( $selected_import ) {
        update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array() ) );
    }

}

Demo_Import::instance();
