<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'maintenance_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Maintenance', 'keydesign-framework' ),
            'description' => esc_html__( 'Set your entire website into maintenance mode. The site will be offline until it is ready to be launched.', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Maintenance Mode', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to enable maintenance mode.', 'keydesign-framework' ),
            'value' => false,
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_page_title' => array(
            'type' => 'text',
            'label' => esc_html__( 'Page Title', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter maintenance page title.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'maintenance_mode_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_page_title_label' => array(
            'type' => 'text',
            'label' => esc_html__( 'Page Title Label', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter maintenance page title label.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'maintenance_mode_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_page_content' => array(
            'type' => 'textarea',
            'label' => esc_html__( 'Page Content', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter maintenance page description.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'maintenance_mode_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_image' => array(
            'type' => 'image',
            'label' => esc_html__( 'Page Image', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'maintenance_mode_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_countdown_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Countdown', 'keydesign-framework' ),
            'description' => esc_html__( 'Display an estimated completion time.', 'keydesign-framework' ),
            'value' => false,
            'dependency' => array(
                'key' => 'maintenance_mode_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_countdown_day' => array(
            'type' => 'text',
            'label' => esc_html__( 'End Day', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter day value. Eg. 05', 'keydesign-framework' ),
            'dependency' => array(
                array(
                    'key' => 'maintenance_mode_switch',
                    'value' => 'not_empty'
                ),
                array(
                    'key' => 'maintenance_mode_countdown_switch',
                    'value' => 'not_empty'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_countdown_month' => array(
            'type' => 'text',
            'label' => esc_html__( 'End Month', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter month value. Eg. 09', 'keydesign-framework' ),
            'dependency' => array(
                array(
                    'key' => 'maintenance_mode_switch',
                    'value' => 'not_empty'
                ),
                array(
                    'key' => 'maintenance_mode_countdown_switch',
                    'value' => 'not_empty'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'maintenance_mode_countdown_year' => array(
            'type' => 'text',
            'label' => esc_html__( 'End Year', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter year value. Eg. 2024', 'keydesign-framework' ),
            'dependency' => array(
                array(
                    'key' => 'maintenance_mode_switch',
                    'value' => 'not_empty'
                ),
                array(
                    'key' => 'maintenance_mode_countdown_switch',
                    'value' => 'not_empty'
                )
            ),
            'dependencies' => '&&',
            'submenu' => esc_html__( 'Maintenance', 'keydesign-framework' ),
        ),
        'search_page_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Search Page', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Search Page', 'keydesign-framework' ),
        ),
        'search_page_title' => array(
            'type' => 'text',
            'label' => esc_html__( 'Page Title', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter search page title.', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Search Page', 'keydesign-framework' ),
        ),
        'search_page_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Display Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the Main Sidebar.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Search Page', 'keydesign-framework' ),
        ),
        'search_page_sidebar_position' => array(
            'label' => esc_html__( 'Sidebar Position', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'sidebar-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'sidebar-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'sidebar-right',
            'dependency' => array(
                'key' => 'search_page_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Search Page', 'keydesign-framework' ),
        ),
        'search_page_sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Sticky Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to keep the sidebar sticky as users scroll.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'ended',
            'dependency' => array(
                'key' => 'search_page_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Search Page', 'keydesign-framework' ),
        ),
        'error_page_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( '404 Page', 'keydesign-framework' ),
            'submenu' => esc_html__( '404 Page', 'keydesign-framework' ),
        ),
        'error_page_title' => array(
            'type' => 'text',
            'label' => esc_html__( 'Page Title', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter 404 page title.', 'keydesign-framework' ),
            'submenu' => esc_html__( '404 Page', 'keydesign-framework' ),
        ),
        'error_page_subtitle' => array(
            'type' => 'text',
            'label' => esc_html__( 'Page Subtitle', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter 404 page subtitle.', 'keydesign-framework' ),
            'submenu' => esc_html__( '404 Page', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Utility Pages', 'keydesign-framework' ),
        'icon' => 'lnricons-wrench',
        'fields' => $fields
    );

    $setup[ 'utility-pages' ] = $customFields;

    return $setup;

}, 10, 1 );
