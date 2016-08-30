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
define('DB_NAME', 'thienphuocloc.com');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', '');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'K2f*~@_%Q<g)HKS$0w9fIokR%$Vmey/kHrr;@L#a^h~le0nR^7`^7g]mM^zR9Q1d');
define('SECURE_AUTH_KEY',  '%!J#r)pn[/C9`72Z6{m|kw|9A~8u|[T?Fy_GDri&Vz$ U;t$.zP5l7GFAC5;VpW_');
define('LOGGED_IN_KEY',    '^]+11.#m5qZ89]?*D~ E).pz`&)eyy6^JK|SuB;5FzK:{6XRoC)Q|FjKDaZUR_K;');
define('NONCE_KEY',        '?D<+R(6MVuwn7>9|8k4rRk03lc] TmANDXhEJ`fXkW+4Gb13]CPPi!7:CU/![i-r');
define('AUTH_SALT',        'sYQX=a>V?1`Ucw(2DBJ z~k=G2~4)gtEJh)}zS+[q>J{@1wD;SclRz/!i2S(j&{D');
define('SECURE_AUTH_SALT', '7U_>7Qha_e9[<n,pj?3&DGCxFmuE1wboLQy!IaWDdo82M@hGL4!1kImP5k h{Q:#');
define('LOGGED_IN_SALT',   '))9wUKbog{PT?x2 XcY}#4@LT<Rx{wNe@yQ()fq5*R/5s?P2ZgK59cQT*t0!<!?H');
define('NONCE_SALT',       '_|e)$.57~V(2qvqHItxNIJe<}B]?$xC4T,aC (#k#.WAx<faQ+TP(1*)%Zn`H4[s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
