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
define( 'DB_NAME', 'u31thai_app' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         's@<x=#pNt,WzRcF~CLfnoT7f^_QvmsHB=*e%dTwQCx.xBz:H6%~gCfw*?dafZP<P' );
define( 'SECURE_AUTH_KEY',  '5^K<kr)9q|88W@ga;jfu</T4]n4^-|*N5$m,a,fG#Y=7,XY0O^qM:n$dIiOGlR@Q' );
define( 'LOGGED_IN_KEY',    'ei`-e_oXuM_l71jac3C#_@j31gf553}M|4,HvsidXB]=b}3~+s+LY;6p[cKmwPw<' );
define( 'NONCE_KEY',        'uSt$TX_?8t&*-)TO2XKQ)Ne>|L7bYwfmJU*LvV..+vK>?kywh!d!!o|f];-gV(mC' );
define( 'AUTH_SALT',        'XpmJnu d:@=)[l{jYE]qO.=;q;pR0MOl9bPy8nfPv9YX/{X.7?P<V8@Qo,r-JArt' );
define( 'SECURE_AUTH_SALT', 'FbJ?0S7;oG7F= Cy-jX&.81,).m>WP9m[%:OHT8ZpZ)*{yS$99*iJb[{+dP6@c}.' );
define( 'LOGGED_IN_SALT',   'yQ#:c[bQ:tS$~S8K/p @J4A!LS<yk*{$*lU$a56mlqQr!D}x9;53sD:I7BmI!(%`' );
define( 'NONCE_SALT',       't[05Z2-uRGe@p:FB#R:hn/>_#D{1nmU$*YBxHLDqbDHrIZkS2eaH?6bvv!:$vvig' );

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
// $table_prefix = 'u31_';
$table_prefix = 'wp15_';
$_SERVER['HTTPS'] = 'on';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
