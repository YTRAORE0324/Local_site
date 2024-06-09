<?php

defined( 'ABSPATH' ) || exit;

class KeyDesign_Typekit_Fonts_Load {

	const TYPEKIT_EMBED_BASE = 'https://use.typekit.net/%s.css';

	private static $instance = null;

	protected $font_css;

	private static $font_base = 'custom-typekit-fonts';

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'typekit_embed_css' ) );
		add_filter( 'elementor/fonts/groups', array( $this, 'elementor_group' ) );
		add_filter( 'elementor/fonts/additional_fonts', array( $this, 'add_elementor_fonts' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'typekit_embed_css' ) );
	}

	public function elementor_group( $font_groups ) {
		$new_group[ self::$font_base ] = __( 'Typekit Fonts', 'custom-typekit-fonts' );
		$font_groups                   = $new_group + $font_groups;
		return $font_groups;
	}

	public function add_elementor_fonts( $fonts ) {
		$kit_list     = get_option( 'custom-typekit-fonts' );
		$all_fonts    = $kit_list['custom-typekit-font-details'];
		$custom_fonts = array();
		if ( ! empty( $all_fonts ) ) {
			foreach ( $all_fonts as $font_family_name => $fonts_url ) {
				$font_slug                 = isset( $fonts_url['slug'] ) ? $fonts_url['slug'] : '';
				$font_css                  = isset( $fonts_url['css_names'][0] ) ? $fonts_url['css_names'][0] : $font_slug;
				$custom_fonts[ $font_css ] = self::$font_base;
			}
		}
		return array_merge( $fonts, $custom_fonts );
	}

	public function typekit_embed_css() {
		if ( false !== $this->get_typekit_embed_url() ) {
			wp_enqueue_style( 'custom-typekit-css', $this->get_typekit_embed_url(), array() );
		}
	}

	private function get_typekit_embed_url() {
		$kit_info = get_option( 'custom-typekit-fonts' );
		if ( empty( $kit_info['custom-typekit-font-details'] ) ) {
			return false;
		}
		return sprintf( self::TYPEKIT_EMBED_BASE, $kit_info['custom-typekit-font-id'] );
	}

	public function add_typekit_fonts( $custom_fonts ) {
		$kit_info = get_option( 'custom-typekit-fonts' );
		if ( empty( $kit_info['custom-typekit-font-details'] ) ) {
			return $custom_fonts;
		}
		foreach ( $kit_info['custom-typekit-font-details'] as $font => $properties ) {
			unset( $kit_info['custom-typekit-font-details'][ $font ] );
			$font = "'" . esc_attr( $font ) . '\',' . esc_attr( $properties['fallback'] );
			$kit_info['custom-typekit-font-details'][ $font ] = $properties;
		}
		$new_custom_fonts = wp_parse_args( $kit_info['custom-typekit-font-details'], $custom_fonts );
		return $new_custom_fonts;
	}
}

KeyDesign_Typekit_Fonts_Load::get_instance();