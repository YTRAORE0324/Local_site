<?php

function overwrite_elementor_library_template() {
    if ( is_singular( 'elementor_library' ) ) {

        /* Remove keydesign-container markup */
        remove_action( 'keydesign_content_top', 'keydesign_container_top_markup', 20 );
        remove_action( 'keydesign_content_bottom', 'keydesign_container_bottom_markup' );

        /* Hide single post title */
        add_filter( 'keydesign_blog_single_show_page_title', '__return_false' );

        /* Remove htumbnail image */
        remove_action( 'keydesign_single_entry_content_top', 'keydesign_blog_featured_item', 20 );

        /* Hide post meta */
        remove_action( 'keydesign_single_entry_content_top', 'keydesign_display_post_meta', 15 );

        /* Hide sidebar */
        add_filter( 'keydesign_show_sidebar', '__return_false' );

        /* Hide social sharing buttons */
        remove_action( 'keydesign_single_entry_content_top', [ KeyDesign\Plugin::instance()->theme_features, 'get_social_sharing_markup' ] );

        /* Hide post navigation */
        remove_action( 'keydesign_single_entry_content_bottom', 'keydesign_single_post_navigation', 20 );
    }
}
add_action( 'wp', 'overwrite_elementor_library_template', 15 );
