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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

if (file_exists(dirname(__FILE__)."/local.php")) {
    // local
    define( 'DB_NAME', 'kennywu.shiftcollaborative.com' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'root' );
    define( 'DB_HOST', 'localhost' );
} else {
    // server
    define( 'DB_NAME', '' );
    define( 'DB_USER', '' );
    define( 'DB_PASSWORD', '' );
    define( 'DB_HOST', 'localhost' );
}

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.p);LO8cO#@]7eohg,w);F[DQ[m&8o8D]Zg=f}vT6WAg]rnRM6u8e@/GvKbBLy]O' );
define( 'SECURE_AUTH_KEY',  'r|=Kt5w[HkQ0LRYJo9WX(,hba(v%[n[Bfbco[!Z(F+H.vQ%*K(4,T(;j0eZSt:q=' );
define( 'LOGGED_IN_KEY',    'i8UU~{{69O5zvWk>4Psj%B|[Nz4B.Cf47b[>7MdP>x^$M{Y{h]ic~,_X.TRGp|0c' );
define( 'NONCE_KEY',        'O^6Ns% !:=oU42vK9y$L6S<euEdtJ+EGgi)PDtH,g,?Z$m$pSdOdQ,3@6PyI?vAC' );
define( 'AUTH_SALT',        'X6p(F_I]-j}@eyaCz[I-}Z}Q3~Z[oBDg%bC9rQyCMuYSoY31dW5n@V0,8N UN<=J' );
define( 'SECURE_AUTH_SALT', 'H|&xT@MMCW-$jsQy}YMw-aveblK:^bQd}v2QOl=s($ 1(Y85R382>/|&oAC8uLNs' );
define( 'LOGGED_IN_SALT',   'W12Ut|Tx.}8gzS7>ZfeU&m_[7/9Gy{dWk4^j0E#8E])~$TBJ9LDvBL+fx I,Puh-' );
define( 'NONCE_SALT',       'Hhc6&Az`@.1J3Dv=aYk,sy7-m=_Zb8UWpEn$R|o&>&}Jd9+|eGgt#[e2pxy92&!2' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
