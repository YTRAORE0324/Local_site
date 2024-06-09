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
define( 'AUTH_KEY',          '3j>_fItKPQ`&Xq?2(|4A6LbZ[pvdC%b[oRs-qAVx%yz_8KEJ~k(cHOl$0#C[!Nx(' );
define( 'SECURE_AUTH_KEY',   'S&u=_l]P2-;njNXb-G/$PPBBYD3Lmzm3gaY:RNgCsi{,}/>@%m2z/n4x(jt8zzmW' );
define( 'LOGGED_IN_KEY',     'r3m[PCia8OIGsb23n,76c/iZ`p3zN5JnZVZT6_g)z!Vasoo>+(>/{A)1d3,9$|6n' );
define( 'NONCE_KEY',         '-e!JKF6G)3zNVE%mR(5U:*ujC@?fGwjwRx&a/wsPFB/99sA+Id*qI<S(<~L3M:N?' );
define( 'AUTH_SALT',         '@J&iP|!TtN`~X 4$?$dUa@3zR i,UT~g!9A!_fa|2,(O>IJprA9vU`m:z6rgY]+h' );
define( 'SECURE_AUTH_SALT',  'Ah[B-R`W}ZyGKY*r ~[,U>aSN*36%[NE,AXHz*&+/}flL<r5o5<+#,SwJ1{ag:-S' );
define( 'LOGGED_IN_SALT',    'B9#k3zs2-j]F5$ sk9LsddYfWo6Duh09Ac+f+./Xx-Ry0>_JgO]rD3>DW@3AGZP&' );
define( 'NONCE_SALT',        'V?oMvlyIr2#_0z`<G0+FTR968Jf8QHSs[oE^JrI>YwNck>SR%fZ`%;!jfK8XQUc6' );
define( 'WP_CACHE_KEY_SALT', '/}X7[YTOdA*shn6y=OmIwVvpO_ALe2U!TX1N|vN$09$HPKjpI2Dih9jtV>4sYpoc' );


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
