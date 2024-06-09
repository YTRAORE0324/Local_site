<?php
/**
 * The template for displaying Related posts for Portfolio items
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !( 'keydesign-portfolio' == get_post_type() ) ) {
	return false;
}

use KeyDesign\Utils;

global $post;
$terms = get_the_terms( $post->ID , 'keydesign-portfolio-category' );

if ( empty( $terms ) ) {
    return false;
}

$term_ids = array_values( wp_list_pluck( $terms, 'term_id' ) );

$related_query = new \WP_Query(
    array(
        'post_type' => 'keydesign-portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'keydesign-portfolio-category',
                'field' => 'id',
                'terms' => $term_ids,
                'operator'=> 'IN'
            )
        ),
        'posts_per_page' => Utils::get_option( 'portfolio_related_number' ),
        'orderby' => 'name',
        'post__not_in' => array( $post->ID )
    )
);

if ( $related_query->found_posts == 0 ) {
    return false;
}

if ( '' != Utils::get_option( 'portfolio_related_number' ) ) {
    $grid_columns = 'columns-' . Utils::get_option( 'portfolio_related_number' );
}

if ( $related_query->have_posts() ) : ?>
	<section class="related-posts">
		<div class="keydesign-container e-con">
      		<div class="related-title">
        		<h3><?php if ( '' != Utils::get_option( 'portfolio_related_title' ) ) {
                    echo esc_html( Utils::get_option( 'portfolio_related_title' ) );
                } else {
                    echo __( 'Related projects', 'keydesign-framework' );
                } ?></h3>
      		</div>
	    	<div class="related-content blog-layout-grid <?php echo esc_attr( $grid_columns ); ?>">
	      		<?php
			      	while ( $related_query->have_posts() ) :
						$related_query->the_post();
			      		include KEYDESIGN_MODULES_PATH . '/portfolio/template-parts/related-card.php';
			      	endwhile;

	      			wp_reset_postdata();
	      		?>
	    	</div>
		</div>
	</section>
<?php endif; ?>
