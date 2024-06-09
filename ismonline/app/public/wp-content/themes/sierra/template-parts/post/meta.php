<?php
/**
 * The template used for displaying meta information for single Blog posts
 */

$post_meta_date = $post_meta_author = $post_meta_comments = true;
if ( class_exists( '\KeyDesign\Plugin' ) ) {
    $post_meta_date = keydesign_get_option( 'post_meta_date' );
    $post_meta_author = keydesign_get_option( 'post_meta_author' );
    $post_meta_comments = keydesign_get_option( 'post_meta_comments' );
}

if ( 'post' === get_post_type() ) : ?>
    <?php if ( $post_meta_date || $post_meta_author || $post_meta_comments ) : ?>
        <div class="entry-meta">
            <?php keydesign_post_meta_top(); ?>

            <?php if ( is_sticky() ) echo '<span class="sticky-post"><span class="fas fa-thumbtack"></span>' . apply_filters( 'sticky-post-text', esc_html__( "Sticky", "sierra" ) ) . '</span>'; ?>

            <?php if ( $post_meta_date == true ) : ?>
                <span class="published">
                    <?php echo esc_html( get_the_time( get_option('date_format') ) ); ?>
                </span>
            <?php endif; ?>

            <?php if ( $post_meta_author == true ) : ?>
                <span class="author"><?php the_author_posts_link(); ?></span>
            <?php endif; ?>

            <?php if ( $post_meta_comments == true ) : ?>
                <span class="comment-count"><?php comments_popup_link( esc_html__( 'No comments yet', 'sierra' ), esc_html__( '1 comment', 'sierra' ), esc_html__( '% comments', 'sierra' ) ); ?></span>
            <?php endif; ?>

            <?php keydesign_post_meta_bottom(); ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <?php if ( $post_meta_date ) : ?>
        <div class="entry-meta">
    		<?php if ( $post_meta_date == true ) : ?>
    			<span class="published"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
    		<?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
