<?php
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
} ?>
<div class="keydesign-notice keydesign-site-settings-notice">
	<p><?php printf( __( 'To change the site colors and typography, please use the Elementor %1$s panel.', 'keydesign-framework' ), '<a href="' . esc_url_raw( KeyDesign\Compatibility\KeyDesign_Elementor::get_site_settings_link() ) . '">' . esc_html__( 'Site Settings' , 'keydesign-framework' ) . '</a>' ); ?></p>
</div>
