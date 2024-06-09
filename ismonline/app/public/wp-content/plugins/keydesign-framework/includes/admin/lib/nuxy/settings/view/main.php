<?php

/**
 * Settings Main template.
 *
 * @var $metabox
 * @var $page
 * @var $wpcfto_title
 * @var $wpcfto_sub_title
 * @var $wpcfto_logo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} //Exit if accessed directly

if ( empty( $wpcfto_title ) ) {
	$wpcfto_title = $page['page_title'];
}

?>

<?php
$metabox_id = $metabox['id'];
$sections   = $metabox['args'][ $metabox_id ];
$source_id  = 'data-source="settings"';

do_action( "wpcfto_settings_screen_{$metabox_id}_before" );

if ( ! empty( $sections ) ) :
	require_once KEYDESIGN_PATH . 'includes/admin/views/welcome-panel.php';
	require_once KEYDESIGN_PATH . 'includes/admin/views/site-settings-notice.php';
	echo '<div class="keydesign-notice keydesign-export"><pre>' . (json_encode( stm_wpcfto_get_options('keydesign_options') )) . '</pre></div>';
	?>

	<div class="wpcfto-settings"
		v-bind:class="'data-' + data.length"
		data-vue="<?php echo esc_attr( $metabox_id ); ?>" data-source="settings">

		<?php include STM_WPCFTO_PATH . '/settings/view/header.php'; ?>

		<?php require_once STM_WPCFTO_PATH . '/metaboxes/metabox-display.php'; ?>

	</div>

<?php
endif;

do_action( "wpcfto_settings_screen_{$metabox_id}_after" );
