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
define('DB_USER', 'clncom_devuser2');

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
define('AUTH_KEY',         '[&6d1u)lr5v|c`/nfzr(oFH/qGgn~ANJfJZEqAPR0tFWy-Ya+X=7;qql$oYJ;pFF');
define('SECURE_AUTH_KEY',  'EXN2&!<ln26_?)T((D^]|3fS<)e4Ndtc^n3c.vY_Hm f2|78*Xyla@A3Cg )|[%)');
define('LOGGED_IN_KEY',    'I|zYENh_HQ_,i.L8z1,WcD{KJ{O%=E}JA1Z)-qHL$1>=-.cgy^6fZ]k}L+3$D|V=');
define('NONCE_KEY',        '=Y#KJ!uS[RA/HJ7OS+]]0mv(c[VudsFm)eX$xnVMvfI7(:X|dH3`U#!<-BIkl+)v');
define('AUTH_SALT',        '+bWpq-6Dh{Hmd,1wJ*P)Ei%IUZ[]x.]ex;Pd#J`g9r:BOI_327~wiE*1FA`0X38.');
define('SECURE_AUTH_SALT', 'jYb{jH|sri-W5C+?b;lC;R/y8 jy{0-5I:>U]>@gM<O;sk`Zqh0Rs;4cF)CJ75ON');
define('LOGGED_IN_SALT',   'sIXL.?$53u(CrNXcI@q?S^o}/-; EilG$dmWzP.30b2Fw~_U3ah3t>(h9h)Sa.uc');
define('NONCE_SALT',       'LZ)|.;+ t81iYBcnt kQr<93 >.J:`6@R~%rv>fju[K}Bsre{XYp|fv{}aL~G)8L');

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
