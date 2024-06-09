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
define( 'AUTH_KEY',          'Mi^,CrbfC{HFRvn5=v~5t9WrWpTDs1A{KhE`<^f6n:v,.e_k+v*La0FbgZ?L~Y2L' );
define( 'SECURE_AUTH_KEY',   'zUaLt:,;z 5:]r/i<#9(0o##vV`F2b~mu~}0`~(XupBDA!tF:JJV6#L|uh)Ne=V/' );
define( 'LOGGED_IN_KEY',     'bf->LxK5vNG:MVP3mx&%m}1[it_ESU6+BvPylqUCO G%OKNijoz!M^.iIH3qiA#Y' );
define( 'NONCE_KEY',         'nla^l* Z9*za/Y}5G13sb!85ub96_7v(Yedq#z-][p@U9R*nW%Tkm4?JMm 50+#j' );
define( 'AUTH_SALT',         'Dd^d3X0Z~IRn]ay+PM LN5I6| 1X;?7P/_3nVU<|)3w_nWxfr:Fz5%)]==AtH@k;' );
define( 'SECURE_AUTH_SALT',  '~lC229(=lx@esyniMN0dMZ.D0iU,j<G9xK3S[9XcC5O*5Y4}z_mxD=:WxJZ;~/Yr' );
define( 'LOGGED_IN_SALT',    'LV&t[W+p Tz6#hvo~@`7E~bND)-p?gGP]I)nn4xF{/|9ikCff2m6Qg2`57,ff!77' );
define( 'NONCE_SALT',        'N_h~.u58b7!5D~Z|j@r5J=r+C1`bfnk3@zc4}?N1+$Z+aq&Hf[n0v5]Sqm3Dg&C2' );
define( 'WP_CACHE_KEY_SALT', 'f%Vss1K>a6XE.}GM~W@w]lE@tg{>aWl6Vl}bv9vs*MSF1@|sDPD3VB,lp:2m|LvC' );


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
