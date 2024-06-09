<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'footer_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Footer', 'keydesign-framework' ),
            'value' => true,
            'description' => esc_html__( 'Turn on to display the theme footer.', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Footer', 'keydesign-framework' ),
        'icon' => 'lnricons-enter-down',
        'fields' => $fields
    );

    $setup[ 'footer' ] = $customFields;

    return $setup;

}, 10, 1 );
