<?php
/**
 * The template for displaying Author info box
 */

if ( false === keydesign_get_option( 'blog_single_author' ) ) {
    return;
}
?>
<div class="author-box-wrapper">
    <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
    </div>
    <div class="author-desc-wrapper">
        <div class="author-name">
            <h5><?php the_author_posts_link(); ?></h5>
        </div>
        <?php if ( '' != get_the_author_meta( 'description' ) ) : ?>
            <div class="author-description">
				<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
