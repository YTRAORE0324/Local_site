<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
$terms = get_the_terms( $post->ID, 'keydesign-portfolio-category' );
if ( !$terms ) {
	return;
} ?>

<div class="category-meta">
    <?php
        foreach ( $terms as $term ) {
            $term_link = get_term_link( $term, 'keydesign-portfolio-category' );
            if ( is_wp_error( $term_link ) ) {
                continue;
            } else {
                echo '<a href="' . $term_link . '" rel="category tag">' . $term->name . '</a>';
            }
        }
    ?>
</div>
