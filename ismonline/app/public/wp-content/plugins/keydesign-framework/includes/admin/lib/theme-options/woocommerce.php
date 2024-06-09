<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'shop_page_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Shop Page', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_subtitle' => array(
            'type' => 'textarea',
            'label' => esc_html__( 'Shop Subtitle', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter a subtitle text for the shop page. Visible only on the main shop page.', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
         ),
        'woo_catalog_style' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Product Box Style', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the product box design.', 'keydesign-framework' ),
            'options' => array(
                'wc-style-minimal' => esc_html__( 'Minimal', 'keydesign-framework' ),
                'wc-style-detailed' => esc_html__( 'Detailed', 'keydesign-framework' ),
            ),
            'value' => 'wc-style-detailed',
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_products_number' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Products per Page', 'keydesign-framework' ),
            'min' => 1,
            'max' => 40,
            'step' => 1,
            'value' => 9,
            'description' => esc_html__( 'How many products should be shown per page?', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_shop_columns' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Products per Row', 'keydesign-framework' ),
            'min' => 2,
            'max' => 4,
            'step' => 1,
            'value' => 2,
            'description' => esc_html__( 'How many products should be shown per row?', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Shop Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the Shop Sidebar on shop and archive pages.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_sidebar_position' => array(
            'label' => esc_html__( 'Sidebar Position', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'sidebar-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'sidebar-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'sidebar-right',
            'dependency' => array(
                'key' => 'woo_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'woo_sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Sticky Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to keep the sidebar sticky as users scroll.', 'keydesign-framework' ),
            'value' => true,
            'dependency' => array(
                'key' => 'woo_sidebar',
                'value' => 'not_empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Shop Page', 'keydesign-framework' ),
        ),
        'single_product_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Single Product', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_image_position' => array(
            'label' => esc_html__( 'Product Image Position', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the product image position.', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'product-image-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'product-image-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'product-image-left',
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_related_number' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Number of Related Products', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the number of related products.', 'keydesign-framework' ),
            'min' => 2,
            'max' => 4,
            'step' => 1,
            'value' => 3,
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_social' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Social Sharing Buttons', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display social sharing buttons.', 'keydesign-framework' ),
            'description' => esc_html__( 'Display social sharing buttons.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Product Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the Product Sidebar on product pages.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_sidebar_position' => array(
            'label' => esc_html__( 'Sidebar Position', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'sidebar-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'sidebar-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'sidebar-right',
            'dependency' => array(
                'key' => 'woo_single_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
        'woo_single_sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Sticky Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to keep the sidebar sticky as users scroll.', 'keydesign-framework' ),
            'value' => true,
            'dependency' => array(
                'key' => 'woo_single_sidebar',
                'value' => 'not_empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Single Product', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'WooCommerce', 'keydesign-framework' ),
        'icon' => 'lnricons-bag',
        'fields' => $fields
    );

    $setup[ 'woocommerce' ] = $customFields;

    return $setup;

}, 10, 1 );
