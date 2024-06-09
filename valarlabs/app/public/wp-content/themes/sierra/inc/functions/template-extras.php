<?php
/**
 * Blog Helper Functions
 *
 * @package Astra
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'keydesign_blog_body_classes' ) ) {
	function keydesign_blog_body_classes( $classes ) {
		$classes[] = '';

		// Single blog post layout class
        if ( is_singular( 'post' ) ) {
            $blog_single_layout = apply_filters( 'keydesign_hook_blog_single_layout', keydesign_get_option( 'blog_single_layout' ) );
    		$classes[] = $blog_single_layout;
        }

		return $classes;
	}
}

add_filter( 'body_class', 'keydesign_blog_body_classes' );

// Center align page title if sidebar is disabled
if ( ! function_exists( 'keydesign_blog_no_sidebar' ) ) {
	function keydesign_blog_no_sidebar( $classes ) {
		$blog_sidebar = apply_filters( 'keydesign_hook_blog_sidebar', keydesign_get_option( 'blog_sidebar' ) );

		if ( false == $blog_sidebar ) {
			$classes = 'title-bar-text-center';
		}

		return $classes;
	}
}

add_filter( 'keydesign_hook_page_header_text_alignment', 'keydesign_blog_no_sidebar' );

if ( ! function_exists( 'keydesign_blog_classes' ) ) {
	function keydesign_blog_classes( $classes ) {
		$blog_layout = 'blog-layout-classic';
		$sidebar_display = $single_sidebar = true;
		$sidebar_position = $single_sidebar_position = 'sidebar-right';
		
		if ( class_exists( '\KeyDesign\Plugin' ) ) {
			$blog_layout = keydesign_get_option( 'blog_article_layout' );
			$sidebar_display = keydesign_get_option( 'blog_sidebar' );
			$sidebar_position = keydesign_get_option( 'blog_sidebar_position' );
			
			$single_sidebar = keydesign_get_option( 'blog_single_sidebar' );
			$single_sidebar_position = keydesign_get_option( 'blog_single_sidebar_position' );
		}
			
			
		if ( keydesign_is_blog_archive() ) {
			$article_layout = apply_filters( 'keydesign_hook_blog_article_layout', $blog_layout );
			$blog_sidebar = apply_filters( 'keydesign_hook_blog_sidebar', $sidebar_display );
			$blog_sidebar_position = apply_filters( 'keydesign_hook_blog_sidebar_position', $sidebar_position );
			$blog_sticky_sidebar = apply_filters( 'keydesign_hook_blog_sticky_sidebar', keydesign_get_option( 'blog_sticky_sidebar' ) );

			$classes[] = 'blog-content-area';
			$classes[] = $article_layout;

			if ( true == $blog_sidebar ) {
				$classes[] = 'with-sidebar';
				$classes[] = $blog_sidebar_position;

				if ( $blog_sticky_sidebar ) {
					$classes[] = 'sticky-sidebar';
				}
			} else {
				$classes[] = 'no-sidebar';
			}
		}

		if ( is_singular( 'post' ) ) {
			$blog_single_sidebar = apply_filters( 'keydesign_hook_blog_sidebar', $single_sidebar );
			$blog_single_sidebar_position = apply_filters( 'keydesign_hook_blog_single_sidebar_position', $single_sidebar_position );
			$blog_single_sticky_sidebar = apply_filters( 'keydesign_hook_blog_single_sticky_sidebar', keydesign_get_option( 'blog_single_sticky_sidebar' ) );

			if ( true == $blog_single_sidebar ) {
				$classes[] = 'with-sidebar';
				$classes[] = $blog_single_sidebar_position;

				if ( $blog_single_sticky_sidebar ) {
					$classes[] = 'sticky-sidebar';
				}
			} else {
				$classes[] = 'no-sidebar';
			}
		}

		return $classes;
	}
}

add_filter( 'keydesign_container_class', 'keydesign_blog_classes' );

if ( ! function_exists( 'keydesign_blog_sidebar_switch' ) ) {
	function keydesign_blog_sidebar_switch() {
		$blog_sidebar_display = $blog_single_sidebar_display = true;
		if ( class_exists( '\KeyDesign\Plugin' ) ) {
			$blog_sidebar_display = keydesign_get_option( 'blog_sidebar' );
			$blog_single_sidebar_display = keydesign_get_option( 'blog_single_sidebar' );
		}
		
		if ( keydesign_is_blog_archive() ) {
			$blog_sidebar = apply_filters( 'keydesign_hook_blog_sidebar', $blog_sidebar_display );
			
			if ( false == $blog_sidebar ) {
				add_filter( 'keydesign_show_sidebar', '__return_false' );
			}
		}

		if ( is_singular( 'post' ) ) {
			$blog_single_sidebar = apply_filters( 'keydesign_hook_blog_single_sidebar', $blog_single_sidebar_display );
			
			if ( false == $blog_single_sidebar ) {
				add_filter( 'keydesign_show_sidebar', '__return_false' );
			}
		}
	}
}
add_action( 'wp', 'keydesign_blog_sidebar_switch' );

if ( ! function_exists( 'keydesign_display_post_categories' ) ) {
	function keydesign_display_post_categories() {
		get_template_part( 'template-parts/post/category' );
	}
}
add_action( 'keydesign_single_entry_content_top', 'keydesign_display_post_categories', 5 );
add_action( 'keydesign_entry_wrapper_top', 'keydesign_display_post_categories', 5 );

if ( ! function_exists( 'keydesign_display_post_title' ) ) {
	function keydesign_display_post_title() {
		if ( is_single() ) {
			if ( apply_filters( 'keydesign_blog_single_show_page_title', true ) ) : ?>
		        <h1 class="single-post-title"><?php the_title(); ?></h1>
		    <?php endif;
		} else { ?>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php }
	}
}
add_action( 'keydesign_single_entry_content_top', 'keydesign_display_post_title', 10 );
add_action( 'keydesign_entry_wrapper_top', 'keydesign_display_post_title', 10 );

if ( ! function_exists( 'keydesign_display_post_meta' ) ) {
	function keydesign_display_post_meta() {
		get_template_part( 'template-parts/post/meta' );
	}
}
add_action( 'keydesign_single_entry_content_top', 'keydesign_display_post_meta', 15 );
add_action( 'keydesign_entry_wrapper_top', 'keydesign_display_post_meta', 15 );

if ( ! function_exists( 'keydesign_author_box_markup' ) ) {
	function keydesign_author_box_markup() {
		if ( keydesign_get_option( 'blog_single_author' ) && is_singular( 'post' ) ) {
			get_template_part( 'template-parts/post/author' );
		}
	}
}
add_action( 'keydesign_single_entry_content_bottom', 'keydesign_author_box_markup', 15 );

if ( ! function_exists( 'keydesign_blog_related_posts' ) ) {
	function keydesign_blog_related_posts() {
		if ( is_singular( 'post' ) && keydesign_get_option( 'blog_single_related_switch' ) ) {
			get_template_part( 'template-parts/post/related' );
		}
	}
}
add_action( 'keydesign_content_bottom', 'keydesign_blog_related_posts' );

// Add container classes for search page options
if ( ! function_exists( 'keydesign_search_classes' ) ) {
	function keydesign_search_classes( $classes ) {
		$search_sidebar = true;
		$search_sidebar_position = 'sidebar-right';
		$search_sidebar_sticky = keydesign_get_option( 'search_page_sticky_sidebar' );
		
		if ( class_exists( '\KeyDesign\Plugin' ) ) {
			$search_sidebar_switch = keydesign_get_option( 'search_page_sidebar' );
			$sidebar_position = keydesign_get_option( 'search_page_sidebar_position' );
		}

		if ( is_search() ) {
			$classes[] = 'blog-layout-horizontal';
			if ( true == $search_sidebar ) {
				$classes[] = 'with-sidebar';
				$classes[] = $search_sidebar_position;
			}
			if ( $search_sidebar_sticky ) {
				$classes[] = 'sticky-sidebar';
			}
		}

		return $classes;
	}
}
add_action( 'keydesign_container_class', 'keydesign_search_classes' );

// Control the display of the search page sidebar
if ( ! function_exists( 'keydesign_search_sidebar_switch' ) ) {
	function keydesign_search_sidebar_switch() {
		$search_sidebar = true;
		if ( class_exists( '\KeyDesign\Plugin' ) ) {
			$search_sidebar = keydesign_get_option( 'search_page_sidebar' );
		}

		if ( is_search() ) {
			if ( false == $search_sidebar ) {
				add_filter( 'keydesign_show_sidebar', '__return_false' );
			}
		}
	}
}
add_action( 'wp', 'keydesign_search_sidebar_switch' );

// Search page title
if ( ! function_exists( 'keydesign_overwrite_search_page_title' ) ) {
	function keydesign_overwrite_search_page_title( $page_title ) {
		if ( '' != keydesign_get_option( 'search_page_title' ) ) {
			$page_title = keydesign_get_option( 'search_page_title' ) . ' <span>' . get_search_query() . '</span>';
		}
		return $page_title;
	}
}
add_filter( 'keydesign_search_page_title', 'keydesign_overwrite_search_page_title', 10, 2 );

if ( ! function_exists( 'keydesign_single_post_tags' ) ) {
    function keydesign_single_post_tags() {
		if ( ! has_tag() ) {
			return;
		}
        echo '<div class="entry-footer">';

        if ( 'post' === get_post_type() ) :
            $tags_list = get_the_tag_list( '', esc_attr_x( ', ', 'list item separator', 'sierra' ) );
            if ( $tags_list ) {
              the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' );
            }
        endif;

        echo '</div>';
    }
}
add_action( 'keydesign_single_entry_content_bottom', 'keydesign_single_post_tags', 10 );

if ( ! function_exists( 'keydesign_single_post_navigation' ) ) {
	function keydesign_single_post_navigation() {
		$post_pagination = true;
		if ( class_exists( '\KeyDesign\Plugin' ) ) {
			$post_pagination = keydesign_get_option( 'blog_single_pagination' );
		}

        if ( is_single() && $post_pagination == true ) {

            $next_text = __( 'Next', 'sierra' );
			$prev_text = __( 'Previous', 'sierra' );

			the_post_navigation(
				apply_filters(
					'keydesign_single_post_navigation',
					array(
						'next_text' => $next_text,
						'prev_text' => $prev_text,
					)
				)
			);
        }
    }
}
add_action( 'keydesign_single_entry_content_bottom', 'keydesign_single_post_navigation', 20 );

if ( ! function_exists( 'keydesign_comment_form' ) ) {
	function keydesign_comment_form() {
		if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    }
}
add_action( 'keydesign_single_entry_content_bottom', 'keydesign_comment_form', 25 );
add_action( 'keydesign_entry_bottom', 'keydesign_comment_form', 25 );

if ( ! function_exists( 'keydesign_blog_featured_item' ) ) {
	function keydesign_blog_featured_item() {
		$post_format = get_post_format();
		$has_thumbnail = has_post_thumbnail();
	
		if ( ( ( is_archive() || is_home() ) && $has_thumbnail ) || ( is_single() && $has_thumbnail && !in_array( $post_format, array( 'video', 'audio', 'gallery' ) ) ) ) {
			if ( is_single() ) {
				?>
				<div class="entry-image">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
				<?php
			} else {
				?>
				<div class="entry-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
				</div>
				<?php
			}
		}
	}
}
add_action( 'keydesign_single_entry_content_top', 'keydesign_blog_featured_item', 20 );
add_action( 'keydesign_entry_top', 'keydesign_blog_featured_item', 10 );

// Add modern single blog header markup
if ( ! function_exists( 'keydesign_display_modern_blog_page_title' ) ) {
	function keydesign_display_modern_blog_page_title() {
		if ( is_single() && get_post_type() === 'post' ) {
			$layout_output = '';
			$has_post_thumbnail = false;
			$blog_single_layout = apply_filters( 'keydesign_hook_blog_single_layout', keydesign_get_option( 'blog_single_layout' ) );
			if ( has_post_thumbnail() || wp_get_attachment_image_src( get_post_thumbnail_id() ) ) {
				$has_post_thumbnail = true;
			}

			if ( 'blog-single-layout-modern' == $blog_single_layout && $has_post_thumbnail ) {
				echo '<header id="page-header" class="page-header modern-entry-image"></header>';
			}
		}
	}
}
add_action( 'keydesign_content_top', 'keydesign_display_modern_blog_page_title' );

// Add class on post_class if no thumbnail
if ( ! function_exists( 'keydesign_single_post_class' ) ) {
	function keydesign_single_post_class( $classes ) {
		if ( is_single() ) {
			if ( ! has_post_thumbnail() || ! wp_get_attachment_image_src( get_post_thumbnail_id() ) ) {
				$classes[] = 'no-thumbnail';
			}
		}
		return $classes;
	}
}
add_filter( 'post_class', 'keydesign_single_post_class' );

// Remove archive title prefix
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
