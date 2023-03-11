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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'brainlab' );

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
define( 'AUTH_KEY',         ')Hz+X`e% =y6dL ,B`Kd#~6h-S_Fov:XgSv6LX143P2&jAQ_) @v2jmhHW+WIa,z' );
define( 'SECURE_AUTH_KEY',  '!(G6U*BVrvAy:x,_Gmn0}xT,w7y0jX]6vsJjQRQ[m}V,< &v8?8Ir1PRF}vMKsTH' );
define( 'LOGGED_IN_KEY',    '}:yfvf)aW~C-6)[|/OLi_n{(V</q~=,wl9#wj t,_]Ge$ex1_,Zm4XJ}J*:7-UNf' );
define( 'NONCE_KEY',        ';,tER  {mGcS9vl2GKs&f[(la,J~e6-e9S?21FyQPo$zQwN)09>}L30doq1ffV5u' );
define( 'AUTH_SALT',        'P!bLiM(14B#,:)7YmP=HT+:+8N[eG4+7H-YFLQ+nWc=MC5U&b$2~Oc}3kHg)Qh&S' );
define( 'SECURE_AUTH_SALT', '3XkT8|M7dOoNM,bR953f<x}s?*,uklgri}riH#$+CO{J_U|Nt+6PEWK[v+|wj)m|' );
define( 'LOGGED_IN_SALT',   'gu|@&qg vRbFz:$ML%,L*9jrB~L(rYZ.R`sfRf|E:cwh *Ltl!9,MN :_fi(H#SL' );
define( 'NONCE_SALT',       'tc6[:iCK7aH>nm{+ ,dc,og~.5D>[P~0;+Yn@/waU.CTrMs6!$W|qHC |wk@^4/y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bl_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
