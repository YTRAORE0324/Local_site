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
define( 'AUTH_KEY',          '[9}-T8n])c:h*wKp <7td^7L4~6j^Mo8~aA{IH=oAOmN{ls`nCbF$XkR|T;&=YgZ' );
define( 'SECURE_AUTH_KEY',   'yM.TrPB9]+~o<M/4H8U?Edc>C&Lbdd~vA%W.{#T%Pi C~Hg9kXh;,aTu,4ss1`_g' );
define( 'LOGGED_IN_KEY',     '4+i{FEd$Qv0C-@nDSp}]kqBFl1`hOJMm0IIN%V6M<r6J(_sk<zz;f:`#gtf[T4Y1' );
define( 'NONCE_KEY',         'd</()#^y,*QD5&ei /u(M_mtj /_+5@*##dor[Q<1DUJP;]&oMZ7o}GTf;Z3Sb#3' );
define( 'AUTH_SALT',         '0W&j@4|P=dX@f</h+<1s)tbLC^_2C:UQU<zIo_=bLOFU?pf|=B,fBlWmR]VZm|vi' );
define( 'SECURE_AUTH_SALT',  'B^[RnJyy#1SeND};OPr;YDAm.r.#mnVf(=r#dv:%IEIbSghA](N<fnXE^xL_qU0H' );
define( 'LOGGED_IN_SALT',    'awj`I46P@`~x0*c@!Y:TblsEfPFS0:.sgayUO8/FpiKU4xNIad4*:EL$=0/&J1YZ' );
define( 'NONCE_SALT',        'hl%>:e@}E?i8Q.O5kkCfrMfbNxJ->@#kWiju j*gtQDM<oV5C!?m8rX$^|eC :Ki' );
define( 'WP_CACHE_KEY_SALT', 'GPd/-4%iQ|HqtD4X|F*-*xQj__wcf#9G|Jf013]iAQJLZYX3dZ^U)H?6m:9ol)OM' );


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
