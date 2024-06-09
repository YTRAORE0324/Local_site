<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>

<?php keydesign_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php keydesign_entry_top(); ?>

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

    <?php keydesign_entry_bottom(); ?>

</article>

<?php keydesign_entry_after(); ?>
