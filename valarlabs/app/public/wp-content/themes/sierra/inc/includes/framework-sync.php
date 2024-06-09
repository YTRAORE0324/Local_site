<?php

// Set framework constants
define( 'KEYDESIGN_THEME_THUMBNAIL', KEYDESIGN_THEME_URI . 'assets/img/thumbnail.png' );

define( 'KEYDESIGN_ELEMENTOR_PRIMARY_COLOR', '#4353ff' );
define( 'KEYDESIGN_ELEMENTOR_SECONDARY_COLOR', '#38d996' );
define( 'KEYDESIGN_ELEMENTOR_TEXT_COLOR', '#1a1a1a' );
define( 'KEYDESIGN_ELEMENTOR_ACCENT_COLOR', '#4353ff' );
define( 'KEYDESIGN_ELEMENTOR_LIGHT_COLOR', '#F5F5F5' );

define( 'KEYDESIGN_ELEMENTOR_PRIMARY_FONT_FAMILY', 'Inter' );
define( 'KEYDESIGN_ELEMENTOR_PRIMARY_FONT_WEIGHT', '700' );

define( 'KEYDESIGN_ELEMENTOR_SECONDARY_FONT_FAMILY', 'Inter' );
define( 'KEYDESIGN_ELEMENTOR_SECONDARY_FONT_WEIGHT', '600' );

define( 'KEYDESIGN_ELEMENTOR_TEXT_FONT_FAMILY', 'Inter' );
define( 'KEYDESIGN_ELEMENTOR_TEXT_FONT_WEIGHT', '400' );

define( 'KEYDESIGN_ELEMENTOR_ACCENT_FONT_FAMILY', 'Inter' );
define( 'KEYDESIGN_ELEMENTOR_ACCENT_FONT_WEIGHT', '500' );

define( 'KEYDESIGN_THEMEFOREST_THEME_LINK', 'https://1.envato.market/sierra-support' );

update_option( 'KEYDESIGN_API_PRODUCT_ID', '0F4ECBFF' );

// Return demo import config
if ( ! function_exists( 'keydesign_demo_content' ) ) {
    function keydesign_demo_content() {
        $keydesign_demos = [
            ["id" => 1,"name" => 'Startup', "file" => "startup", "preview" => "https://sierra.keydesign.xyz/startup/" ],
            ["id" => 2,"name" => 'Helpdesk', "file" => "helpdesk", "preview" => "https://sierra.keydesign.xyz/helpdesk/" ],
            ["id" => 3,"name" => 'Marketing Automation', "file" => "marketing-automation", "preview" => "https://sierra.keydesign.xyz/marketing-automation/" ],
            ["id" => 4,"name" => 'CRM', "file" => "crm", "preview" => "https://sierra.keydesign.xyz/crm/" ],
            ["id" => 5,"name" => 'Web App', "file" => "web-app", "preview" => "https://sierra.keydesign.xyz/web-app/" ],
            ["id" => 6,"name" => 'Digital Agency', "file" => "digital-agency", "preview" => "https://sierra.keydesign.xyz/digital-agency/" ],
            ["id" => 7,"name" => 'SaaS', "file" => "saas", "preview" => "https://sierra.keydesign.xyz/saas/" ],
            ["id" => 8,"name" => 'Analytics', "file" => "analytics", "preview" => "https://sierra.keydesign.xyz/analytics/" ],
            ["id" => 9,"name" => 'Chatbot', "file" => "chatbot", "preview" => "https://sierra.keydesign.xyz/chatbot/" ],
            ["id" => 10,"name" => 'AI Software', "file" => "ai-software", "preview" => "https://sierra.keydesign.xyz/ai-software/" ],
            ["id" => 11,"name" => 'Mobile App', "file" => "mobile-app", "preview" => "https://sierra.keydesign.xyz/mobile-app/" ],
            ["id" => 12,"name" => 'Digital Product', "file" => "digital-product", "preview" => "https://sierra.keydesign.xyz/digital-product/" ],
        ];
        return $keydesign_demos;
    }
}