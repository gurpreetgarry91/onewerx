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
define( 'DB_NAME', 'onewerx' );

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
define( 'AUTH_KEY',         '|L_=qsHd}{k.bl-0QDzZM|<#`+OTARU!8&LY|ri=kXT5;lpP]P[h$R5P6>ohON{Z' );
define( 'SECURE_AUTH_KEY',  '_n=4jXB 1s%o0=YSFzy{|~ktE!V1 Tw9dzA%nYW6cJ$+c5!*TsB:w6Do2@oLobm~' );
define( 'LOGGED_IN_KEY',    '6]qT9 Q`G&6gBQ0YnOX2tv~aL1SgmX!m[4GTCQIOd05=l]20c)jp*5!U&XljE1>`' );
define( 'NONCE_KEY',        'W>:b!PrN:vG=r2^O5a m4:UFW%-!8h93dz;vDGxDO)S4^b`45D_O.t&lFajvfGVn' );
define( 'AUTH_SALT',        'NOzA{q9#4R2D!(k1rd_4:48A@8$ix$4o?(x_fAFkyO)j.A*3U}fYP$r}ha0YLl)b' );
define( 'SECURE_AUTH_SALT', 'I%3g_`HZ+[wLfvX1NUy/X,iiecJ>>p&7-wqEJ45Z|0}l#y9HQsGTHFtye&A8gDO`' );
define( 'LOGGED_IN_SALT',   '#8F716JFq6DQPOQPIAWFi~FK*VJh:o>NuFON(&Sl;,c,*qa?5775d=;.lR$sA>QE' );
define( 'NONCE_SALT',       'G[2?Uk9efBK>vohr/AL(TGKzO>hn,qb_OFpXHy/?G(HLxYQ#4Zu j1p(m^`zjk*l' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'onwx1_';

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
define( 'WP_DEBUG', false );
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
