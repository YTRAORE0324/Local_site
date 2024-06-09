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
define( 'AUTH_KEY',          '/0fZ&Ub=@*8gx^f{eP0`dD8_BBU kef<-FKup6g#NS|H}`~dP=1ab5h9WQiHVkV5' );
define( 'SECURE_AUTH_KEY',   '(.eSxn!?lFB^M9T5A.bwz6pHWcWW]1dC_Es 341z+1#%yUx52<F[&I8GObD)L98*' );
define( 'LOGGED_IN_KEY',     'vip[,8P<L#XPE9KOx).2dB&`xBodC~]y!<e3-m<>a(h#u59eA2pUMUYa$mtcv`[/' );
define( 'NONCE_KEY',         'K|l3 :Dh=B3,`8d)S(>z3WDW@3K0XP{o*abedk_QF=<ZB>vl?_{Oy21q1:1zdh(r' );
define( 'AUTH_SALT',         '=$(6m|!6(aZ)Is%Z0O=FUkK-u|Hzf7+1Fcy>lr^65[Ke4$k5P8:H6Q(SuVi4e*y!' );
define( 'SECURE_AUTH_SALT',  ';FT v`rtq5z~ypPQh=(|Si q-t%GE($(aL7H-vJp;Qir5!93AO<]r,XrCh0yE+@9' );
define( 'LOGGED_IN_SALT',    '4DXxZ/;62XjHam~@Z.HzAozG{f0k_RbrE>:&<sxAQ;Os;X,2Y#e =<W!Kon!W9!S' );
define( 'NONCE_SALT',        '@oRPep&Red2%M1[Gf gEbT^SH6_#&i $.=3>60@65^16&~#>jPCYa3@~cPKTIrS8' );
define( 'WP_CACHE_KEY_SALT', 'e|Til+o?mq5DSAO9@<#aP,BZ1a1Y,}9NesYnJ0DHV(-MH0]B;D3/dvZTBhg{73/m' );


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
