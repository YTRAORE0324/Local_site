<?php
/**
 * The template for displaying footer.
 */

defined( 'ABSPATH' ) || exit;

$upper_footer_section = false;
if ( is_active_sidebar( 'footer-widget-area-1' ) ||
    is_active_sidebar( 'footer-widget-area-2' ) ||
    is_active_sidebar( 'footer-widget-area-3' ) ||
    is_active_sidebar( 'footer-widget-area-4' ) ) {
        $upper_footer_section = true;
}
?>
<footer id="colophon" <?php keydesign_site_footer_class(); ?>>
    <?php keydesign_footer_top(); ?>
        <?php if ( $upper_footer_section ) : ?>
            <div class="footer-widget-section">
                <div class="keydesign-container e-con">
                    <?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) : ?>
                        <div class="footer-widget-area-wrapper footer-widget-area-1">
                            <aside class="footer-widget-area widget-area">
                                <?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) {
                        			dynamic_sidebar( 'footer-widget-area-1' );
                                } ?>
                            </aside>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) : ?>
                        <div class="footer-widget-area-wrapper footer-widget-area-2">
                            <aside class="footer-widget-area widget-area">
                                <?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) {
                        			dynamic_sidebar( 'footer-widget-area-2' );
                                } ?>
                            </aside>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) : ?>
                        <div class="footer-widget-area-wrapper footer-widget-area-3">
                            <aside class="footer-widget-area widget-area">
                                <?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) {
                        			dynamic_sidebar( 'footer-widget-area-3' );
                                } ?>
                            </aside>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'footer-widget-area-4' ) ) : ?>
                        <div class="footer-widget-area-wrapper footer-widget-area-4">
                            <aside class="footer-widget-area widget-area">
                                <?php if ( is_active_sidebar( 'footer-widget-area-4' ) ) {
                        			dynamic_sidebar( 'footer-widget-area-4' );
                                } ?>
                            </aside>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="footer-copyright-section">
            <div class="keydesign-container e-con">
                <?php if ( is_active_sidebar( 'footer-copyright-area' ) )  {
                    dynamic_sidebar( 'footer-copyright-area' );
                } else { ?>
                    <p class="footer-copyright-text"><?php echo esc_html__( '&copy; KeyDesign Themes. All rights reserved.', 'sierra' ); ?></p>
                <?php } ?>
            </div>
        </div>

    <?php keydesign_footer_bottom(); ?>
</footer>
