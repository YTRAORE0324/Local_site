<?php
/**
 * The template for displaying Related posts for Blog posts
 */

if ( !( 'post' == get_post_type() ) ) {
	return false;
}

$related_posts_number = keydesign_get_option( 'blog_single_related_number' );

if ( '' == $related_posts_number ) {
	$related_posts_number = 3;
}

$tags = wp_get_post_tags( $post->ID );
if ( $tags ) {
	$tag_ids = array();
	foreach ( $tags as $single_tag ) $tag_ids[] = $single_tag->term_id;
	$args = array(
		'tag__in' => $tag_ids,
		'post__not_in' => array( $post->ID ),
		'posts_per_page' => $related_posts_number,
		'ignore_sticky_posts' => 1,
		'orderby' => 'date',
		'post__not_in' => array( $post->ID )
	);
}

$related_query = new WP_Query( $args );

if ( $related_query->found_posts == 0 ) {
	return false;
}

if ( '' != keydesign_get_option( 'blog_single_related_number' ) ) {
    $grid_columns = 'columns-' . keydesign_get_option( 'blog_single_related_number' );
}

if ( $related_query->have_posts() ) : ?>
	<?php keydesign_related_content_before(); ?>
	<section class="related-posts">
		<div class="keydesign-container e-con">
			<?php keydesign_related_content_top(); ?>
			<div class="related-title">
				<h3><?php if ( '' != keydesign_get_option( 'blog_single_related_title' ) ) {
					echo esc_html( keydesign_get_option( 'blog_single_related_title' ) );
				} else {
					echo __( 'Related posts', 'sierra' );
				} ?></h3>
			</div>
			<div class="related-content blog-layout-grid <?php echo esc_attr( $grid_columns ); ?>">
				<?php
					while ( $related_query->have_posts() ) :
						$related_query->the_post();
						get_template_part( 'template-parts/post/content', 'related' );
					endwhile;

					wp_reset_postdata();
				?>
			</div>
			<?php keydesign_related_content_bottom(); ?>
		</div>
	</section>
	<?php keydesign_related_content_after(); ?>
<?php endif; ?>
