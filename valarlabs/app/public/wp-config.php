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
define( 'AUTH_KEY',          'dD(nDq{TyWpD-_v%r,6gX$V{<0k|Uxl6p>KS$Xz0}3i~IW]FS19_w,SJ>_^rH6R9' );
define( 'SECURE_AUTH_KEY',   'R!XNR4pu oYITHaN6[+#M;QQ;:8,R=e#x$OX^_}@C`,M~^.&tM31rQq4m}zA,iVI' );
define( 'LOGGED_IN_KEY',     'b^#Cf&-G<ib#4`)Ec)h7u2JQ:Ub-lq~!8n.ayL[^T|W 3FrQn7jtHx;P_q2yCE>]' );
define( 'NONCE_KEY',         'aTdPL0`=q?0r#:PIk14IxVO+rTj,)v:0t3}U5XC :r;Uk3nWm3`g%W*?-a3~R;*A' );
define( 'AUTH_SALT',         '7:b?hK_%*l^SPB,GH<rh3~KA Wl![|[@|#3/XLxR1%E6bf2wQN^{G;CN#<bLyH1,' );
define( 'SECURE_AUTH_SALT',  ' 7@DX(n8}ow3bEbB}j{;rVKKrzCo4SmLtv2DV~s*@H,UKy$?SQitB~7T=(<3P`g*' );
define( 'LOGGED_IN_SALT',    'D=*@w(3Y-Wx%P5g$:0Ji/mkkGk<-k:ST!TD^DUXKa1|u@]3MZ(2qPlO;vM7OY-71' );
define( 'NONCE_SALT',        't<K}wbn?1jP]erDQ;#%MTZ/jT>uJ%=p1@;]5FbUpM?:hL(klrS&=PQo}C^1_z%+Z' );
define( 'WP_CACHE_KEY_SALT', ');0zdKoy^%E7MIJ+[qQ2GlsyD(<<z7S+[0qrN^8k T}_4FrvNjG I%-f~KP]q)XK' );


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
