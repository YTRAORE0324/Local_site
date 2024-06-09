<?php
namespace KeyDesign;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$license_key = License\Admin::get_license_key();

if ( ! $license_key ) {
    return;
}

$update_status = false;
$update_data = License\API::check_update( false /* Use Cache */ );

if ( is_wp_error( $update_data ) ) {
    return;
}

if ( $update_data[ 'status' ] && ( version_compare( Utils::get_parent_theme_version(), $update_data['version'], '<' ) ) ) {
    $update_status = true;
}

?>
<div class="kdadmin-panel-column">
    <h3><span class="dashboard-icon lnricons-sync"></span><?php esc_html_e( 'Theme Updates', 'keydesign-framework' ); ?></h3>
    <p>
        <?php if ( ! $update_status ) : ?>
            <span class="active"><?php echo esc_html__( 'You are using the latest theme version.', 'keydesign-framework' ); ?></span>
        <?php else : ?>
            <span class="expired"><?php echo sprintf( esc_html__( 'New version available. Update to v%s.', 'elementor' ), $update_data[ 'version' ] ); ?></span>
        <?php endif; ?>
    </p>
    <hr>
    <p><?php echo esc_html__( 'Keep your theme updated to ensure that your website is running smoothly.', 'keydesign-framework' ); ?></p>

    <?php if ( ! $update_status ) : ?>
        <span class="support-badge active"><?php echo esc_html__( 'Latest Version', 'keydesign-framework' ); ?></span>
    <?php else : ?>
        <span class="support-badge expired"><?php echo esc_html__( 'Update Required', 'keydesign-framework' ); ?></span>
		<a class="kdadmin-button" href="<?php echo esc_url_raw( admin_url( 'update-core.php' ) ); ?>">
			<?php echo esc_html__( 'Update theme', 'keydesign-framework' ); ?>
        </a>
    <?php endif; ?>
</div>