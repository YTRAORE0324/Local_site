<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'header_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Header', 'keydesign-framework' ),
            'value' => true,
            'description' => esc_html__( 'Turn on to display the theme header.', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Header', 'keydesign-framework' ),
        'icon' => 'lnricons-enter-up',
        'fields' => $fields
    );

    $setup[ 'header' ] = $customFields;

    return $setup;

}, 10, 1 );
