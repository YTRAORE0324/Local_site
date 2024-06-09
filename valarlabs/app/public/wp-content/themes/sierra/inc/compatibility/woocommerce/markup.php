<?php

// Add wrapper for shop ordering bar
add_action('woocommerce_before_shop_loop', function () {
	echo '<div class="shop-before-loop">';
}, 12);

add_action('woocommerce_before_shop_loop', function () {
	echo '</div>';
}, 31);

// Add wrapper for product image
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '<div class="woo-entry-image">';
}, 5);

add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '</div>';
}, 12);

// Add wrapper for add to cart button
add_action('woocommerce_after_shop_loop_item', function () {
	echo '<div class="woo-action-wrapper">';
}, 6);

add_action('woocommerce_after_shop_loop_item', function () {
	echo '</div>';
}, 20);

// Move product rating above title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );

// Breadcrumbs settings
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 2 );
