<?php
/**
 * Template part for displaying a 404 page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>

<?php keydesign_entry_before(); ?>

<section class="block block-error-404">

    <?php keydesign_entry_top(); ?>

    <div class="container">
        <div class="content">

            <h1 id="content"><?php esc_html_e( '404', 'sierra' ); ?></h1>
            <h3 aria-hidden="true"><?php echo apply_filters( '404_page_title_hook', esc_html__( 'Page not found.', 'sierra' ) ); ?></h3>
            <p><?php echo apply_filters( '404_page_subtitle_hook', esc_html__( 'The reason might be mistyped or expired URL. Try searching for something else.', 'sierra' ) ); ?></p>

            <div class="search-container">
                <?php the_widget( 'WP_Widget_Search' ); ?>
            </div>

        </div>
    </div>

    <?php keydesign_entry_bottom(); ?>

</section>

<?php keydesign_entry_after(); ?>
