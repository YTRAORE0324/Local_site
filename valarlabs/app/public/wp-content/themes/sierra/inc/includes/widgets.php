<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if ( ! function_exists( 'keydesign_widgets_init' ) ) {
    function keydesign_widgets_init() {
        register_sidebar(
            apply_filters(
                'keydesign_main_sidebar',
                array(
                    'name' => esc_html__( 'Main Sidebar', 'sierra' ),
                    'id' => 'sidebar-1',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h4 class="widget-title">',
                    'after_title' => '</h4>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_page_sidebar',
                array(
                    'name' => esc_html__( 'Page Sidebar', 'sierra' ),
                    'id' => 'page-sidebar',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h4 class="widget-title">',
                    'after_title' => '</h4>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_footer_widget_area_1',
                array(
                    'name' => esc_html__( 'Footer Widget Area 1', 'sierra' ),
                    'id' => 'footer-widget-area-1',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_footer_widget_area_2',
                array(
                    'name' => esc_html__( 'Footer Widget Area 2', 'sierra' ),
                    'id' => 'footer-widget-area-2',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_footer_widget_area_3',
                array(
                    'name' => esc_html__( 'Footer Widget Area 3', 'sierra' ),
                    'id' => 'footer-widget-area-3',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_footer_widget_area_4',
                array(
                    'name' => esc_html__( 'Footer Widget Area 4', 'sierra' ),
                    'id' => 'footer-widget-area-4',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>',
                )
            )
        );

        register_sidebar(
            apply_filters(
                'keydesign_footer_copyright_area',
                array(
                    'name' => esc_html__( 'Footer Copyright', 'sierra' ),
                    'id' => 'footer-copyright-area',
                    'description' => '',
                    'before_widget' => '<section id="%1$s" class="widget keydesign-widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h5 class="widget-title">',
                    'after_title' => '</h5>',
                )
            )
        );
    }

    add_action( 'widgets_init', 'keydesign_widgets_init' );
}
