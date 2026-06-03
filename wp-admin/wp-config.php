<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'solacards' );

/** Database username */
define( 'DB_USER', 'devloper' );

/** Database password */
define( 'DB_PASSWORD', 'XXZroQ,.TWnC+{TB' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'm=5wnwmF5PKEB,)#sGyF~>4m`I|qI;_2u^@E^U9*_Tc#JPLbF)81{QS+]_FYjK5d' );
define( 'SECURE_AUTH_KEY',  'vP_ug>[K[3C-s@&qE&I%U}49%<!Y3_c(z@~]i.j=<K-%D>J+Qno*S=lz{O;`Fd6V' );
define( 'LOGGED_IN_KEY',    'mMKF ?ZJ-12aO#{/O.:LBwGp@u<o&$pO02ZnlpZ:HiwG%*2t,`*lj7N1q[WAXEnu' );
define( 'NONCE_KEY',        'h_pFt~jG@LrKlmL;XdtQ(u3[uO(2iZ&06aBY7V%1~[mpAJS7e^wtiGiUhDwX3cv,' );
define( 'AUTH_SALT',        'sEET%+&|<:)0BmR[B+s `9QLsVTwe;6U%4^HI(ni~wxwrds//-N9cQYU6fRF,TR?' );
define( 'SECURE_AUTH_SALT', 'x^3>R5x6#MIU$)Y>(mVp/N&9/q8l@j(DhUQG|Rfvp=S3*-$!|*iwdXWg OMU/Mw#' );
define( 'LOGGED_IN_SALT',   '.O^n#(NC{E[5}1ifAROz|6z~wY|h6NdcM4y;L1Z-W`$:e8+-k7ZMtfO9Sak]u]!d' );
define( 'NONCE_SALT',       'BN-OngR|>c0 a@0O@:X5(sRNr>(T3XR>leP,;T(^>C#QGE0RV=r8Lw@hi_(04(E<' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

define('WP_MEMORY_LIMIT', '256M');


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
