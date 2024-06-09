<?php

defined( 'ABSPATH' ) || exit;

define( 'KEYDESIGN_PLUGINS_URI', 'https://external.keydesign.xyz/' );

function json_error_notice() {
    echo '<div class="notice notice-error is-dismissible">
        <p>' . esc_html( 'Unable to connect to KeyDesign Plugin server. Failed to retrieve valid JSON data.', 'sierra' ) . '</p>
    </div>';
}

function http_error_notice() {
    echo '<div class="notice notice-error is-dismissible">
		<p>' . esc_html( 'Unable to connect to KeyDesign Plugin server. Failed to fetch data from the server.', 'sierra' ) . '</p>
    </div>';
}

function get_plugin_versions() {
	// Get the JSON data from the specified URL using WordPress HTTP API
	$response = wp_remote_get( KEYDESIGN_PLUGINS_URI . 'versions.json' );
	
	// Check for a successful response
    if ( !is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
        $json_contents = wp_remote_retrieve_body( $response );

        // Decode the JSON data
        $data = json_decode($json_contents, true);

        // Check if JSON decoding was successful and data structure is as expected
        if ( $data !== null && isset( $data ) ) {
            // Access plugin versions and store them in separate variables
            $elementskitVersion = $data['elementskit'];
            $frameworkVersion = $data['framework'];

            // Return an array with plugin versions
            return [
                'elementskit' => $elementskitVersion,
                'framework' => $frameworkVersion
            ];
        } else {
            // Show an admin notice if JSON structure is unexpected
            add_action('admin_notices', 'json_error_notice');
            return null;
        }
    } else {
        // Show an admin notice if the HTTP request fails
        add_action('admin_notices', 'http_error_notice');
        return null;
    }
}

if ( ! function_exists( 'keydesign_register_plugins' ) ) {
	function keydesign_register_plugins() {
		
		$elementskit_source_url = '';
		$elementskit_version = '';
		$framework_source_url = '';
		$framework_version = '';
		
		$plugin_versions = get_plugin_versions();
		
		if ( $plugin_versions !== null ) {
			$elementskit_version = $plugin_versions['elementskit'];
			$framework_version = $plugin_versions['framework'];
			
			$elementskit_source_url = KEYDESIGN_PLUGINS_URI . 'elementskit/elementskit-' . $elementskit_version . '.zip';
			$framework_source_url = KEYDESIGN_PLUGINS_URI . 'keydesign-framework/keydesign-framework-' . $framework_version . '.zip';
		}

		$plugins = array(
			array(
				'name' => esc_html__('Elementor', 'sierra'),
				'slug' => 'elementor',
				'required' => true,
				'external_url' => 'https://wordpress.org/plugins/elementor/',
			),
			array(
				'name' => esc_html__('ElementsKit Lite', 'sierra'),
				'slug' => 'elementskit-lite',
				'required' => true,
				'external_url' => 'https://wordpress.org/plugins/elementskit-lite/',
			),
			array(
				'name' => esc_html__('ElementsKit Pro', 'sierra'),
				'slug' => 'elementskit',
				'source' => $elementskit_source_url,
				'required' => true,
				'version' => $elementskit_version,
				'external_url' => 'https://wpmet.com/plugin/elementskit/',
			),
			array(
				'name' => esc_html__('KeyDesign Framework', 'sierra'),
				'slug' => 'keydesign-framework',
				'source' => $framework_source_url,
				'required' => true,
				'version' => $framework_version,
				'external_url' => '',
			),
			array(
				'name' => esc_html__('WooCommerce', 'sierra'),
				'slug' => 'woocommerce',
				'required' => false,
			),
			array(
				'name' => esc_html__('Contact Form 7', 'sierra'),
				'slug' => 'contact-form-7',
				'required' => true,
			),
		);

		$config = array(
			'id' => 'sierra',
			'default_path' => '',
			'menu' => 'install-required-plugins',
			'has_notices' => true,
			'dismissable' => true,
			'is_automatic' => false,
			'message' => '',
			'strings' => array(
				'page_title' => esc_html__('Install Required Plugins', 'sierra'),
				'menu_title' => esc_html__('Install Plugins', 'sierra'),
				'installing' => esc_html__('Installing Plugin: %s', 'sierra'),
				'oops' => esc_html__('Something went wrong with the plugin API.', 'sierra') ,
				'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'sierra'),
				'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'sierra'),
				'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'sierra'),
				'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'sierra'),
				'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'sierra'),
				'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'sierra'),
				'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'sierra'),
				'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'sierra'),
				'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'sierra'),
				'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'sierra'),
				'return' => esc_html__('Return to Required Plugins Installer', 'sierra') ,
				'plugin_activated' => esc_html__('Plugin activated successfully.', 'sierra') ,
				'complete' => esc_html__('All plugins installed and activated successfully. %s', 'sierra'),
				'nag_type' => 'updated'
			)
		);

		tgmpa( $plugins, $config );
	}

	add_action( 'tgmpa_register', 'keydesign_register_plugins' );
}

if ( ! function_exists( 'keydesign_deactivate_ocdi' ) ) {
	function keydesign_deactivate_ocdi() {
		// Path to the plugin file
		$plugin_file = WP_PLUGIN_DIR . '/one-click-demo-import/one-click-demo-import.php';

		// Check if the plugin file exists
		if ( file_exists( $plugin_file ) ) {
			// Deactivate the plugin
			deactivate_plugins( 'one-click-demo-import/one-click-demo-import.php' );
		}
	}
}
add_action( 'admin_init', 'keydesign_deactivate_ocdi' );