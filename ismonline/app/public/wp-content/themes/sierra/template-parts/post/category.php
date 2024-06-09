<?php
    $post_meta_categories = true;
	if ( class_exists( '\KeyDesign\Plugin' ) ) {
		$post_meta_categories = keydesign_get_option( 'post_meta_categories' );
	}
    if ( 'post' === get_post_type() && $post_meta_categories == true ) : ?>
    <div class="category-meta">
        <span class="blog-label"><?php the_category(', '); ?></span>
    </div>
<?php endif; ?>
