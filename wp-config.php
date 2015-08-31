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
// ** MySQL settings - You can get this info from your web host ** //
$url = parse_url(getenv('DATABASE_URL') ? getenv('DATABASE_URL') : getenv('CLEARDB_DATABASE_URL'));

/** The name of the database for WordPress */
define('DB_NAME', trim($url['path'], '/'));

/** MySQL database username */
define('DB_USER', $url['user']);

/** MySQL database password */
define('DB_PASSWORD', $url['pass']);

/** MySQL hostname */
define('DB_HOST', $url['host']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'LPf}<OLKc9cm)+V8e(st{23utW+-+x/$msr|+86-gxzv~lqg@]^!X(bCR+/+r=F}');
define('SECURE_AUTH_KEY',  'UeR~8lJuV7j[g4{! Gu3_TPv/+X|^n#n^X$>0Y5p[fib.-;@~yxtEf?|7qhe)|;8');
define('LOGGED_IN_KEY',    'XKH,Ye]>WO0hE@H^fpb<tQiQ[edLUX2i=kO+fK[<G464G>RYXRm+lB%LY=o-N&S(');
define('NONCE_KEY',        'lt%ub5+BD-3&vI]u5Y!KgHo}A(!,.ivWUQ.oN.-v{po^kHT4jmIdPPS`mwOYdG~+');
define('AUTH_SALT',        'gJ|6sg+ISuG#Z#mmiK:eswNJNc+#`Y7{4lbg;*N|0kFmrk>FUStW,#2ZWW>b,I,d');
define('SECURE_AUTH_SALT', 'XIu;Gqg<_llM`G54{/+V;(`w$/,N{)II}daKZ.-tHmS[R;WPWcQ.35?CfCg+c)v$');
define('LOGGED_IN_SALT',   '^0l$xocOD><bR._I+,zli22{~,}P0$vg/AP1}c2%436re.9V4/+@Jt0{kj+207j|');
define('NONCE_SALT',       'AA14ilO9~SD_5h(?*+S-N#3?tTgF|Hzrx>.F~G$69`|KQY-tT,>rgSm-b>E<]I[j');

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
