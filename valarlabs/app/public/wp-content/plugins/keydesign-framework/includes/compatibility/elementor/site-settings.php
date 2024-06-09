<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function add_global_controls( $element ) {
	$element->start_injection(
		array(
			'of' => 'space_between_widgets',
			'at' => 'before',
		)
	);
	$element->add_control(
		'keydesign_global_border_color',
		[
			'label' => __( 'Global Border Color', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'dynamic' => [],
			'selectors' => [
				'{{WRAPPER}}' => '--color-border: {{VALUE}};',
			],
		]
	);
	$element->add_control(
		'keydesign_global_border_radius',
		[
			'label' => __( 'Global Border Radius', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'isLinked' => 'true',
			'selectors' => [
			   'body' => '--global-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'keydesign_button_border_radius',
		[
			'label' => __( 'Global Button Border Radius', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'isLinked' => 'true',
			'selectors' => [
				'body' => '--button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->end_injection();
}
add_action( 'elementor/element/kit/section_settings-layout/after_section_end', 'add_global_controls', 999, 2 );

function keydesign_update_elementor_typography_settings( $element ) {
	$element->start_injection(
		array(
			'of' => 'paragraph_spacing',
			'at' => 'after',
		)
	);
	$element->add_control(
		'keydesign_paragraph_color',
		[
			'label' => __( 'Paragraph Color', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'dynamic' => [],
			'selectors' => [
				'{{WRAPPER}} p' => 'color: {{VALUE}};',
			],
		]
	);
	$element->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'keydesign_paragraph_typography',
			'label' => __( 'Paragraph Typography', 'keydesign-framework' ),
			'selector' => '{{WRAPPER}} p',
		]
	);
	$element->end_injection();

	$element->update_control(
		'keydesign_paragraph_typography_font_size',
		[
			'selectors' => [
				'{{WRAPPER}} p' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-paragraphs: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->update_control(
		'keydesign_paragraph_typography_font_size_tablet',
		[
			'selectors' => [
				'{{WRAPPER}} p' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-paragraphs: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->update_control(
		'keydesign_paragraph_typography_font_size_mobile',
		[
			'selectors' => [
				'{{WRAPPER}} p' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-paragraphs: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->update_control(
		'keydesign_paragraph_typography_line_height',
		[
			'selectors' => [
				'{{WRAPPER}} p' => 'line-height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--line-height-paragraph: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'body_color',
		[
			'selectors' => [
				'{{WRAPPER}}' => 'color: {{VALUE}};',
				'{{WRAPPER}}' => '--color-text: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'body_typography_font_size',
		[
			'selectors' => [
				'{{WRAPPER}}' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-default: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->update_control(
		'body_typography_font_size_tablet',
		[
			'selectors' => [
				'{{WRAPPER}}' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-default: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->update_control(
		'body_typography_font_size_mobile',
		[
			'selectors' => [
				'{{WRAPPER}}' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--font-size-default: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'body_typography_line_height',
		[
			'selectors' => [
				'{{WRAPPER}}' => 'line-height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}' => '--line-height-default: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$headings = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

    $properties = [
        'font_size' => 'font-size',
        'font_weight' => 'font-weight',
        'line_height' => 'line-height'
    ];

    foreach ($headings as $heading) {
        foreach ($properties as $property => $css_property) {
            $controls = ["{$heading}_typography_{$property}", "{$heading}_typography_{$property}_mobile", "{$heading}_typography_{$property}_tablet"];
            $variable = "--keydesign-{$heading}-{$property}";

            foreach ($controls as $control) {
                $element_selector = "{{WRAPPER}} $heading";

                $unit = ($property === 'font_weight') ? '{{VALUE}}' : '{{SIZE}}{{UNIT}}';

                $element->update_control(
                    $control,
                    [
                        'selectors' => [
                            $element_selector => "$css_property: $unit;",
                            '{{WRAPPER}}' => "$variable: $unit;",
                        ],
                    ]
                );
            }
        }
    }
}
add_action( 'elementor/element/kit/section_typography/after_section_end', 'keydesign_update_elementor_typography_settings', 999, 2 );

// Global Background Controls
function update_background_controls( $element ) {
	$element->start_injection(
		array(
			'of' => 'mobile_browser_background',
			'at' => 'before',
		)
	);
	$element->add_control(
		'keydesign_content_background',
		[
			'label' => esc_html__( 'Page Content Background', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'description' => esc_html__( 'Set background color for the page content area.', 'keydesign-framework' ),
			'separator' => 'before',
			'selectors' => [
				'{{WRAPPER}} #content.site-content' => 'background-color: {{VALUE}}',
			],
		]
	);
	$element->end_injection();
}
add_action( 'elementor/element/kit/section_background/before_section_end', 'update_background_controls', 999, 2 );

// Header controls
function register_header_controls( $document ) {

	if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) ) {
        return;
    }

    if ( get_post_type() == 'elementskit_template' ) {
        return;
    }

	$color_scheme_selectors = [
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .elementskit-navbar-nav-default:not(.active) .elementskit-navbar-nav>li>a',
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .ekit-wid-con .ekit-mini-cart .ekit-dropdown-back',
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .ekit-wid-con .ekit_offcanvas-sidebar.ekit_navSidebar-button',
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .ekit-wid-con .ekit_navsearch-button',
	];

	$bg_color_scheme_selectors = [
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .elementskit-navbar-nav-default:not(.active) .elementskit-navbar-nav>li>a:after',
		'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .ekit-wid-con .elementskit-menu-hamburger .elementskit-menu-hamburger-icon',
	];

	$color_scheme_selector = implode( ',', $color_scheme_selectors );
	$bg_color_scheme_selector = implode( ',', $bg_color_scheme_selectors );

	$document->start_controls_section(
		'section_header',
		[
			'label' => esc_html__( 'Header', 'keydesign-framework' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$document->add_control(
		'keydesign_hide_header',
		[
			'label' => esc_html__( 'Hide Header', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} #site-header' => 'display: none;',
			],
		]
	);

	$document->add_control(
		'site_header_position',
		[
			'label' => esc_html__( 'Position', 'keydesign-framework' ),
			'description' => esc_html__( 'Select site header position. Overwrites the theme options default value.', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'' => esc_html__( 'Default', 'keydesign-framework' ),
				'sticky' => esc_html__( 'Sticky', 'keydesign-framework' ),
				'static' => esc_html__( 'Static', 'keydesign-framework' ),
			],
			'selectors' => [
				'body' => '--transparent-navigation-position: {{VALUE}};',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
			],
		]
	);

	$document->add_control(
		'header_always_visible',
		[
			'label' => esc_html__( 'Always Visible', 'keydesign-framework' ),
			'description' => esc_html__( 'Set site header to be visible at all times. Helpful when using Sticky elements on page.', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} .site-header.sticky-header.show-on-scroll.hide-menu' => 'pointer-events: auto;',
				'{{WRAPPER}} .site-header.sticky-header.show-on-scroll.hide-menu .site-header-wrapper' => 'opacity: 1; transform: none; pointer-events: auto;',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'site_header_position' => [ 'sticky' ],
			],
		]
	);

	$document->add_control(
		'transparent_site_header',
		[
			'label' => esc_html__( 'Transparent Header', 'keydesign-framework' ),
			'description' => esc_html__( 'Enable transparency on the site header container.', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'body' => '--transparent-navigation-position: fixed;',
				'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .elementor>.e-con.e-flex:last-child' => 'background-color: transparent; border: none; box-shadow: none;',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'site_header_position!' => [ 'static' ],
			],
		]
	);

	$document->add_control(
		'transparent_site_header_color_scheme',
		[
			'label' => esc_html__( 'Color Scheme', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'description' => esc_html__( 'Overwrite the transparent header text color.', 'keydesign-framework' ),
			'selectors' => [
				$color_scheme_selector => 'color: {{VALUE}};',
				$bg_color_scheme_selector => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->add_control(
		'transparent_site_header_button_hover_background_color',
		[
			'label' => esc_html__( 'Button Hover Background Color', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'description' => esc_html__( 'Overwrite the header buttons hover background color.', 'keydesign-framework' ),
			'selectors' => [
				'{{WRAPPER}} #site-header:not(.scrolled) .elementskit-btn:hover' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->add_control(
		'transparent_site_header_button_hover_text_color',
		[
			'label' => esc_html__( 'Button Hover Text Color', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'description' => esc_html__( 'Overwrite the header buttons hover text color.', 'keydesign-framework' ),
			'selectors' => [
				'{{WRAPPER}} #site-header:not(.scrolled) .elementskit-btn:hover' => 'color: {{VALUE}};',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->add_control(
		'transparent_site_header_logo',
		[
			'label' => esc_html__( 'Use Seconday Logo', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'description' => esc_html__( 'Use the secondary logo with the transparent header.', 'keydesign-framework' ),
			'selectors' => [
				'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .site-logo-wrapper .primary-logo img' => 'opacity: 0;',
				'{{WRAPPER}} .site-header.sticky-header:not(.scrolled):not(.mobile-menu-active) .site-logo-wrapper .secondary-logo img' => 'opacity: 1;',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->add_control(
		'transparent_site_header_bg_blur',
		[
			'label' => esc_html__( 'Background Blur', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'description' => esc_html__( 'Set blur effect on site header background.', 'keydesign-framework' ),
			'selectors' => [
				'{{WRAPPER}}' => '--header-filter: blur(20px);',
				'{{WRAPPER}} .site-header.sticky-header.scrolled:not(.mobile-menu-active) .elementor>.e-con.e-flex:last-child' => 'background-color: #0000004d;',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->add_control(
		'transparent_site_header_spacing',
		[
			'label' => esc_html__( 'Vertical Spacing', 'keydesign-framework' ),
			'description' => esc_html__( 'Top and bottom spacing on initial state.', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 2,
					'max' => 50,
				],
			],
			'selectors' => [
				'body' => '--transparent-navigation-padding: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'keydesign_hide_header!' => 'yes',
				'transparent_site_header' => 'yes',
			],
		]
	);

	$document->end_controls_section();
}
add_action( 'elementor/documents/register_controls', 'register_header_controls' );

// Footer controls
function register_footer_controls( $document ) {
	if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) ) {
        return;
    }

	if ( get_post_type() == 'elementskit_template' ) {
        return;
    }

	$document->start_controls_section(
		'section_footer',
		[
			'label' => esc_html__( 'Footer', 'keydesign-framework' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$document->add_control(
		'keydesign_hide_footer',
		[
			'label' => esc_html__( 'Hide Footer', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} #site-footer, {{WRAPPER}} .site-footer' => 'display: none;',
			],
		]
	);

	$document->add_control(
		'disable_sticky_footer',
		[
			'label' => esc_html__( 'Disable Sticky Position', 'keydesign-framework' ),
			'description' => esc_html__( 'Set site footer to static position.', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} #site-footer' => 'position: relative;',
			],
			'condition' => [
				'keydesign_hide_footer!' => 'yes',
			],
		]
	);

	$document->add_control(
		'keydesign_hide_back_to_top',
		[
			'label' => esc_html__( 'Hide Back to Top', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} .back-to-top' => 'display: none;',
			],
		]
	);

	$document->end_controls_section();
}
add_action( 'elementor/documents/register_controls', 'register_footer_controls' );


// Global border radius option
function register_global_style_controls( $element ) {
	$element->start_controls_section(
		'section_global_border_radius',
		[
			'label' => esc_html__( 'Global Style', 'keydesign-framework' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$element->add_control(
		'keydesign_global_border_radius',
		[
			'label' => esc_html__( 'Global Border Radius', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'description' => esc_html__( 'Inherit the global border radius value defined in Elementor Panel → Hamburger Menu → Site Settings → Layout.', 'keydesign-framework' ),
			'selectors' => [
				'{{WRAPPER}}' => '--border-radius: var(--global-border-radius)',
			],
		]
	);

	$element->end_controls_section();
}
add_action( 'elementor/element/image/section_style/after_section_end', 'register_global_style_controls' );
add_action( 'elementor/element/section/section_advanced/after_section_end', 'register_global_style_controls' );
add_action( 'elementor/element/column/section_advanced/after_section_end', 'register_global_style_controls' );
add_action( 'elementor/element/container/section_layout/after_section_end', 'register_global_style_controls' );

// Container extra controls
function inject_container_controls( $element ) {
	$element->start_injection(
		array(
			'of' => 'min_height',
			'at' => 'before',
		)
	);
	$element->add_responsive_control(
		'keydesign_max_width',
		[
			'label' => esc_html__( 'Max Width', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1440,
				],
				'vw' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->add_responsive_control(
		'keydesign_container_max_height',
		[
			'label' => esc_html__( 'Max Height', 'keydesign-framework' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
				'vh' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}' => 'max-height: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->end_injection();
}
add_action( 'elementor/element/container/section_layout_container/before_section_end', 'inject_container_controls' );

function update_column_global_style_controls( $element ) {
	$element->update_control(
		'keydesign_global_border_radius',
		[
			'selectors' => [
				'{{WRAPPER}} .elementor-widget-wrap' => 'border-radius: var(--global-border-radius)',
			],
		]
	);
}
add_action( 'elementor/element/column/section_advanced/after_section_end', 'update_column_global_style_controls' );

function update_theme_style_button_controls( $element ) {
	$button_selectors = [
		'{{WRAPPER}} button',
		'{{WRAPPER}} input[type="button"]',
		'{{WRAPPER}} input[type="submit"]',
		'{{WRAPPER}} .elementor-button',
		'{{WRAPPER}} .ekit-wid-con .elementskit-btn',
		'{{WRAPPER}} .ekit-wid-con .elementskit-single-pricing .elementskit-pricing-btn',
	];

	$button_hover_selectors = [
		'{{WRAPPER}} button:hover',
		'{{WRAPPER}} button:focus',
		'{{WRAPPER}} input[type="button"]:hover',
		'{{WRAPPER}} input[type="button"]:focus',
		'{{WRAPPER}} input[type="submit"]:hover',
		'{{WRAPPER}} input[type="submit"]:focus',
		'{{WRAPPER}} .elementor-button:hover',
		'{{WRAPPER}} .elementor-button:focus',
		'{{WRAPPER}} .ekit-wid-con .elementskit-btn:hover',
		'{{WRAPPER}} .ekit-wid-con .elementskit-btn:focus',
		'{{WRAPPER}} .ekit-wid-con .elementskit-single-pricing .elementskit-pricing-btn:hover',
	];

	$button_selector = implode( ',', $button_selectors );
	$button_hover_selector = implode( ',', $button_hover_selectors );

	$element->update_control(
		'button_typography_font_family',
		[
			'selectors' => [
				$button_selector => 'font-family: "{{VALUE}}";',
			],
		]
	);

	$element->update_control(
		'button_typography_font_size',
		[
			'selectors' => [
				$button_selector => 'font-size: {{SIZE}}{{UNIT}}',
			],
		]
	);

	$element->update_control(
		'button_typography_font_size_tablet',
		[
			'selectors' => [
				$button_selector => 'font-size: {{SIZE}}{{UNIT}}',
			],
		]
	);

	$element->update_control(
		'button_typography_font_size_mobile',
		[
			'selectors' => [
				$button_selector => 'font-size: {{SIZE}}{{UNIT}}',
			],
		]
	);

	$element->update_control(
		'button_typography_font_weight',
		[
			'selectors' => [
				$button_selector => 'font-weight: {{VALUE}}',
			],
		]
	);

	$element->update_control(
		'button_typography_text_transform',
		[
			'selectors' => [
				$button_selector => 'text-transform: {{VALUE}}',
			],
		]
	);

	$element->update_control(
		'button_typography_font_style',
		[
			'selectors' => [
				$button_selector => 'font-style: {{VALUE}}',
			],
		]
	);

	$element->update_control(
		'button_typography_text_decoration',
		[
			'selectors' => [
				$button_selector => 'text-decoration: {{VALUE}}',
			],
		]
	);

	$element->update_control(
		'button_typography_line_height',
		[
			'selectors' => [
				$button_selector => 'line-height: {{SIZE}}{{UNIT}}',
			],
		]
	);

	$element->update_control(
		'button_typography_letter_spacing',
		[
			'selectors' => [
				$button_selector => 'letter-spacing: {{SIZE}}{{UNIT}}',
			],
		]
	);

	$element->update_control(
		'button_text_color',
		[
			'selectors' => [
				$button_selector => 'color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_hover_text_color',
		[
			'selectors' => [
				$button_hover_selector => 'color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_background_color',
		[
			'selectors' => [
				$button_selector => 'background-color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_hover_background_color',
		[
			'selectors' => [
				$button_hover_selector => 'background-color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_box_shadow_box_shadow',
		[
			'selectors' => [
				$button_selector => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_hover_box_shadow_box_shadow',
		[
			'selectors' => [
				$button_hover_selector => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_border_radius',
		[
			'selectors' => [
				$button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'button_hover_border_radius',
		[
			'selectors' => [
				$button_hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'button_border_border',
		[
			'selectors' => [
				$button_selector => 'border-style: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_hover_border_border',
		[
			'selectors' => [
				$button_hover_selector => 'border-style: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_border_width',
		[
			'selectors' => [
				$button_selector => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'button_hover_border_width',
		[
			'selectors' => [
				$button_hover_selector => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->update_control(
		'button_border_color',
		[
			'selectors' => [
				$button_selector => 'border-color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_hover_border_color',
		[
			'selectors' => [
				$button_hover_selector => 'border-color: {{VALUE}};',
			],
		]
	);

	$element->update_control(
		'button_padding',
		[
			'selectors' => [
				$button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
}
add_action( 'elementor/element/kit/section_buttons/before_section_end', 'update_theme_style_button_controls' );

function update_page_style_controls( $document ) {
	$document->update_control(
		'background_color',
		[
			'selectors' => [
				'{{WRAPPER}}:not(.elementor-motion-effects-element-type-background), {{WRAPPER}} > .elementor-motion-effects-container > .elementor-motion-effects-layer, {{WRAPPER}} #page .site-content' => 'background-color: {{VALUE}}',
			],
		]
	);
}
add_action( 'elementor/element/wp-page/section_page_style/before_section_end', 'update_page_style_controls' );