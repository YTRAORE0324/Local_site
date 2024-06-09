<?php
/**
 * Single comment callback
 */

function single_comment( $comment, $args, $depth ) {
    $author_comment = get_the_author_meta( 'email' ) === $comment->comment_author_email;

	$has_avatar = (
		0 !== $args['avatar_size']
		&&
		get_comment_type( $comment ) === 'comment'
		&&
		get_option( 'show_avatars', 1 )
	);

	$class = '';

	if ( $has_avatar ) {
		$class = 'keydesign-has-avatar';
	}

	if ( $author_comment ) {
		$class .= ' keydesign-author-comment';
	} ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( $class ); ?>>
        <article class="keydesign-comment-inner" id="keydesign-comment-inner-<?php comment_ID(); ?>">

			<footer class="keydesign-comment-meta">
				<?php echo get_avatar( $comment, '62' ); ?>

				<h4 class="keydesign-comment-author">
					<?php echo get_comment_author_link(); ?>
				</h4>

				<div class="keydesign-comment-meta-data">
					<a href="<?php echo esc_attr( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							printf(
								/* translators: 1: date, 2: time */
								wp_kses_post( __( '%1$s / %2$s', 'sierra' ) ),
								wp_kses_post( get_comment_date() ),
								wp_kses_post( get_comment_time() )
							);
						?>
					</a>

					<?php edit_comment_link( __( 'Edit', 'sierra' ), '  ', '' ); ?>

					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'keydesign-comment-inner',
								'reply_text' => __('Reply', 'sierra'),
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
							)
						)
					)
					?>
				</div>
			</footer>


			<div class="keydesign-comment-content entry-content">
				<?php comment_text(); ?>

				<?php if ( '0' === $comment->comment_approved ) : ?>
					<em class="keydesign-awaiting-moderation">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'sierra' ); ?>
					</em>
				<?php endif; ?>
			</div>

		</article>
    </li>
<?php }
