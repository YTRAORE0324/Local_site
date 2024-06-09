<?php
namespace KeyDesign\Compatibility;

use Give\Helpers\Form\Utils as FormUtils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Give' ) ) {
	return;
}

class KeyDesign_Give {
	
	private static $instance;
	
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function __construct() {

		add_action( 'wp', [ $this, 'givewp_single_template_actions' ] );
		add_action( 'wp', [ $this, 'give_social_sharing' ] );
		add_filter( 'keydesign_container_class', [ $this, 'give_container_classes' ] );
		add_filter( 'template_include', [ $this, 'give_single_template' ], 11 );
		add_filter( 'body_class', [ $this, 'single_page_body_class' ] );
		add_filter( 'keydesign_get_sidebar', [ $this, 'set_give_sidebar' ] );
		add_filter( 'give_forms_single_sidebar', [ $this, 'custom_give_forms_single_sidebar' ] );
		add_action( 'give_single_form_summary', [ $this, 'give_single_featured_image' ], 1 );
		
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style(
				'keydesign-givewp',
				KEYDESIGN_ASSETS_URL . 'css/keydesign-givewp.css',
				[],
				KEYDESIGN_VERSION
			);
		}, 120 );
		
	}

	public function give_container_classes( $classes ) {
		if ( ! FormUtils::isV3Form( get_the_ID() ) ) {
			$give_single_sidebar = true;
			$give_single_sidebar_position = 'sidebar-right';
			if ( is_single() && get_post_type() == 'give_forms' ) {
				$sidebar_single_switch = apply_filters( 'keydesign_hook_give_single_sidebar', ( $give_single_sidebar && is_active_sidebar( 'give-forms-sidebar' ) ) );
				if ( true == $sidebar_single_switch ) {
					$classes[] = 'with-sidebar';
					$classes[] = $give_single_sidebar_position;
				}
			}
		}
		return $classes;
	}

	public function give_single_template( $template ) {
		if ( is_single() && get_post_type() == 'give_forms' ) {
			$single_template = KEYDESIGN_COMPATIBILITY_PATH . '/givewp/single-give-form.php';
			if ( file_exists( $single_template ) ) {
				return $single_template;
			}
		}
		return $template;
	}
	
	public function givewp_single_template_actions() {
		if ( FormUtils::isV3Form( get_the_ID() ) ) {
            return;
        }

		if ( is_single() && get_post_type() == 'give_forms' ) {
			remove_action( 'keydesign_content_top', 'keydesign_display_page_title' );
		}
	}

	public function single_page_body_class( $classes ) {
		if ( is_give_form() && FormUtils::isV3Form( get_the_ID() ) ) {
			return array_merge( $classes, array( 'give-builder-forms' ) );
		}
	}

	public function set_give_sidebar( $sidebar ) {
		if ( is_single() && get_post_type() == 'give_forms' ) {
			$sidebar = 'give-forms-sidebar';
		}
		return $sidebar;
	}

	public function custom_give_forms_single_sidebar( $args ) {
		$args['before_widget'] = '<section id="%1$s" class="widget keydesign-widget %2$s">';
		$args['after_widget'] = '</section>';
		$args['before_title'] = '<h4 class="widget-title">';
		$args['after_title'] = '</h4>';
		return $args;
	}

	public static function get_social_sharing_markup() {
		include_once KEYDESIGN_PATH . 'includes/theme-features/social-sharing.php';
	}

	public function give_social_sharing() {
		if ( is_single() && get_post_type() == 'give_forms' ) {
			add_action( 'give_before_single_form', [ $this, 'get_social_sharing_markup' ], 20 );
		}
	}

	public function give_single_featured_image() {
		give_get_template_part( 'single-give-form/featured-image' );
	}
	
}
KeyDesign_Give::instance();