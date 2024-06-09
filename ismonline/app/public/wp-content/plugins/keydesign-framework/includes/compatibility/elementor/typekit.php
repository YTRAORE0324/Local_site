<?php
use KeyDesign\Utils;
    class KeyDesign_Typekit_Fonts
    {

        private static $instance;

        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct()
        {
            require_once KEYDESIGN_COMPATIBILITY_PATH . '/elementor/typekit-fonts-load.php';
            add_action('init', array($this, 'options_setting'));
        }

        public function options_setting()
        {
            $typekit_id = \KeyDesign\Utils::get_option( 'typekit_id' );
            $option                                = array();
            $option['custom-typekit-font-id']      = $typekit_id;
            $option['custom-typekit-font-details'] = $this->get_custom_typekit_details($option['custom-typekit-font-id']);
            update_option('custom-typekit-fonts', $option);
        }

        public function get_custom_typekit_details($kit_id)
        {
            $typekit_info = array();
            $typekit_uri  = 'https://typekit.com/api/v1/json/kits/' . $kit_id . '/published';
            $response     = wp_remote_get(
                $typekit_uri,
                array(
                    'timeout' => '30',
                )
            );
			
			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
				return $typekit_info;
			}

            $data     = json_decode(wp_remote_retrieve_body($response), true);
            $families = $data['kit']['families'];

            foreach ($families as $family) {
                $family_name = str_replace(' ', '-', $family['name']);
                $typekit_info[$family_name] = array(
                    'family'   => $family_name,
                    'fallback' => str_replace('"', '', $family['css_stack']),
                    'weights'  => array(),
                );

                foreach ($family['variations'] as $variation) {
                    $variations = str_split($variation);
                    switch ($variations[0]) {
                        case 'n':
                            $style = 'normal';
                            break;
                        default:
                            $style = 'normal';
                            break;
                    }

                    $weight = $variations[1] . '00';

                    if (!in_array($weight, $typekit_info[$family_name]['weights'])) {
                        $typekit_info[$family_name]['weights'][] = $weight;
                    }
                }

                $typekit_info[$family_name]['slug']      = $family['slug'];
                $typekit_info[$family_name]['css_names'] = $family['css_names'];
            }

            return $typekit_info;
        }
    }

    KeyDesign_Typekit_Fonts::get_instance();
