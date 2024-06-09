<?php
/**
 * Template functions.
 */

defined( 'ABSPATH' ) || exit;

function keydesign_container_top_markup() {
	if ( is_page() && is_elementor_page() ) {
		return;
	}

	echo '<div ';
		keydesign_container_class();
	echo '>';

}

function keydesign_container_bottom_markup() {
	if ( is_page() && is_elementor_page() ) {
		return;
	}

	echo '</div>';

}

// Add container markup
add_action( 'keydesign_content_top', 'keydesign_container_top_markup', 20 );
add_action( 'keydesign_content_bottom', 'keydesign_container_bottom_markup' );

/**
 * Displays the class names for the .page-header element.
 */
if ( ! function_exists( 'keydesign_page_header_class' ) ) {
	function keydesign_page_header_class( $class = '' ) {
		echo 'class="' . esc_attr( implode( ' ', keydesign_get_page_header_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieves an array of the class names for the .page-header element.
 */
if ( ! function_exists( 'keydesign_get_page_header_class' ) ) {
	function keydesign_get_page_header_class( $class = '' ) {
		// Get theme options data
		$text_align = keydesign_get_option( 'title_bar_text_alignment' );

		// Start classes build
		$classes = array();

		$classes[] = 'page-header';

		// Text alignment class
		$classes[] = apply_filters( 'keydesign_hook_page_header_text_alignment', $text_align );

		// Breadcrumbs position class
		$classes[] = keydesign_get_option( 'title_bar_breadcrumbs_position' );

		// Background color class
		$classes[] = keydesign_get_option( 'title_bar_background_color' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'keydesign_page_header_class', $classes, $class );

		return array_unique( $classes );
	}
}

/**
 * Displays the class names for the .site-footer element.
 */
if ( ! function_exists( 'keydesign_site_footer_class' ) ) {
	function keydesign_site_footer_class( $class = '', $echo = true ) {
		$output_escaped = 'class="' . esc_attr( implode( ' ', keydesign_get_site_footer_class( $class ) ) ) . '"';

		if ( $echo ) {
			echo "" . $output_escaped;
		} else {
			return $output_escaped;
		}
	}
}

/**
 * Retrieves an array of the class names for the .site-footer element.
 */
if ( ! function_exists( 'keydesign_get_site_footer_class' ) ) {
	function keydesign_get_site_footer_class( $class = '' ) {
		// Get theme options data
		$text_align = keydesign_get_option( 'title_bar_text_alignment' );

		// Start classes build
		$classes = array();

		$classes[] = 'site-footer';

		// Footer position class
		$classes[] = keydesign_get_option( 'footer_position' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'keydesign_site_footer_class', $classes, $class );

		return array_unique( $classes );
	}
}

/**
 * Displays the class names for the .site-header element.
 */
if ( ! function_exists( 'keydesign_site_header_class' ) ) {
	function keydesign_site_header_class( $class = '', $echo = true ) {
		$output_escaped = 'class="' . esc_attr( implode( ' ', keydesign_get_site_header_class( $class ) ) ) . '"';

		if ( $echo ) {
			echo "" . $output_escaped;
		} else {
			return $output_escaped;
		}
	}
}

/**
 * Retrieves an array of the class names for the .site-header element.
 */
if ( ! function_exists( 'keydesign_get_site_header_class' ) ) {
	function keydesign_get_site_header_class( $class = '' ) {

		$classes = array();

		$classes[] = 'site-header';

		// Site header position
		if ( function_exists( 'keydesign_get_option' ) ) {
			$classes[] = keydesign_get_option( 'site_header_position' );

			if ( keydesign_get_option( 'site_header_scroll_up' ) ) {
				$classes[] = 'show-on-scroll';
			}
		}

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'keydesign_site_header_class', $classes, $class );

		return array_unique( $classes );
	}
}

/**
 * Displays the class names for the .keydesign-container element.
 */
if ( ! function_exists( 'keydesign_container_class' ) ) {
	function keydesign_container_class( $class = '' ) {
		echo 'class="' . esc_attr( implode( ' ', keydesign_get_container_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieves an array of the class names for the .keydesign-container element.
 */
if ( ! function_exists( 'keydesign_get_container_class' ) ) {
	function keydesign_get_container_class( $class = '' ) {

		$classes = array();

		$classes[] = 'keydesign-container';
		$classes[] = 'e-con';

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'keydesign_container_class', $classes, $class );

		return array_unique( $classes );
	}
}

if ( ! function_exists( 'keydesign_body_classes' ) ) {
	function keydesign_body_classes( $classes ) {
		$classes[] = '';

		return $classes;
	}
}
add_filter( 'body_class', 'keydesign_body_classes' );

/**
 * Displays the class names for the #primary element.
 */
if ( ! function_exists( 'keydesign_primary_class' ) ) {
	function keydesign_primary_class( $class = '' ) {
		echo 'class="' . esc_attr( implode( ' ', keydesign_get_primary_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieves an array of the class names for the #primary element.
 */
if ( ! function_exists( 'keydesign_get_primary_class' ) ) {
	function keydesign_get_primary_class( $class = '' ) {

		$classes = array();

		$classes[] = 'content-area';

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'keydesign_primary_class', $classes, $class );

		return array_unique( $classes );
	}
}

// Header markup
function site_header_markup() {
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		get_template_part( 'template-parts/header/site-header' );
	}
}
add_action( 'keydesign_header', 'site_header_markup' );


// Page Title
function keydesign_display_page_title() {
	get_template_part( 'template-parts/header/page-header' );
}
add_action( 'keydesign_content_top', 'keydesign_display_page_title' );

// Remove page title on specific pages
function keydesign_remove_page_title() {
	if ( is_404() || is_singular( 'post' ) ) {
		remove_action( 'keydesign_content_top', 'keydesign_display_page_title' );
	}
}
add_action( 'wp', 'keydesign_remove_page_title' );

// Page Header Markup
function keydesign_page_header_title() {
	if ( is_singular() ) {
		$title = get_the_title();
	} else {
		if ( is_front_page() && is_home() ) {
			// Default homepage.
			$title = apply_filters( 'keydesign_home_page_title', esc_html__( 'Home', 'sierra' ) );
		} elseif ( is_home() ) {
			// Blog page.
			$title = apply_filters( 'keydesign_blog_page_title', get_the_title( get_option( 'page_for_posts', true ) ) );
		} elseif ( is_404() ) {
			// for 404 page - title always display.
			$title = apply_filters( 'keydesign_404_page_title', esc_html__( 'This page doesn\'t seem to exist.', 'sierra' ) );

			// for search page - title always display.
		} elseif ( is_search() ) {

			$title = apply_filters( 'keydesign_search_page_title', sprintf( __( 'Search results for: %s', 'sierra' ), '<span>' . get_search_query() . '</span>' ) );

		} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$title = woocommerce_page_title( false );

		} elseif ( is_archive() ) {

			$title = get_the_archive_title();

		}
	}
?>
<h1 class="entry-title"><?php echo wp_kses_post( $title ); ?></h1>
<?php }
add_action( 'keydesign_page_header_content', 'keydesign_page_header_title', 5 );

function keydesign_page_header_description() {
	if ( is_archive() ) {
		echo wp_kses_post( wpautop( get_the_archive_description() ) );
	}
}
add_action( 'keydesign_page_header_content', 'keydesign_page_header_description', 10 );

function keydesign_page_header_breadcrumbs() {
	$breacrumbs_switch = true;
	if ( class_exists( '\KeyDesign\Plugin' ) ) {
		$breacrumbs_switch = keydesign_get_option( 'title_bar_breadcrumbs' );
	}
	if ( $breacrumbs_switch == true ) {
		breadcrumb_trail();
	} 
}
add_action( 'keydesign_page_header_content', 'keydesign_page_header_breadcrumbs', 15 );

// Footer markup
function footer_markup() {
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		get_template_part( 'template-parts/footer/site-footer' );
	}
}
add_action( 'keydesign_footer', 'footer_markup' );

// Page and post loop
function loop_markup( $page_content = false ) {
	?>
	<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) {
			keydesign_content_while_before();
			while ( have_posts() ) {
				the_post();

				if ( true === $page_content ) {
					do_action( 'keydesign_template_parts_content_page' );
				} else {
					do_action( 'keydesign_template_parts_content' );
				}

			}
			keydesign_content_while_after();
		} else {
			do_action( 'keydesign_template_parts_content_none' );
		}
		?>
	</main><!-- #main -->
	<?php
}
add_action( 'keydesign_content_loop', 'loop_markup' );
add_action( 'keydesign_content_single', 'loop_markup' );

function page_markup() {
	loop_markup( true );
}
add_action( 'keydesign_content_page', 'page_markup' );

function template_parts_content_page() {
	get_template_part( 'template-parts/content', 'page' );
}
add_action( 'keydesign_template_parts_content_page', 'template_parts_content_page' );

function template_parts_post() {
	if ( is_single() ) {
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
			get_template_part( 'template-parts/content', 'single' );
		}
	}
}
add_action( 'keydesign_template_parts_content', 'template_parts_post' );

function template_parts_search() {
	if ( is_search() ) {
		get_template_part( 'template-parts/content', 'blog' );
	}
}
add_action( 'keydesign_template_parts_content', 'template_parts_search' );

function template_parts_content() {
	if ( ! is_page() && ! is_single() && ! is_search() && ! is_404() ) {
		if ( ( is_home() ) || is_archive() ) {
			get_template_part( 'template-parts/content', 'blog' );
		} else {
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}
add_action( 'keydesign_template_parts_content', 'template_parts_content' );

function template_parts_none() {
	if ( is_archive() || is_search() ) {
		get_template_part( 'template-parts/content', 'none' );
	}
}
add_action( 'keydesign_template_parts_content_none', 'template_parts_none' );

function template_parts_404() {
	if ( is_404() ) {
		get_template_part( 'template-parts/content', '404' );
	}
}
add_action( 'keydesign_content_404_page', 'template_parts_404' );
add_action( 'keydesign_template_parts_content_none', 'template_parts_404' );

// Load page template structure on CPT
function keydesign_single_template_actions() {
	$post_type = get_post_type();
    if ( $post_type != 'post' && is_single() ) {

        /* Hide single post title */
        add_filter( 'keydesign_blog_single_show_page_title', '__return_false' );

        /* Remove htumbnail image */
        remove_action( 'keydesign_single_entry_content_top', 'keydesign_blog_featured_item', 20 );

        /* Hide post meta */
        remove_action( 'keydesign_single_entry_content_top', 'keydesign_display_post_meta', 15 );

        /* Hide post navigation */
        remove_action( 'keydesign_single_entry_content_bottom', 'keydesign_single_post_navigation', 20 );

		/* Hide comments */
		remove_action( 'keydesign_single_entry_content_bottom', 'keydesign_single_post_comments', 25 );
    }
}
add_action( 'wp', 'keydesign_single_template_actions' );

function keydesign_archive_template_actions() {
	$post_type = get_post_type();
    if ( $post_type != 'post' && is_archive() ) {

		/* Remove post meta */
		remove_action( 'keydesign_entry_wrapper_top', 'keydesign_display_post_meta', 15 );
    }
}
add_action( 'wp', 'keydesign_archive_template_actions' );
