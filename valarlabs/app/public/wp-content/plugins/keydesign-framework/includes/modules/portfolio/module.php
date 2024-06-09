<?php
namespace KeyDesign\Modules;
use KeyDesign\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Portfolio {

	const CPT_SLUG = 'keydesign-portfolio';
	const TAXONOMY_CATEGORY_SLUG = 'keydesign-portfolio-category';

	public function register_data() {

		$labels = [
			'name' => esc_html_x( 'Portfolio', 'Portfolio', 'keydesign-framework' ),
			'singular_name' => esc_html_x( 'Portfolio', 'Portfolio', 'keydesign-framework' ),
			'menu_name' => esc_html_x( 'Portfolio', 'Portfolio', 'keydesign-framework' ),
			'name_admin_bar' => esc_html__( 'Portfolio Item', 'keydesign-framework' ),
			'archives' => esc_html__( 'Portfolio Item Archives', 'keydesign-framework' ),
			'parent_item_colon' => esc_html__( 'Parent Item:', 'keydesign-framework' ),
			'all_items' => esc_html__( 'All Items', 'keydesign-framework' ),
			'add_new_item' => esc_html__( 'Add New Portfolio', 'keydesign-framework' ),
			'add_new' => esc_html__( 'Add New', 'keydesign-framework' ),
			'new_item' => esc_html__( 'New Portfolio', 'keydesign-framework' ),
			'edit_item' => esc_html__( 'Edit Portfolio', 'keydesign-framework' ),
			'update_item' => esc_html__( 'Update Portfolio', 'keydesign-framework' ),
			'view_item' => esc_html__( 'View Portfolio', 'keydesign-framework' ),
			'search_items' => esc_html__( 'Search Portfolios', 'keydesign-framework' ),
			'not_found' => esc_html__( 'Not found', 'keydesign-framework' ),
			'not_found_in_trash' => esc_html__( 'Not found in Trash', 'keydesign-framework' ),
			'featured_image' => esc_html__( 'Featured Image', 'keydesign-framework' ),
			'set_featured_image' => esc_html__( 'Set featured image', 'keydesign-framework' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'keydesign-framework' ),
			'use_featured_image' => esc_html__( 'Use as featured image', 'keydesign-framework' ),
			'insert_into_item' => esc_html__( 'Insert into Portfolio', 'keydesign-framework' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Portfolio', 'keydesign-framework' ),
			'items_list' => esc_html__( 'Items list', 'keydesign-framework' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'keydesign-framework' ),
			'filter_items_list' => esc_html__( 'Filter items list', 'keydesign-framework' ),
		];

		$portfolio_slug = apply_filters( 'keydesign_portfolio_slug', 'portfolio' );

		$rewrite = [
			'slug' => $portfolio_slug,
			'with_front' => false,
		];

		$args = [
			'labels' => $labels,
			'public' => true,
			'menu_position' => 25,
			'menu_icon' => 'dashicons-format-image',
			'capability_type' => 'post',
			'supports' => [ 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields', 'elementor' ],
			'has_archive' => true,
			'rewrite' => $rewrite,
		];

		register_post_type( self::CPT_SLUG, $args );

		// Categories
		$portfolio_category_slug = apply_filters( 'keydesign_portfolio_category_slug', 'portfolio-category' );

		$rewrite = [
			'slug' => $portfolio_category_slug,
			'with_front' => false,
		];

		$args = [
			'hierarchical' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'labels' => $labels,
			'rewrite' => $rewrite,
			'public' => true,
			'labels' => [
				'name' => esc_html_x( 'Categories', 'Portfolio', 'keydesign-framework' ),
				'singular_name' => esc_html_x( 'Category', 'Portfolio', 'keydesign-framework' ),
				'all_items' => esc_html_x( 'All Categories', 'Portfolio', 'keydesign-framework' ),
			],
		];
		register_taxonomy( self::TAXONOMY_CATEGORY_SLUG, self::CPT_SLUG, $args );
	}

	public function __construct() {
		$portfolio_switch = Utils::get_option( 'portfolio_cpt_switch' );
		if ( $portfolio_switch != 'disable' ) {
			add_action( 'init', [ $this, 'register_data' ], 1 );
			require_once KEYDESIGN_MODULES_PATH . '/portfolio/portfolio-functions.php';
		}
	}
}
