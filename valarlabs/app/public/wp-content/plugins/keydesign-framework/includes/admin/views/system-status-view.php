<?php
namespace KeyDesign;

use KeyDesign\Admin\System_Status;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

System_Status::init_vars();

require_once KEYDESIGN_PATH . 'includes/admin/views/welcome-panel.php'; ?>

<div class="keydesign-system-status">

    <table class="keydesign-system-status-theme-info widefat">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'Theme information', 'keydesign-framework' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php esc_html_e( 'Name:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The name of the current active theme.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'theme_name' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'Version:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The installed version of the current active theme.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_theme_version(); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'Child theme:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Is the child theme in use?', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::yes_null( System_Status::get_var( 'is_child_theme' ) ) ); ?></th>
        </tr>
		<tr>
            <td><?php esc_html_e( 'Connection to KeyDesign API:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Returns connection status with KeyDesign API server.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_api_connection_status(); ?></th>
        </tr>
        </tbody>
    </table>

    <table class="keydesign-system-status-wordpress widefat">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'WordPress environment', 'keydesign-framework' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php esc_html_e( 'WordPress address (URL):', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The URL of your site\'s homepage.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_url( System_Status::get_var( 'wp_home_url' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'Site address (URL):', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The root URL of your WordPress installation.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_url( System_Status::get_var( 'wp_site_url' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress path:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'System path of your WordPress root directory.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'wp_abspath' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress content path:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'System path of your wp-content directory.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'wp_content_dir' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress version:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The version of WordPress installed on your site.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_wp_version(); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress multisite:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Whether or not you have WordPress Multisite enabled.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::yes_null( System_Status::get_var( 'wp_multisite' ) ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress memory limit:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The maximum amount of memory (RAM) that your site can use at one time.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_memory_limit(); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'WordPress debug mode:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Displays whether or not WordPress is in Debug Mode.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo System_Status::yes_null( System_Status::get_var( 'wp_debug' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'Language:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The current language used by WordPress.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'wp_language' ) ); ?></th>
        </tr>
        </tbody>
    </table>

    <table class="keydesign-system-status-server widefat">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'Server environment', 'keydesign-framework' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php esc_html_e( 'Server info:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Information about the web server that is currently hosting your site.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'server_info' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'PHP version:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The version of PHP installed on your hosting server.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_php_version(); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'PHP post max size:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The largest filesize that can be contained in one post.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( size_format( System_Status::get_var( 'php_post_max_size' ) ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'PHP time limit:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups).', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_php_max_execution_time() ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'PHP max input vars:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo System_Status::display_php_max_input_vars(); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'Max upload size:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The largest filesize that can be uploaded to your WordPress installation.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo size_format( System_Status::get_var( 'max_upload_size' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'MySQL version:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The version of MySQL installed on your hosting server.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'mysql_version' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'cURL version:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'The version of cURL installed on your hosting server.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo esc_html( System_Status::get_var( 'curl_version' ) ); ?></th>
        </tr>
        <tr>
            <td><?php esc_html_e( 'DOMDocument:', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'DOMDocument is required for the theme Demo Import feature to properly function.', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php echo System_Status::yes_no( System_Status::get_var( 'domdocument' ) ); ?></th>
        </tr>
		<tr>
            <td><?php esc_html_e( 'Secure connection (HTTPS):', 'keydesign-framework' ); ?></td>
            <td class="help">
                <i class="dashicons dashicons-info" title="<?php esc_attr_e( 'Is the connection to your website secure?', 'keydesign-framework' ); ?>"></i>
            </td>
            <th><?php System_Status::display_secure_connection(); ?></th>
        </tr>
        </tbody>
    </table>
</div>