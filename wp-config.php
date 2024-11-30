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
define( 'AUTH_KEY',          '$CGQzT_-j=(aef3U+rl%n4L&H2gjq~7_uxHn=n 9%Gsix;@GDi>,mmNFTY+Q5MLu' );
define( 'SECURE_AUTH_KEY',   'u`~=(sb/=Gx}7&)rk8 kDT0/eQKu*?Lg18t7.i5x-9,Uw[hm1l(Zaf,--|A3)v-I' );
define( 'LOGGED_IN_KEY',     '}{uq, ]:q@DBwhv+W@RGq#QrFW5Bocj$T_tW24*wNoIk$/7aYj[N>BE}-3[.2=k~' );
define( 'NONCE_KEY',         '.Z XV|6HyB@}CDE/(@(`Kh)~OIq5RJilU3+%dZRD[>wni/Na tLf_|sY7F<~BszJ' );
define( 'AUTH_SALT',         'tZeP.)Ii`=BW_|zf:Lb?O2H}wB4D$$owGl0m;EBd5?.TLKT.4UrqDN5Pu]~H<Qd>' );
define( 'SECURE_AUTH_SALT',  'QVxeD%D<ZSlLLU)o=~&EP3I*hvY:Iw>>F#t~] #A>x7;.CLQ |8v3Jw8`)>xSTn+' );
define( 'LOGGED_IN_SALT',    'Dzi}g;Y{*cx.5jpyxR:|ax;{&Gkm]-iVmR#3fyG}T;EQG@/2wFo#XT2R<M{vvStv' );
define( 'NONCE_SALT',        'U.D,HhwGY7tKgYSDv vNnlwGzL0uaz#VJf>fSXVZ+9ONmCh-lE{Z2ilK~:e8Met7' );
define( 'WP_CACHE_KEY_SALT', '%joe0{w,UXdxdfTpa8uu^ht$oD>@u,7]yM5%=F*s$2N>0W~7.SVcw}H0[RMd7Wpg' );


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
