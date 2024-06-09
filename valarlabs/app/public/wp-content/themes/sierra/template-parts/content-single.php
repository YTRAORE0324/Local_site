<?php
/**
 * The template for displaying all single posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-content article-single' ); ?>>
    <?php keydesign_single_entry_content_top(); ?>

    <div class="entry-content">
        <?php
            keydesign_entry_content_before();
            the_content();
            keydesign_entry_content_after();

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">',
                    'after'  => '</div>',
                    'link_before' => '<span class="page-link">',
        			'link_after'  => '</span>',
                )
            );
        ?>
    </div>

    <?php keydesign_single_entry_content_bottom(); ?>
</article>
