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
define( 'DB_NAME', 'vclc' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:8889' );

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
define( 'AUTH_KEY',         '^Ib?)7zlB`CA0o;B/>^K*Vq-i 4b%@.jj^G@ Ig&*N-lt^a4G7TsAAqPAWWmvOqv' );
define( 'SECURE_AUTH_KEY',  'fY# 7d5e5kQ+u0EwO cA6&@[_-3gXuT^Q*qHD9BB=YU!cQ-@O=Le/##!wybPr</}' );
define( 'LOGGED_IN_KEY',    'w*lvKC9 VaX{ T81i`xJoNQp}eNz8!Q^7H6i=:Pbatc&Q%i!Pm! JsO*%w8}q[<H' );
define( 'NONCE_KEY',        'gcG[?DtvXZRI<2* 3Kxm$dHmm!8zg^;Z.`|sH<tUKp[vhYS;%u^oja3r/JUv(i~t' );
define( 'AUTH_SALT',        '^xk[d9gx(sP5ZA&*I/@9j|j-puWPOoCC[KP|8P]-SnlycVlxvD+(zE)l6faC(92y' );
define( 'SECURE_AUTH_SALT', 'B25N]WY5Bj*HJ()_x15me/}df4{zG.XD 236U&bKnm0[qTir80Y$@OB9t5M4ib!7' );
define( 'LOGGED_IN_SALT',   'UH3(d8%,=X.:BZ:4=y&6Q<.SM*-{a8I39yRNH2~@j@J;T`?$*NZZ%.^R^>5D 1i$' );
define( 'NONCE_SALT',       'tJW0V@q)}VF|KK,~wOB4J9{.o2K=26#8q[Rw&JYZMMB5F&97U92niUFPrET]Iw&3' );

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
