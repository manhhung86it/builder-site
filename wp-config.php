<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cya-wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'P<G%x+Ay}aqgR|St[JT=~.+8]oX*~~kjP6AyAQ!Y={L3&rwfRds9rkX+|L#-KlKo');
define('SECURE_AUTH_KEY',  '^uk`:tW8WDen-0qf4T}:n*<Gwy-Hr+vzEG^0wYW+|RZ*[0L4h]B2{eWQ|M.dHy[m');
define('LOGGED_IN_KEY',    '@~T{)d&7nqsKY47^B%L0I3|g!`_^+ENd.)teFKIU&y<%`ErnA+Cmq,v-z}n*!,Ac');
define('NONCE_KEY',        'P=,M:{Ae}VlIn/2o|kP0^uXrlY2s0pxPKtTDfo-sz9i|v|9cu&Qm(ta06ovpz9?8');
define('AUTH_SALT',        '-t= J=lUS*=|h)Or9I6-rF+Wl0*Z*W;SItzTIV(VW#gSExvSaV}@#%,*&z*=Q3Lv');
define('SECURE_AUTH_SALT', '?h96~8O9iC/e%N9>qJk)TEI|f=g`+T%{M^I#8)I0aI-s&E;>gNVWU(,UM7ygK_kb');
define('LOGGED_IN_SALT',   'cb+t5#NINAnO{Sfo-yLf@n`M-IvC}},s]b2n(eS?wlVp1F;,rWy^QJzm:)AyXNsb');
define('NONCE_SALT',       '%+1)2_##Q27PA4/5U6XR1SYy6:)M[7s;|nv((cT]{6xQ8x&(XiqVUJps/bry]*RT');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
