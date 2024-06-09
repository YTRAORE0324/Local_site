<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'header_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Header', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Header', 'keydesign-framework' ),
        ),
        'site_header_position' => array(
            'label' => esc_html__( 'Header Position', 'keydesign-framework' ),
            'type' => 'radio',
            'description' => esc_html__( 'Select between fixed or sticky header positioning.', 'keydesign-framework' ),
            'options' => array(
                'header-position-default' => esc_html__( 'Default', 'keydesign-framework' ),
                'sticky-header' => esc_html__( 'Sticky', 'keydesign-framework' ),
            ),
            'value' => 'sticky-header',
            'submenu' => esc_html__( 'Header', 'keydesign-framework' ),
        ),
        'site_header_scroll_up' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Show on Scroll Up', 'keydesign-framework' ),
            'description' => esc_html__( 'Displays the menu only when scrolling up.', 'keydesign-framework' ),
            'value' => true,
            'dependency' => array(
                'key' => 'site_header_position',
                'value' => 'sticky-header'
            ),
            'submenu' => esc_html__( 'Header', 'keydesign-framework' ),
        ),
        'page_title_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Page Title', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Title Bar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the page title bar.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_text_alignment' => array(
            'label' => esc_html__( 'Text Alignment', 'keydesign-framework' ),
            'type' => 'radio',
            'description' => esc_html__( 'Select the text alignment for all elements inside the title bar.', 'keydesign-framework' ),
            'options' => array(
                'title-bar-text-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'title-bar-text-center' => esc_html__( 'Center', 'keydesign-framework' ),
            ),
            'value' => 'title-bar-text-center',
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'group' => 'started',
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_background_color' => array(
            'label' => esc_html__( 'Background Color', 'keydesign-framework' ),
            'type' => 'select',
            'description' => esc_html__( 'Select title bar background color.', 'keydesign-framework' ),
            'options' => array(
                'default-background-color' => esc_html__( 'Default', 'keydesign-framework' ),
                'primary-background-color' => esc_html__( 'Primary', 'keydesign-framework' ),
                'secondary-background-color' => esc_html__( 'Secondary', 'keydesign-framework' ),
                'white-background-color' => esc_html__( 'White', 'keydesign-framework' ),
                'dark-background-color' => esc_html__( 'Dark', 'keydesign-framework' ),
                'gray-background-color' => esc_html__( 'Gray', 'keydesign-framework' ),
            ),
            'value' => 'default-background-color',
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_text_color' => array(
            'label' => esc_html__( 'Text Color', 'keydesign-framework' ),
            'type' => 'select',
            'description' => esc_html__( 'Select title bar text color.', 'keydesign-framework' ),
            'options' => array(
                'default-text-color' => esc_html__( 'Default', 'keydesign-framework' ),
                'primary-text-color' => esc_html__( 'Primary', 'keydesign-framework' ),
                'secondary-text-color' => esc_html__( 'Secondary', 'keydesign-framework' ),
                'white-text-color' => esc_html__( 'White', 'keydesign-framework' ),
                'dark-text-color' => esc_html__( 'Dark', 'keydesign-framework' ),
                'gray-text-color' => esc_html__( 'Gray', 'keydesign-framework' ),
            ),
            'value' => 'default-text-color',
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_content_width' => array(
            'type' => 'number',
            'label' => esc_html__( 'Content Width', 'keydesign-framework' ),
            'step' => 1,
            'placeholder' => esc_html__('E.g. 600', 'keydesign-framework'),
            'description' => esc_html__( 'Control the title bar content width. Pixel value.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_spacing' => array(
            'type' => 'text',
            'label' => esc_html__( 'Top Padding', 'keydesign-framework' ),
            'placeholder' => esc_html__('E.g. 100px', 'keydesign-framework'),
            'description' => esc_html__( 'Control the title bar top padding. Pixel value.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_spacing_bottom' => array(
            'type' => 'text',
            'label' => esc_html__( 'Bottom Padding', 'keydesign-framework' ),
            'placeholder' => esc_html__('E.g. 100px', 'keydesign-framework'),
            'description' => esc_html__( 'Control the title bar bottom padding. Pixel value.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_breadcrumbs' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Breadcrumbs', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the page breadcrumbs trail.', 'keydesign-framework' ),
            'value' => true,
            'dependency' => array(
                'key' => 'title_bar_switch',
                'value' => 'not_empty'
            ),
            'group' => 'started',
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'title_bar_breadcrumbs_position' => array(
            'label' => esc_html__( 'Breadcrumbs Position', 'keydesign-framework' ),
            'type' => 'radio',
            'description' => esc_html__( 'Breadcrumbs position relative to the page title.', 'keydesign-framework' ),
            'options' => array(
                'breadcrumbs-position-top' => esc_html__( 'Above title', 'keydesign-framework' ),
                'breadcrumbs-position-bottom' => esc_html__( 'Below title', 'keydesign-framework' ),
            ),
            'value' => 'breadcrumbs-position-bottom',
            'dependency' => array(
                array(
                    'key' => 'title_bar_switch',
                    'value' => 'not_empty'
                ),
                array(
                    'key' => 'title_bar_breadcrumbs',
                    'value' => 'not_empty'
                )
            ),
            'dependencies' => '&&',
            'group' => 'ended',
            'submenu' => esc_html__( 'Page Title', 'keydesign-framework' ),
        ),
        'page_layout_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Page Layout', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Page Layout', 'keydesign-framework' ),
        ),
        'layout_style' => [
            'type' => 'radio',
            'label' => __( 'Page Layout', 'keydesign-framework' ),
            'description' => esc_html__( 'Select between full-width or boxed page layout.', 'keydesign-framework' ),
            'options' => array(
                'keydesign-default' => esc_html__( 'Default', 'keydesign-framework' ),
                'keydesign-boxed' => esc_html__( 'Boxed', 'keydesign-framework' ),
            ),
            'value' => 'keydesign-default',
            'submenu' => esc_html__( 'Page Layout', 'keydesign-framework' ),
        ],
        'boxed_layout_background_color' => array(
            'label' => esc_html__( 'Body Background Color', 'keydesign-framework' ),
            'type' => 'select',
            'description' => esc_html__( 'Select a background color for the page body area.', 'keydesign-framework' ),
            'options' => array(
                'keydesign-default-bg' => esc_html__( 'Default', 'keydesign-framework' ),
                'keydesign-primary-bg' => esc_html__( 'Primary', 'keydesign-framework' ),
                'keydesign-secondary-bg' => esc_html__( 'Secondary', 'keydesign-framework' ),
                'keydesign-dark-bg' => esc_html__( 'Dark', 'keydesign-framework' ),
                'keydesign-gray-bg' => esc_html__( 'Gray', 'keydesign-framework' ),
            ),
            'value' => 'keydesign-default-bg',
            'dependency' => array(
                'key' => 'layout_style',
                'value' => 'keydesign-boxed'
            ),
            'submenu' => esc_html__( 'Page Layout', 'keydesign-framework' ),
        ),
        'boxed_layout_content_border' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Content Border', 'keydesign-framework' ),
            'description' => esc_html__( 'Select a background color for the page content area.', 'keydesign-framework' ),
            'value' => false,
            'dependency' => array(
                'key' => 'layout_style',
                'value' => 'keydesign-boxed'
            ),
            'submenu' => esc_html__( 'Page Layout', 'keydesign-framework' ),
        ),
        'footer_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Footer', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Footer', 'keydesign-framework' ),
        ),
        'footer_position' => array(
            'label' => esc_html__( 'Footer Position', 'keydesign-framework' ),
            'description' => esc_html__( 'The Sticky option creates a smooth overlapping effect with the above section.', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'footer-position-default' => esc_html__( 'Default', 'keydesign-framework' ),
                'sticky-footer' => esc_html__( 'Sticky', 'keydesign-framework' ),
            ),
            'value' => 'footer-position-default',
            'submenu' => esc_html__( 'Footer', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Layout', 'keydesign-framework' ),
        'icon' => 'lnricons-text-align-center',
        'fields' => $fields
    );

    $setup[ 'layout' ] = $customFields;

    return $setup;

}, 10, 1 );
