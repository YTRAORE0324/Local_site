<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'portfolio_settings_section_title' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Portfolio Settings', 'keydesign-framework' ),
            'description' => sprintf(
				esc_html__( 'Note: After making changes to this section, you need to %1$sflush the rewrite rules%2$s.', 'keydesign-framework' ),
				'<a href="https://docs.keydesign.xyz/documentation/flush-rewrite-rules/" target="_blank">',
				'</a>'
			),
            'submenu' => esc_html__( 'Portfolio Settings', 'keydesign-framework' ),
        ),
        'portfolio_cpt_switch' => array(
            'type' => 'radio',
            'label' => esc_html__( 'Portfolio Post Type', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to enable the portfolio post type.', 'keydesign-framework' ),
			'options' => array(
                'enable' => esc_html__( 'Enable', 'keydesign-framework' ),
                'disable' => esc_html__( 'Disable', 'keydesign-framework' ),
            ),
            'value' => 'enable',
            'submenu' => esc_html__( 'Portfolio Settings', 'keydesign-framework' ),
        ),
        'portfolio_cpt_slug' => array(
            'type' => 'text',
            'label' => esc_html__( 'Portfolio Slug', 'keydesign-framework' ),
            'description' => esc_html__( 'Use this field to overwrite the portfolio slug.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'portfolio_cpt_switch',
                'value' => 'enable'
            ),
            'submenu' => esc_html__( 'Portfolio Settings', 'keydesign-framework' ),
        ),
        'portfolio_cpt_category_slug' => array(
            'type' => 'text',
            'label' => esc_html__( 'Portfolio Category Slug', 'keydesign-framework' ),
            'description' => esc_html__( 'Use this field to overwrite the portfolio category slug.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'portfolio_cpt_switch',
                'value' => 'enable'
            ),
            'submenu' => esc_html__( 'Portfolio Settings', 'keydesign-framework' ),
        ),
        'portfolio_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
        'portfolio_pagination_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Previous/Next Pagination', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display previous/next pagination.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
        'portfolio_related_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Related Portfolio Items', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display related portfolio items.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
        'portfolio_related_title' => array(
            'type' => 'text',
            'label' => esc_html__( 'Related Portfolio Section Title', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter a title for the Related Portfolio Items section.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'portfolio_related_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
        'portfolio_related_number' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Number of Related Portfolio Items', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the number of related items.', 'keydesign-framework' ),
            'min' => 2,
            'max' => 4,
            'step' => 1,
            'value' => 3,
            'dependency' => array(
                'key' => 'portfolio_related_switch',
                'value' => 'not_empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
        'portfolio_comments_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Comments Section', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display comments.', 'keydesign-framework' ),
            'value' => false,
            'submenu' => esc_html__( 'Single Portfolio', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Portfolio', 'keydesign-framework' ),
        'icon' => 'lnricons-pictures',
        'fields' => $fields
    );

    $setup[ 'portfolio' ] = $customFields;

    return $setup;

}, 10, 1 );
