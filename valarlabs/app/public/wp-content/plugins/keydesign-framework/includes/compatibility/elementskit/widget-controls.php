<?php
use \ElementsKit_Lite\Modules\Controls\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Pricing table widget
function ekit_pricing_table_widget_controls( $element ) {
    // Fix Pricing Table Divider style dropdown
    $element->update_control(
        'ekit_pricing_divider_style',
        [
            'condition' => [
                'ekit_pricing_list_divider' => 'yes',
            ],
        ]
    );

    // Fix Pricing Table List Gap
    $element->update_control(
        'ekit_pricing_divider_gap',
        [
            'selectors' => [
                '{{WRAPPER}} .elementskit-single-pricing .elementskit-pricing-lists li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}; margin-bottom: 0;',
            ],
        ]
    );
}
add_action( 'elementor/element/elementskit-pricing/ekit_pricing_section_content_style/before_section_end', 'ekit_pricing_table_widget_controls' );

// Accordion widget
function ekit_accordion_widget_controls( $element ) {
    $element->add_control(
        'ekit_accordion_title_hover_color', [
            'label' => esc_html__( 'Hover Color', 'keydesign-framework' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementskit-accordion .elementskit-card .elementskit-card-header>.elementskit-btn-link:hover' => 'color: {{VALUE}};'
            ],
        ]
    );
}
add_action( 'elementor/element/elementskit-accordion/ekit_accordion_section_title_style/before_section_end', 'ekit_accordion_widget_controls' );

// Heading widget
function ekit_heading_widget_controls( $element ) {
    $element->start_injection(
		array(
			'of' => 'subheading_outline_heading',
			'at' => 'after',
		)
	);

    $element->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        array(
            'name' => 'subheading_outline_bg',
            'label' => esc_html__( 'Background Type', 'keydesign-framework' ),
            'selector' => '{{WRAPPER}} .ekit-heading__subtitle-has-border',
            'condition' => [
                'ekit_heading_sub_title_outline' => 'yes'	
            ],
        )
    );

    $element->end_injection();
}
add_action( 'elementor/element/elementskit-heading/ekit_heading_section_sub_title_style/before_section_end', 'ekit_heading_widget_controls' );

// Icon Box widget
function ekit_icon_box_widget_controls( $element ) {
    $element->start_injection(
		array(
			'of' => 'ekit_icon_box_badge_padding',
			'at' => 'before',
		)
	);

    $element->add_responsive_control(
        'keydesign_ekit_icon_box_badge_margin',
        [
            'label' => esc_html__( 'Margin', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .ekit-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->end_injection();
}
add_action( 'elementor/element/elementskit-icon-box/ekit_icon_box_badge_style_tab/before_section_end', 'ekit_icon_box_widget_controls' );

// Woo Product Carousel widget
function ekit_woo_product_carousel_widget_controls( $element ) {
    // Fix navigation conditions
    $element->update_control(
        'ekit_both_position',
        [
            'condition' => [
                'ekit_navigation' => 'both',
            ],
        ]
    );

	$element->update_control(
        'ekit_arrows_position',
        [
            'condition' => [
                'ekit_navigation' => 'arrows',
            ],
        ]
    );

	$element->update_control(
        'ekit_dots_position',
        [
            'condition' => [
                'ekit_navigation' => 'dots',
            ],
        ]
    );
}
add_action( 'elementor/element/elementskit-woo-product-carousel/ekit_section_content_navigation/before_section_end', 'ekit_woo_product_carousel_widget_controls' );

function ekit_woo_product_carousel_navigation_widget_controls( $element ) {

	$element->update_control(
        'ekit_arrows_prev_icons',
        [
            'condition' => null,
        ]
    );

	$element->update_control(
        'ekit_arrows_next_icons',
        [
            'condition' => null,
        ]
    );
}
add_action( 'elementor/element/elementskit-woo-product-carousel/ekit_section_style_navigation/before_section_end', 'ekit_woo_product_carousel_navigation_widget_controls' );

// Contact Form 7 widget
function ekit_contact_form7_widget_controls( $element ) {

    $element->start_controls_section(
        'keydesign_contact_form7_message_style',
        [
            'label' => esc_html__( 'Messages', 'keydesign-framework' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_inline_message_color', [
            'label' => esc_html__( 'Inline Message Color', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7-not-valid-tip' => 'color: {{VALUE}};'
            ],
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_success_message_heading',
        [
            'label' => esc_html__( 'Success Message', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::HEADING,
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_success_message_text_color', [
            'label' => esc_html__( 'Text Color', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'color: {{VALUE}};'
            ],
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_success_message_border_color', [
            'label' => esc_html__( 'Border Color', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'border-color: {{VALUE}};'
            ],
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_error_message_heading',
        [
            'label' => esc_html__( 'Error Message', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::HEADING,
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_error_message_text_color', [
            'label' => esc_html__( 'Text Color', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'color: {{VALUE}};'
            ],
        ]
    );
    $element->add_control(
        'keydesign_contact_form7_error_message_border_color', [
            'label' => esc_html__( 'Border Color', 'keydesign-framework' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'border-color: {{VALUE}};'
            ],
        ]
    );
    $element->end_controls_section();
}
add_action( 'elementor/element/elementskit-contact-form7/ekit_contact_form_button_style_holder/after_section_end', 'ekit_contact_form7_widget_controls' );