<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Image widget
function keydesign_image_widget_controls( $element ) {
    // Add pointer events control
    $element->add_control(
        'keydesign_image_pointer_events',
        [
            'label' => esc_html__( 'Pointer events', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'all' => esc_html__( 'All', 'keydesign-framework' ),
                'none' => esc_html__( 'None', 'keydesign-framework' ),
            ],
            'default' => 'all',
            'selectors' => [
                '{{WRAPPER}} img' => 'pointer-events: {{VALUE}};',
            ],
        ]
    );
}
add_action( 'elementor/element/image/section_image/before_section_end', 'keydesign_image_widget_controls' );

// Icon List widget
function keydesign_icon_list_widget_controls( $element ) {
    $element->update_control(
		'text_color_hover',
		[
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				'.underline-link-effect {{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text:after' => 'background-color: {{VALUE}};',
			],
		]
	);
}
add_action( 'elementor/element/icon-list/section_text_style/before_section_end', 'keydesign_icon_list_widget_controls' );