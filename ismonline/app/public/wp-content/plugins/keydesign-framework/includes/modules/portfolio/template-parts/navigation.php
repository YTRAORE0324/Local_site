<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prev_post = get_adjacent_post( false, '', true );
$next_post = get_adjacent_post( false, '', false ); ?>

<section class="portfolio-navigation-section">
    <div class="keydesign-container e-con">
        <nav class="portfolio-nav-links">
            <div class="portfolio-nav-previous">
                <?php if ( !empty( $prev_post ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                        <div class="nav-previous-group">
                            <p class="nav-previous-subtitle"><?php echo apply_filters( 'keydesign_portfolio_prev_btn', esc_html__( "Previous", "keydesign-framework" ) ); ?></p>
                            <h5 class="nav-previous-title"><?php echo esc_attr( $prev_post->post_title ); ?></h5>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
            <div class="portfolio-nav-home">
                <a href="<?php echo get_post_type_archive_link( 'keydesign-portfolio' ); ?>">
                    <span class="portfolio-nav-home-icon"></span>
                </a>
            </div>
            <div class="portfolio-nav-next">
                <?php if ( !empty( $next_post ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                        <div class="nav-next-group">
                            <p class="nav-next-subtitle"><?php echo apply_filters( 'keydesign_portfolio_next_btn', esc_html__( "Next", "keydesign-framework" ) ); ?></p>
                            <h5 class="nav-next-title"><?php echo esc_attr( $next_post->post_title ); ?></h5>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</section>
