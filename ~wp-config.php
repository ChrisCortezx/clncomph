<?php	                                       			
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'clncom_celine');

/** MySQL database username */
define('DB_USER', 'clncom_devuser');

/** MySQL database password */
define('DB_PASSWORD', 'KRY|=ZFX3B&I');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '-ps-fl!=+e{$6FfU_G+znC =vA =6_D8L-Wp@U<0BqTkt?g(X<>d}8yNd@D3#`Xc');
define('SECURE_AUTH_KEY',  'h-aw#5ciB?Z8<|*|uH`m2MUO-N&UOt?#e4+Z`rd1 x%|Mx5+[X.k~QVS}IVXC@U9');
define('LOGGED_IN_KEY',    'wzQ-kQd$X/+G+nA[7e1 w.YyicJ2sA+JG/@c2:8~.|6+O*M,B1&sugRG+c}.+Ho;');
define('NONCE_KEY',        'GW&g//4+Z~RdHgAlTklf5M)X?8;7Y0=S<UJ4zuXXP8@ee0[,~.nQNarC2&!`ujAC');
define('AUTH_SALT',        'ft?-rk04/*M-d+. yL;xI-XSo+-L.p75ZPtpG>HMv;4As HzslS$Jy+l|>gX54$0');
define('SECURE_AUTH_SALT', 'sxN],j-.ZE6tUQsTDMX Bvv&,%yt}Z,*aYS-u~tI`d*g^t`gAh`_.1#?re4g;65X');
define('LOGGED_IN_SALT',   'lL,RM?#7D6$3w+I]7M l8*(4s@F!o>Mv1K&)R|>#5s{1RjcqP5>Wj06X~AukVeK+');
define('NONCE_SALT',       'Sk7q<<:^m$e@ u|B+JEF*X{wnzW%>|wEkSJ=vnz M|!wQNz>gT#$^MdMpq$=.zCs');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');