<?php
/**
 * Template part for displaying standard posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

?>

<?php keydesign_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'keydesign-card' ); ?>>

	<?php keydesign_entry_top(); ?>

	<div class="entry-wrapper">

		<?php keydesign_entry_wrapper_top(); ?>

		<div class="entry-content-card">
			<div class="post-content">
				<?php the_excerpt(); ?>
			</div>

			<?php wp_link_pages(
                array(
                    'before' => '<div class="page-links">',
                    'after'  => '</div>',
                    'link_before' => '<span class="page-link">',
        			'link_after'  => '</span>',
                )
            ); ?>

			<?php keydesign_entry_content_card(); ?>
		</div>
		<?php keydesign_entry_wrapper_bottom(); ?>
	</div>

	<?php keydesign_entry_bottom(); ?>

</article>

<?php keydesign_entry_after(); ?>
