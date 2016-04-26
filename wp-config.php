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
//define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'mikaeleng');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'a11nilen');

/** MySQL hostname */
define('DB_HOST', 'engbo.dlinkddns.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

define('WP_HOME','http://engbo.dlinkddns.com/mikaeleng');
define('WP_SITEURL','http://engbo.dlinkddns.com/mikaeleng');

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
define('AUTH_KEY',         'PH$|u`O1egS9o}FLS-r?OH%GF2-`,(1 `(:oA qAUWluvLQ/W2PP{,hoe-x.f9a4');
define('SECURE_AUTH_KEY',  'AU0>Ma|a?jS;+ZP8[[lCK> D/QUVjeyPbl 9,5}c+bbD-8vT&7_*M3k}|T#|; ?!');
define('LOGGED_IN_KEY',    ':U~k&4-O-.;?vR25/vE;g.|${;MPxQT|m;9-hipgT&W)[-ZU7p+jN&-:|TN4R*vb');
define('NONCE_KEY',        'KQ[>vXX{1_oTHY$d:*+aT[shw6WdF-fTRWX`_-m6^Y-e^_#*Xd`&9-1B}dwW>Xdo');
define('AUTH_SALT',        'wmij<SOq!9^{YJq[%eKReyHBu{VU1nbfE(jLRSMOL{7)Cx{E#~x$fUFW]^s[%c|_');
define('SECURE_AUTH_SALT', 'tWa:sG?yRvCjt`NvS1HoqQkz7M] tr91tTr~L%#=,+wEo36u?u2g+bF/>Jw^Ce_?');
define('LOGGED_IN_SALT',   'TCA!8@Fua*h:K)9YhIy4+u+~Df{`aWR)q=+@ r)v$9vJtzpg#_S;D`gAO8VJh#%o');
define('NONCE_SALT',       '&7-o9E,wk*vAg`8P{h$VBhl: AY%LH;eq-,nGZRd=Rms(FJ$,M@,.u|TB1q?{?o,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'main_wp_';

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