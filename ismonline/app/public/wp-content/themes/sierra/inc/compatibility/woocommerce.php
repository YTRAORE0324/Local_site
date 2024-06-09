<?php
/**
 * WooCommerce Compatibility File.
 *
 * @link https://woocommerce.com/
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

if ( ! class_exists( 'KeyDesign_Theme_WooCommerce' ) ) {
	class KeyDesign_Theme_WooCommerce {
		private static $instance;

		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {

			add_action( 'init', [ $this, 'alter_wc_hooks' ] );

			add_action( 'widgets_init', [ $this, 'wc_widgets_init' ], 15 );
			add_filter( 'keydesign_get_sidebar', [ $this, 'set_store_sidebar' ] );

			add_action( 'wp', [ $this, 'shop_remove_actions' ] );
			add_action( 'wp', [ $this, 'wc_sidebar_switch' ] );
			add_action( 'wp', [ $this, 'wc_social_sharing' ] );
			add_filter( 'keydesign_container_class', [ $this, 'wc_shop_classes' ] );
			add_filter( 'woocommerce_show_page_title', '__return_false' );

			add_filter( 'loop_shop_per_page', [ $this, 'loop_products_per_page' ] );
			add_filter( 'loop_shop_columns', [ $this, 'loop_products_per_row' ] );

			add_filter( 'woocommerce_output_related_products_args', [ $this, 'wc_related_products' ] );
			add_filter( 'woocommerce_upsell_display_args', [ $this, 'wc_related_products' ] );

			add_filter( 'woocommerce_cross_sells_columns', [ $this, 'wc_cross_sells_columns' ] );
			add_filter( 'body_class', [ $this, 'wc_cart_body_classes' ] );

			add_filter( 'wp_list_categories', [ $this, 'wc_postcount_filter' ] );
			add_filter( 'woocommerce_layered_nav_count', [ $this, 'wc_layered_nav_filter' ], 10, 3 );
		}

		public static function alter_wc_hooks() {
			require_once KEYDESIGN_THEME_DIR . 'inc/compatibility/woocommerce/markup.php';
		}

		public function wc_widgets_init() {
			register_sidebar(
				apply_filters(
					'keydesign_wc_sidebar',
					array(
						'name' => esc_html__( 'Shop Sidebar', 'sierra' ),
						'id' => 'wc-sidebar',
						'description' => esc_html__( 'This sidebar will be used on Shop and Product Taxonomy pages.', 'sierra' ),
						'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
						'after_widget' => '</section>',
						'before_title' => '<h4 class="widget-title">',
						'after_title' => '</h4>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'keydesign_wc_single_sidebar',
					array(
						'name' => esc_html__( 'Product Sidebar', 'sierra' ),
						'id' => 'wc-single-sidebar',
						'description' => esc_html__( 'This sidebar will be used on Single Product pages.', 'sierra' ),
						'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
						'after_widget' => '</section>',
						'before_title' => '<h4 class="widget-title">',
						'after_title' => '</h4>',
					)
				)
			);
		}

		public function set_store_sidebar( $sidebar ) {

			if ( is_shop() || is_product_taxonomy() ) {
				$sidebar = 'wc-sidebar';
			} elseif ( is_product() ) {
				$sidebar = 'wc-single-sidebar';
			}

			return $sidebar;
		}

		public function wc_sidebar_switch() {
			$shop_sidebar = $product_sidebar = true;
			if ( class_exists( '\KeyDesign\Plugin' ) ) {
				$shop_sidebar = keydesign_get_option( 'woo_sidebar' );
				$product_sidebar = keydesign_get_option( 'woo_single_sidebar' );
			}
			if ( is_shop() || is_product_taxonomy() ) {
				$sidebar_shop_switch = apply_filters( 'keydesign_hook_woo_sidebar', ( $shop_sidebar && is_active_sidebar( 'wc-sidebar' ) ) );
				if ( false == $sidebar_shop_switch ) {
					add_filter( 'keydesign_show_sidebar', '__return_false' );
				}
			}

			if ( is_product() ) {
				$sidebar_single_switch = apply_filters( 'keydesign_hook_woo_single_sidebar', ( $product_sidebar && is_active_sidebar( 'wc-single-sidebar' ) ) );
				if ( false == $sidebar_single_switch ) {
					add_filter( 'keydesign_show_sidebar', '__return_false' );
				}
			}
		}

		public function wc_shop_classes( $classes ) {
			$shop_sidebar = $product_sidebar = true;
			$shop_sidebar_position = $product_sidebar_position = 'sidebar-right';
			$shop_product_style = 'wc-style-detailed';
			$single_product_image_position = 'product-image-left';
			if ( class_exists( '\KeyDesign\Plugin' ) ) {
				$shop_sidebar = keydesign_get_option( 'woo_sidebar' );
				$product_sidebar = keydesign_get_option( 'woo_single_sidebar' );
				
				$shop_sidebar_position = keydesign_get_option( 'woo_sidebar_position' );
				$product_sidebar_position = keydesign_get_option( 'woo_single_sidebar_position' );
				
				$shop_product_style = keydesign_get_option( 'woo_catalog_style' );
				$single_product_image_position = keydesign_get_option( 'woo_single_image_position' );
			}
			if ( is_shop() || is_product_taxonomy() ) {
				$sidebar_shop_switch = apply_filters( 'keydesign_hook_woo_sidebar', ( $shop_sidebar && is_active_sidebar( 'wc-sidebar' ) ) );
				$sidebar_shop_position = apply_filters( 'keydesign_hook_woo_sidebar_position', $shop_sidebar_position );
				$sidebar_shop_sticky = apply_filters( 'keydesign_hook_woo_sidebar_sticky', keydesign_get_option( 'woo_sticky_sidebar' ) );
				// Shop sidebar position class
				if ( true == $sidebar_shop_switch ) {
					$classes[] = 'with-sidebar';
					$classes[] = $sidebar_shop_position;
					if ( $sidebar_shop_sticky ) {
						$classes[] = 'sticky-sidebar';
					}
				}
			}

			if ( is_product() ) {
				$sidebar_single_switch = apply_filters( 'keydesign_hook_woo_single_sidebar', ( $product_sidebar && is_active_sidebar( 'wc-single-sidebar' ) ) );
				$sidebar_single_position = apply_filters( 'keydesign_hook_woo_single_sidebar_position', $product_sidebar_position );
				$sidebar_single_sticky = apply_filters( 'keydesign_hook_woo_single_sidebar_sticky', keydesign_get_option( 'woo_single_sticky_sidebar' ) );
				// Single product sidebar position class
				if ( true == $sidebar_single_switch ) {
					$classes[] = 'with-sidebar';
					$classes[] = $sidebar_single_position;
					if ( $sidebar_single_sticky ) {
						$classes[] = 'sticky-sidebar';
					}
				}
				// Product image position class
				$classes[] = apply_filters( 'keydesign_hook_woo_single_image_position', $single_product_image_position );
			}

			// Product box style class
			if ( keydesign_is_woocommerce_page() ) {
				$catalog_style = apply_filters( 'keydesign_hook_woo_catalog_style', $shop_product_style );
				$classes[] = $catalog_style;
			}

			return $classes;
		}

		public function shop_remove_actions() {
			if ( is_shop() ) {
				remove_action( 'keydesign_page_header_content', 'keydesign_page_header_description', 10 );
			}
			if ( is_product() ) {
				remove_action( 'keydesign_content_top', 'keydesign_display_page_title' );
			}
		}

		public function loop_products_per_page( $product_number ) {
			$product_number = apply_filters( 'keydesign_hook_woo_products_number', keydesign_get_option( 'woo_products_number' ) );
			return $product_number;
		}

		public function loop_products_per_row() {
			$shop_columns = 3;
			if ( class_exists( '\KeyDesign\Plugin' ) ) {
				$shop_columns = keydesign_get_option( 'woo_shop_columns' );
			}
			$cols = apply_filters( 'keydesign_hook_woo_shop_columns', $shop_columns );
			return $cols;
		}

		public function wc_related_products( $args ) {
			$related_number = keydesign_get_option( 'woo_single_related_number' );
			if ( $related_number == '' ) {
				$related_number = 4;
			}
			$args['posts_per_page'] = $related_number;
			$args['columns'] = $related_number;
			return $args;
		}

		public function wc_cross_sells_columns( $columns ) {
			return 4;
		}

		public static function get_social_sharing_markup() {
			include_once KEYDESIGN_PATH . 'includes/theme-features/social-sharing.php';
		}

		public function wc_social_sharing() {
			if ( is_product() ) {
				if ( keydesign_get_option( 'woo_single_social' ) ) {
					add_action( 'woocommerce_before_main_content', [ $this, 'get_social_sharing_markup' ], 20 );
				}
			}
		}

		// Add .woocommerce body class on cart page - used for cross-sells box design
		public function wc_cart_body_classes( $classes ) {
			$classes[] = '';
			if ( is_cart() ) {
				$classes[] = 'woocommerce';
			}

			return $classes;
		}

		public function wc_postcount_filter( $variable ) {
			$variable = str_replace('(', '<span class="post_count"> ', $variable);
			$variable = str_replace(')', ' </span>', $variable);
			return $variable;
		}

		public function wc_layered_nav_filter( $string, $count, $term ) {
			$string = '<span class="count">' . absint( $count ) . '</span>';
			return $string;
		}
	}
}
KeyDesign_Theme_WooCommerce::instance();