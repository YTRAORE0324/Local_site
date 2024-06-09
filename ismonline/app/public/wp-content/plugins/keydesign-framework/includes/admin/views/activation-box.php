<?php
namespace KeyDesign;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$license_key = License\Admin::get_license_key();
$masked_license_key = License\Admin::get_masked_license_key();
$client_name = License\Admin::get_client_name();

$check_connection = License\API::check_connection();
$connection_status = false;
if ( !is_wp_error( $check_connection ) ) {
	if ( $check_connection['status'] ) {
		$connection_status = true;
	}
}

?>

<div class="kdadmin-panel-column kdadmin-activate-column">
    <div class="activation-notice">
		<h3>
			<span class="dashboard-icon lnricons-lock"></span><?php echo esc_html__( 'License Settings', 'keydesign-framework' ); ?>
		</h3>
        <?php if ( empty( $license_key ) ) : ?>
			<?php if ( $connection_status ) : ?>
				<p><span class="expired"><?php echo esc_html__( 'Register your theme license key.', 'keydesign-framework' ); ?></span></p>
				<hr>
				<p><?php printf( esc_html__( 'You are almost done, register %1$s to get theme updates, install premium plugins and demo content.', 'keydesign-framework' ), Utils::get_parent_theme_name() ); ?></p>
				<span class="support-badge expired"><?php echo esc_html__( 'Unregistered', 'keydesign-framework' ); ?></span>
			<?php else: ?>
				<p><span class="expired"><?php echo esc_html__( 'Could not connect to API server. Please open a ', 'keydesign-framework' ); ?><a href="https://keydesign.ticksy.com/" target="_blank"><?php echo esc_html__( 'support ticket', 'keydesign-framework' ); ?></a>.</span></p>
			<?php endif; ?>
        <?php else : ?>
			<p><span class="active"><?php echo esc_html__( 'Your license is registered.', 'keydesign-framework' ); ?></span></p>
			<hr>
            <p><?php echo esc_html__( 'Want to deactivate the license for any reason?', 'keydesign-framework' ); ?></p>
			<span class="support-badge active"><?php echo esc_html__( 'Registered', 'keydesign-framework' ); ?></span>
        <?php endif; ?>
    </div>

	<?php if ( $connection_status ) : ?>
		<form class="keydesign-activation-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'keydesign-license' ); ?>
			
			<?php if ( empty( $license_key ) ) : ?>
				
				<input type="hidden" name="action" value="keydesign_activate_license"/>

				<p class="activation-form-field license-code-field">
					<label for="keydesign-license-code"><?php echo esc_html__( 'Envato Purchase Code', 'keydesign-framework' ); ?></label>
					<input id="keydesign-license-code" class="regular-text" name="keydesign_license_code" type="text" value="" required>
					<span class="description"><?php echo esc_html__( 'How to find your', 'keydesign-framework' ); ?> <a href="https://docs.keydesign.xyz/documentation/purchase-code/" target="_blank"><?php echo esc_html__( 'Envato Purchase Code', 'keydesign-framework' ); ?></a>.</span>
				</p>
				<p class="activation-form-field envato-username-field">
					<label for="keydesign-client-name"><?php echo esc_html__( 'Envato Username', 'keydesign-framework' ); ?></label>
					<input id="keydesign-client-name" class="regular-text" name="keydesign_client_name" type="text" value="" required>
					<span class="description"><?php echo esc_html__( 'How to find your', 'keydesign-framework' ); ?> <a href="https://docs.keydesign.xyz/documentation/envato-username/" target="_blank"><?php echo esc_html__( 'Envato Username', 'keydesign-framework' ); ?></a>.</span>
				</p>
				<p class="activation-form-field submit-field">
					<input type="submit" value="<?php echo esc_html__( 'Register', 'keydesign-framework' ); ?>" class="button">
				</p>
			<?php else : ?>

				<input type="hidden" name="action" value="keydesign_deactivate_license"/>

				<input id="keydesign-license-code" class="regular-text disabled-field" type="text" value="<?php echo esc_attr( $masked_license_key ); ?>" disabled/>
				
				<input type="submit" class="button" value="<?php esc_attr_e( 'Deactivate', 'keydesign-framework' ); ?>"/>
			<?php endif; ?>
		</form>
	<?php endif; ?>
</div>