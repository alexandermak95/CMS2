<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'CMS2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=$8O>TAZ/y_@IJ!s+%Ejct,Uv hDO-Oyj~qR{MNnNxr7/LX!6Q?XAj@=MNm4h/b8' );
define( 'SECURE_AUTH_KEY',  '->l/X_xNx33YV6+zC1t/(Z-f9e!.BcIVb`hi`^=gdYM05Ey7+WBLb&AZyf [IZB7' );
define( 'LOGGED_IN_KEY',    'RYO5[fIxWoyE@gV~^2;D~63x1:oF0|;r!24Lm|Fuf)&H;xPS;^Nm=YZZ1`h)P44`' );
define( 'NONCE_KEY',        'y5Q b7-k)%|p!{vZ0/YDSx_`/+s)cr@,>oN{#BD90XFr_a+I&@TxWyq_rX[$]7>|' );
define( 'AUTH_SALT',        '|q~)}{.;Gtkct}uwNoPXj.JL^mfvyrz@{[WI<c~-|aWu7]j3VH<PEK-5=R5wWz$s' );
define( 'SECURE_AUTH_SALT', ';!U$W;]$t[m1%4u(w{Lk1~tTn[A9s2azP]F`^DU,k)t_hTpr86w@N;~L`d(,pJBm' );
define( 'LOGGED_IN_SALT',   'Xkd+=<Gv}F%T(4sb2:m09*Sp F/vJBW[Uvv*iu/3qS@|o3v7]x1uw:HMM<U!30MB' );
define( 'NONCE_SALT',       '8:!Uv9(^];2vy3NJ=2t54e5?|p+/_m|3[w8jnbvxy~MuVH)~{A0TPf/b``Bx?Wx,' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
