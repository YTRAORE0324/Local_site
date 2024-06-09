<?php
namespace KeyDesign;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use KeyDesign\Utils;

$theme_name = Utils::get_parent_theme_name();
$theme_version = Utils::get_parent_theme_version();
$license_key = License\Admin::get_license_key();
?>

<div class="keydesign-welcome-panel">
    <div class="keydesign-welcome-panel-header">
        <div class="keydesign-welcome-panel-column-container">
            <div class="keydesign-welcome-panel-column">
                <h1 class="welcome-panel-title"><?php printf( esc_html__( 'Welcome to %1$s', 'keydesign-framework' ), Utils::get_parent_theme_name() ); ?></h1>
                <?php if ( empty( $license_key ) ) : ?>
                    <p class="welcome-panel-description"><?php printf( esc_html__( '%1$s theme is now installed and ready to use. Please register your purchase to get access to starter sites, Elementor template library blocks and auto updates.', 'keydesign-framework' ), $theme_name ); ?></p>
                <?php else : ?>
                    <p class="welcome-panel-description"><?php printf( esc_html__( '%1$s theme is now registered and ready to use. Enjoy full customization and build a professional-looking website with ease.', 'keydesign-framework' ), $theme_name ); ?></p>
                <?php endif; ?>
            </div>
            <div class="keydesign-welcome-panel-column keydesign-theme-thumb">
				<?php if ( defined( 'KEYDESIGN_THEME_THUMBNAIL' ) ) : ?>
                	<img src="<?php echo esc_url( KEYDESIGN_THEME_THUMBNAIL ); ?>" alt="" />
				<?php endif; ?>
                <p class="keydesign-theme-version"><?php printf( esc_html__( 'Version: %s', 'keydesign-framework' ), $theme_version ); ?></p>
            </div>
        </div>
    </div>
    <div class="keydesign-dashboard-tabs">
        <ul class="keydesign-dashboard-tabs-list">
            <li class="dashboard-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=keydesign-dashboard' ) ); ?>"><?php echo esc_html__( 'Dashboard', 'keydesign-framework' ); ?></a></li>
            <li class="theme-options-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=theme-options' ) ); ?>"><?php echo esc_html__( 'Theme Options', 'keydesign-framework' ); ?></a></li>
			<?php if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) : ?>
            	<li class="site-settings-tab"><a href="<?php echo esc_url_raw( Compatibility\KeyDesign_Elementor::get_site_settings_link() ); ?>"><?php echo esc_html__( 'Site Settings', 'keydesign-framework' ); ?></a></li>
			<?php endif; ?>
            <li class="plugins-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=install-required-plugins' ) ); ?>"><?php echo esc_html__( 'Plugins', 'keydesign-framework' ); ?></a></li>
            <li class="demos-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=import-demos' ) ); ?>"><?php echo esc_html__( 'Starter Sites', 'keydesign-framework' ); ?></a></li>
            <li class="system-status-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=keydesign-system-status' ) ); ?>"><?php echo esc_html__( 'System Status', 'keydesign-framework' ); ?></a></li>
            <li class="help-tab"><a href="<?php echo esc_url_raw( admin_url( 'admin.php?page=keydesign-help' ) ); ?>"><?php echo esc_html__( 'Help', 'keydesign-framework' ); ?></a></li>
        </ul>
    </div>
</div>
