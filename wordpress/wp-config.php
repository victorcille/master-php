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
/** The name of the database for WordPress */
define( 'DB_NAME', 'aprendiendo-wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'hsGWx*&H@oVy!Gk LXIP0nI KGKqiURSmk|>7M#}ZRoE@4Ry~gY^+xnfiL1}+Zd:' );
define( 'SECURE_AUTH_KEY',  '``!4$i)x7i6aW5fw8]{WD&?J1n(y$3V3b8@p,u_7|{O*4Q=d!C]Y9Y&J4`tvMpZ|' );
define( 'LOGGED_IN_KEY',    '|Cr1e9iT.&y?^$QCn@!m~5tEpK<R&QyL_f~3J#a=6|$<~EZ]2Ng/v<|]#%</g@m/' );
define( 'NONCE_KEY',        'MUBH`f$:kkAcF<+(!U_;mn)/2Jmx{o|Yw,tARV(J2X8Ei}$RZD1^zm{@cnQD}B{-' );
define( 'AUTH_SALT',        '=25D>%Bh0wfFX#sJy[ED{BlKV[|px,&T=$|?n{K&[IFE2sB%c0/j%:(6Vw#2PzC*' );
define( 'SECURE_AUTH_SALT', 'ZA=ySt,!CwGf:@C5p]3 *#sz4iaDtoi^|jh*F*_yEX*m|Z)#yVbl9la7xn!-{t!T' );
define( 'LOGGED_IN_SALT',   '8+/~==YPIj>dKpp;$TM(=Yb#]#W1#.gxh Wa[S7P[]F:a=z}Ny1xW?w3ikA/a1}c' );
define( 'NONCE_SALT',       'c=vG!Y)3U:tF$72@[_{x`u(*9w}}GBG;[!*!U~x-<35&Yi8NsWDJMsDv/a),N*|c' );

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
