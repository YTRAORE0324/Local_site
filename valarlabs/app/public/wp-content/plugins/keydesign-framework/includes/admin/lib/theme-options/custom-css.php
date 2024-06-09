<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'custom_css' => array(
            'type' => 'ace_editor',
            'label' => esc_html__( 'CSS Editor', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter the custom CSS code in the side field. Do not include any tags or HTML in the field. Custom CSS added here will overwrite the theme CSS.', 'keydesign-framework' ),
            'lang' => 'css'
        ),
        'custom_js' => array(
            'type' => 'ace_editor',
            'label' => esc_html__( 'JS Editor', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter the custom JavaScript code in the side field.', 'keydesign-framework' ),
            'lang' => 'javascript'
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Custom CSS/JS', 'keydesign-framework' ),
        'icon' => 'lnricons-code',
        'fields' => $fields
    );

    $setup[ 'custom-css' ] = $customFields;

    return $setup;

}, 10, 1 );
