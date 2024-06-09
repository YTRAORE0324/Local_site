<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '7k8%3|<X>f&`gNTc0i(%TcFBjcz&S,,SzW/oP/mx{&$z,uH1{>rQZ%*q_Qi#[v#d' );
define( 'SECURE_AUTH_KEY',   'eMXM$b,(nwn7i54?/zB)*a[O7Eul~9bfT!Ts!aZ!gDU3Ncp88vwLuXm+|2Fsf1wV' );
define( 'LOGGED_IN_KEY',     ']Z#`3 c]#fEn`A2}rHj{~(CLhL]x[l-Cc}iGuj/`!yM|J,Uxv$Ie|7!&WxZgIUn{' );
define( 'NONCE_KEY',         '7bpQcg(tsCya672hbP7Q9j``ZA=foo)GJ9DTsjRI:s4NSAEQ8B|^rZnJH4}mLhNr' );
define( 'AUTH_SALT',         '^D=UvR|tk?^U)n-;2ok(nL0 1i;l+}0(LLR(E6&Al,|XitHS N0xYT)ZR`5N<]|d' );
define( 'SECURE_AUTH_SALT',  'Q%ve|^8Cdlkjd+0 nm7w{Lvfxom%N0IS?ou7M{Me0q5h6#A4]x&9ft/@Zs$/Y@dN' );
define( 'LOGGED_IN_SALT',    'VFA3(YyC;nuN<avl. 0affW[N!#}vhu&OQlj|r7N4ztu8yY4,[$(mODN.a-YgH@,' );
define( 'NONCE_SALT',        '56>b(;SMhYLU;PQ7 Bt}:*p%,?jD2@S~x}KG/rd;w`Sliw3`ZL2A{$6}n)N(h4$W' );
define( 'WP_CACHE_KEY_SALT', 'wuh>$*n|},Y_=k&:i!MM)F{k,yGKryj;4T.2qz3xh.Q(SBhJCBCd;wKh~WI@j`qX' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
