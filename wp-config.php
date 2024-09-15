<?php
define( 'WP_CACHE', true /* Modified by NitroPack */ );




/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u688141072_i2vkQ' );

/** Database username */
define( 'DB_USER', 'u688141072_S9P26' );

/** Database password */
define( 'DB_PASSWORD', 'WESKv4RnNZ' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '{;-eNl@eC+qFb_p,w8%)@XI3]`M!y5aGL}jI$,aQz5?HN(L*nwBK)zjJOu] Yw?;' );
define( 'SECURE_AUTH_KEY',   ',i^?kF_G][k)9U`vsncl$~dev({fYHx%mMIXr+/Sc#wkkn;Cr^aR3wAJW41.hq72' );
define( 'LOGGED_IN_KEY',     'N`:jn12x)eZ>?t/|5XT4ETo&]FgDG5H#^J>jp7v>NRn:Ds9X9cApaXr}yzgNt&r*' );
define( 'NONCE_KEY',         '.V&y ,KMGbE^=?BT(Vh2nVbTee?hZWZ~L>b0.6OTKtnB@&rATCG-(koLp+*pWK*;' );
define( 'AUTH_SALT',         'V5$c_0/]hKZ6qK@6i%Y#U4:9V-~f(wfgw@/X@rh2XcQ}E6tzdLn{.7zxc.^%NE>t' );
define( 'SECURE_AUTH_SALT',  'sG]9JR]R`7 +FZNrme!X7WXDkzkBLz) mYd`)]9VaR(YMJ~hl[jy=t|c3pj)p;fL' );
define( 'LOGGED_IN_SALT',    'kE!T85@T$CbPSg53wC0*d*<[5SKd7j2?RF,e9H)8}!e9pYe>`. a{b>S/0%eCtDZ' );
define( 'NONCE_SALT',        '$~#%Z~S^D0GRtvUE`o{,1W,ZhQweR/j=@~Nr-q$Fsh-?u/8<7G6}_<H&vxVc)|vN' );
define( 'WP_CACHE_KEY_SALT', 'gqMM%<kX T>x%/L7_kYRGh42K<gtlz~]D$<r9Ml%JkIYw+vSgG_ON(Ib;0,)1CA,' );


/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define('WP_DEBUG_DISPLAY', false);
define('WPLANG', 'en_US');


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

define('WP_MEMORY_LIMIT', '512M');

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
