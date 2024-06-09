<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'keydesign-card' ); ?>>

	<div class="entry-image medium-size-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'keydesign-medium-image' ); ?></a>
	</div>
	<div class="entry-wrapper">

		<?php include KEYDESIGN_MODULES_PATH . '/portfolio/template-parts/category.php'; ?>
	    <h5 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>

		<div class="entry-content-card">
            <div class="entry-button-wrapper">
    			<a class="keydesign-button" href="<?php the_permalink(); ?>"><?php echo apply_filters( 'portfolio_related_button_text', esc_html__( "View project", "keydesign-framework" ) ); ?></a>
    		</div>
		</div>
	</div>

</article>
