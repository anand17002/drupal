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
define('DB_NAME', 'dpeblog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/*** desable add new theme and  plugins ****////
 define('DISALLOW_FILE_MODS',true);
 define( 'DISALLOW_FILE_EDIT', true );
 // http only cookies for secure header 
 

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */


define('AUTH_KEY',         '+C6I@%zjy=b9=Nin6q_q%<l`--B?+f`Qd{[I+f#tOH5s`/+Kfgw(;e8Lr~{gKR<@');
define('SECURE_AUTH_KEY',  'x?Ex8G yn9w0>WU19Yot8(cQU-)7K2[.]lcSb,&nYW&`S9~0p2#w5m++Y]:Ex2$i');
define('LOGGED_IN_KEY',    '#9%Yr|#N3)2%yMV#t!qKM.p%Ug:~PKOj?igw6I-<u,<%HYr]/ZV+D*U{r|9vBmp*');
define('NONCE_KEY',        '`oe~<,.A6d|qx=~w{^+vNn=/88~@#2B[D|qd1ux3mk^irD75SLZ7oh-K>EUe>.tA');
define('AUTH_SALT',        '|[0_QaJHVnuco>Tk_TiJc:z/oAl!Fv8IgL(U}*o:ic+<&4X[TG+-*+1pgBf9hvQJ');
define('SECURE_AUTH_SALT', '[xro>1%-4Q}G,k}:~)Nyy7naRIsB6!7)W[}H/D-bmV}yq I[pLcGv]*?@G)>Hymy');
define('LOGGED_IN_SALT',   'LnE:n&(0ZdvAzNnrz-`Uy:g3mBS_oWu9<4h[rm^EfE.NL-: 71rFLfj-cZ)6 `/E');
define('NONCE_SALT',       'OvbF{T848@]zl 0P=N3AV2Kcrpi)~{e[.ay#P>S#|pK-=-d[:UW@5hHC~9+EBmHS');

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
error_reporting(E_ALL); ini_set('display_errors', 1);

define( 'WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
        


/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
