<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 */

 /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="keydesign-comments">

	<?php keydesign_comments_before(); ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="keydesign-comments-title">
			<?php comments_number( esc_html__( 'No comments yet', 'sierra' ), __( 'One comment', 'sierra' ), __( '% Comments', 'sierra' ) ); ?>
		</h3>
	<?php endif; // have_comments() ?>

	<?php if ( have_comments() ) : ?>
		<ol class="keydesign-comment-list">
			<?php
				wp_list_comments(
					[
						'short_ping'  => true,
						'avatar_size' => 100,
						'callback' => 'single_comment',
						'end-callback' => function () {
							echo '</li>';
						}
					]
				);
			?>
		</ol>

		<?php
		// Are there comments to navigate through?
		if (get_comment_pages_count() > 1 && get_option('page_comments')) :
			?>
			<nav class="keydesign-comment-navigation-container">
				<h4 class="screen-reader-text section-heading">
					<?php esc_html_e( 'Comment navigation', 'sierra' ); ?>
				</h4>

				<div class="keydesign-comments-navigation">
					<span class="prev">
					<?php previous_comments_link( __( '&larr; Older Comments', 'sierra' ) ); ?>
					</span>

					<span class="next">
					<?php next_comments_link( __( 'Newer Comments &rarr;', 'sierra' ) ); ?>
					</span>
				</div>
			</nav>
		<?php endif; // Check for comment navigation ?>

		<?php if (! comments_open() && get_comments_number()) : ?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'sierra' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

	<?php keydesign_comments_after(); ?>

</div><!-- #comments -->
