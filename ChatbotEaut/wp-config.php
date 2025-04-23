<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ChatbotEaut' );

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
define( 'AUTH_KEY',         'p(t^VY~1H_aG4K9k>d:vW4FI2GHdx9;#Oyru7Pm  A{h2^S9Af=D,djhU)2hzV~W' );
define( 'SECURE_AUTH_KEY',  '=fURqEDOYd5cayi1jIp0TRa;:=!BDFfs+%F0Y>)Q&c)_u1D0K6LEvy_2!YFa,R_?' );
define( 'LOGGED_IN_KEY',    'h0~9EuS!`7+Iji{A>ndO;v;[ZZ(h~Qx]|!oF&dBU ISs[M%3.sv~xi2UdlVAXoLT' );
define( 'NONCE_KEY',        'B9CKfgw4mwcIK@{`c_&Y:X9p]5Ij|eg}Q@b=D)?:^^~ep5s@(`{x;|!x$wrW0nZ!' );
define( 'AUTH_SALT',        'cV;)],J^->a3`p+#Y;h5PgYcEZI+*gx@IFX./tz8#tA$|xKA<P/cd{&p!d``(h[H' );
define( 'SECURE_AUTH_SALT', '-SSMozmH.cr-Z8V anctgJx^ZpOcYWksq#s1d~D>QGrAw-ts3t}Ct4l`tH.(=$|7' );
define( 'LOGGED_IN_SALT',   '5sw&D~w]JbG&rF<s}k+Dl>YO&{=.egO5NNrewRXLdX/9YgW<R|wuMm*|LZRq|6+O' );
define( 'NONCE_SALT',       '(hEpqE&A%h{7Ua(x eI*<0OmWzLZSn3t7o#9_/fUeIjc`FK%vg{`$w::NnJ.@O;8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
