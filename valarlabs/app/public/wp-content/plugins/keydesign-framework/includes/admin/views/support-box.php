<?php

namespace KeyDesign;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$license_key = License\Admin::get_license_key();

if ( ! $license_key ) {
    return;
}

$license_data = License\API::get_license_data();
$support_status = false;

if ( $license_data[ 'status' ] ) {
	$support_expiry = $license_data['data'];

	$support_remaining = human_time_diff( current_time( 'timestamp' ), strtotime( $support_expiry ) );

	if ( strtotime( $support_expiry ) > current_time( 'timestamp' ) ) {
		$support_status = true;
	}
}

?>
<div class="kdadmin-panel-column">
    <h3>
        <span class="dashboard-icon lnricons-lifebuoy"></span><?php echo esc_html__( 'Support Status', 'keydesign-framework' ); ?>
    </h3>
	
    <p>
        <?php if ( $support_status ) : ?>
            <span class="active"><?php printf( esc_html__( 'Your item support will expire in %1$s.', 'keydesign-framework' ), $support_remaining ); ?></span>
        <?php else : ?>
            <span class="expired"><?php echo esc_html__( 'Your support subscription has expired.', 'keydesign-framework' ); ?></span>
        <?php endif; ?>
    </p>
	
    <hr>
    <?php if ( $support_status ) : ?>
        <p><?php echo esc_html__( 'Get an extra 6 months of support now and save.', 'keydesign-framework' ); ?></p>
		<span class="support-badge active"><?php echo esc_html__( 'Active', 'keydesign-framework' ); ?></span>
    <?php else : ?>
        <p><?php echo esc_html__( 'Renew your support for 6 new months.', 'keydesign-framework' ); ?></p>
		<span class="support-badge expired"><?php echo esc_html__( 'Expired', 'keydesign-framework' ); ?></span>
    <?php endif; ?>
	
    <?php if ( defined( 'KEYDESIGN_THEMEFOREST_THEME_LINK' ) ) : ?>
        <a class="kdadmin-button support-button" href="<?php echo esc_attr( KEYDESIGN_THEMEFOREST_THEME_LINK ); ?>" target="_blank">
            <?php if ( $support_status ) : ?>
                <?php echo esc_html__( 'Extend support', 'keydesign-framework' ); ?>
            <?php else : ?>
                <?php echo esc_html__( 'Renew support', 'keydesign-framework' ); ?>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</div>