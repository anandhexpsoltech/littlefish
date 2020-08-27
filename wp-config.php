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
define('DB_NAME', 'littlefish');

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
define('AUTH_KEY',         'RO`Q>r&P14|m46m-42Owy6ni1QtNE?hfIfE|XtYZA+3!S4LEi#fNlAvasDx!fS-R');
define('SECURE_AUTH_KEY',  'CL1o3-]y?(ae>#Oe)j!Y[^3I;~[kewps_|pege-e*zN&)@!*Iz[hD+^i@5*oS/gh');
define('LOGGED_IN_KEY',    'D=eyZ`:MKj0X~sge?et1xvq,rS1ymg)V`]m6yK%v_MLM6Ocp>8oB[mar1yL&)H4t');
define('NONCE_KEY',        'Mq, jO8i.m/CNR9{D;*9h(jqkz1v}2MTu!-`ghV|TI>IhBL&c][rqk+b]z?OcKv{');
define('AUTH_SALT',        '$6|REb$ XT0gM>7ulZM/`,9!O |;G|6*w?1|vk.5-I4YB#-+KpgN>7_1dA`%88~6');
define('SECURE_AUTH_SALT', '41ED,))&]8/{s/Bgw> FOK)iTP;&m$Kz~3zfoRu7e#;^fmJ&#J6Mt+ToeV^6pY]R');
define('LOGGED_IN_SALT',   's1KoN1C.U+P1Y{(1U-|;2n^f+saO;O`iZ$WROjcUg5#7zfyO){yl^cWQl4XKcU+Z');
define('NONCE_SALT',       '0wZ^ EHOc(`q;1WCS=B4$xc)%.+]y5z{53,~z5}D5cnTyVEZI#Sy<D I*{1~B-?R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_hjsfh3_';

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

ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );

@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

