<?php
/**
 * Template part for displaying related content
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'keydesign-card' ); ?>>

	<div class="entry-image medium-size-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'keydesign-medium-image' ); ?></a>
	</div>
	<div class="entry-wrapper">

		<?php get_template_part( 'template-parts/post/category' ); ?>
	    <h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		<?php get_template_part( 'template-parts/post/meta' ); ?>

		<div class="entry-content-card">
			<div class="post-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>

</article>
