<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'general_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'General', 'keydesign-framework' ),
            'submenu' => esc_html__( 'General', 'keydesign-framework' ),
        ),
        'smooth_scroll_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Smooth Scroll', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to replace basic website scrolling effect with nice smooth scroll.', 'keydesign-framework' ),
            'value' => false,
            'submenu' => esc_html__( 'General', 'keydesign-framework' ),
        ),
		'link_effect' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Link Effect', 'keydesign-framework' ),
            'description' => esc_html__( 'Select hover effects for simple text links.', 'keydesign-framework' ),
            'options' => array(
                'default-link-effect' => esc_html__( 'Default', 'keydesign-framework' ),
                'underline-link-effect' => esc_html__( 'Underline', 'keydesign-framework' ),
				'overlay-link-effect' => esc_html__( 'Overlay', 'keydesign-framework' ),
            ),
            'submenu' => esc_html__( 'General', 'keydesign-framework' ),
            'value' => 'default-link-effect',
        ),
        'button_effect' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Button Effect', 'keydesign-framework' ),
            'description' => esc_html__( 'Select hover effects for button elements.', 'keydesign-framework' ),
            'options' => array(
                'default-button-effect' => esc_html__( 'Default', 'keydesign-framework' ),
                'zoom-button-effect' => esc_html__( 'Zoom', 'keydesign-framework' ),
                'flip-button-effect' => esc_html__( 'Flip', 'keydesign-framework' ),
            ),
            'submenu' => esc_html__( 'General', 'keydesign-framework' ),
            'value' => 'default-button-effect',
        ),
        'integrations_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Integrations', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Integrations', 'keydesign-framework' ),
        ),
		'typekit_id' => array(
            'type' => 'text',
            'label' => esc_html__( 'Adobe Fonts', 'keydesign-framework' ),
            'description' => sprintf(
				esc_html__( 'Enter your Adobe Fonts Project ID. %1$sLearn how to get the code%2$s.', 'keydesign-framework' ),
				'<a href="https://docs.keydesign.xyz/knowledge-base/using-adobe-typekit-fonts/" target="_blank">',
				'</a>'
			),
			'submenu' => esc_html__('Integrations', 'keydesign-framework'),
        ),
        'google_maps_api' => array(
            'type' => 'text',
            'label' => esc_html__( 'Google Maps', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter your Google Maps API key.', 'keydesign-framework' ),
            'description' => sprintf(
				esc_html__( 'Enter your Google Maps API key for map functionality. %1$sLearn how to generate the API key%2$s.', 'keydesign-framework' ),
				'<a href="https://docs.keydesign.xyz/knowledge-base/generate-a-google-maps-api-key/" target="_blank">',
				'</a>'
			),
			'submenu' => esc_html__('Integrations', 'keydesign-framework'),
        ),
        'elementor_group_options' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Elementor Settings', 'keydesign-framework' ),
            'group' => 'started',
            'submenu' => esc_html__( 'Integrations', 'keydesign-framework' ),
        ),
        'elementor_default_library' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Template Library', 'keydesign-framework' ),
            'description' => esc_html__( 'Toggle between Elementor and KeyDesign Template Library.', 'keydesign-framework' ),
            'options' => array(
                'keydesign-library' => esc_html__( 'KeyDesign Library', 'keydesign-framework' ),
                'default-library' => esc_html__( 'Elementor Library', 'keydesign-framework' ),
            ),
            'value' => 'keydesign-library',
            'group' => 'ended',
            'submenu' => esc_html__( 'Integrations', 'keydesign-framework' ),
        ),
        'back_to_top_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Back to Top', 'keydesign-framework' ),
            'description' => esc_html__( 'Display a back to top button that becomes visible when the user starts to scroll the page.', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Back to Top', 'keydesign-framework' ),
        ),
        'go_top_button' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Back to Top', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to enable the Back to Top button which adds the scrolling to top functionality.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Back to Top', 'keydesign-framework' ),
        ),
        'go_top_button_position' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Back to Top Position', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the Back to Top button position.', 'keydesign-framework' ),
            'options' => array(
                'left-aligned' => esc_html__( 'Left', 'keydesign-framework' ),
                'right-aligned' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'right-aligned',
            'dependency' => array(
                'key' => 'go_top_button',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Back to Top', 'keydesign-framework' ),
        ),
        'go_top_button_color' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Back to Top Color', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the Back to Top button color scheme.', 'keydesign-framework' ),
            'options' => array(
                'primary-color' => esc_html__( 'Primary', 'keydesign-framework' ),
                'secondary-color' => esc_html__( 'Secondary', 'keydesign-framework' ),
            ),
            'value' => 'primary-color',
            'dependency' => array(
                'key' => 'go_top_button',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Back to Top', 'keydesign-framework' ),
        ),
        'go_top_button_style' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Back to Top Style', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the Back to Top button style. The Scroll progress option shows a page scroll progress bar.', 'keydesign-framework' ),
            'options' => array(
                'classic-style' => esc_html__( 'Classic', 'keydesign-framework' ),
                'scroll-progress-style' => esc_html__( 'Scroll progress', 'keydesign-framework' ),
            ),
            'value' => 'scroll-progress-style',
            'dependency' => array(
                'key' => 'go_top_button',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Back to Top', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Global Options', 'keydesign-framework' ),
        'icon' => 'lnricons-cog',
        'fields' => $fields
    );

    $setup[ 'global-options' ] = $customFields;

    return $setup;

}, 10, 1 );
