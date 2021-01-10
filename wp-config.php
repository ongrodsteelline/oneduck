<?php

if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}

require_once 'wp-env.php';


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY', 'tUCNRRj:P=#cu1R31}`ly,tEXyxDh B`%]sBo%bsphi1$x9-E<>xQ1+:^#*-cZY^');
define('SECURE_AUTH_KEY', '`s_f[2si&{x>o PzY`<gwKAU/rx=k:Ykx,{7Wvwyhz:q6@a}Jjb/_SdQbVNfPRdT');
define('LOGGED_IN_KEY', 'D4P{0@gTFNornOTsN=)N+YY}V0+r6e7[>@=qc|y#wjzX6e+QK$7/jxC uKvr|fa6');
define('NONCE_KEY', '=Lk7ha8+yC/@#;sGR}.Xgt(1IQW0fV>Vl-x#]8,wmpy5k0okL!vKK/(kj[MG7FgT');
define('AUTH_SALT', 'VLNc`6c`]Rc8<x4jtkGM?7)PnbciZ7wc<tnp2Za$oz+1Lc;U*T)%^sh7*^D]4gV3');
define('SECURE_AUTH_SALT', '-Lc~QluOcP9UqO3pIltuUm<N2 >)YhA,^([sLEb=$b#.%GUnxxI7&(F++1f}p~kf');
define('LOGGED_IN_SALT', '|LJpw-5fnD)211j}rUJ[BAhRA)?MNJ{u-XHawFnA#bm<ch]TQPo8{F]+j3=6p<Gu');
define('NONCE_SALT', 'Fy3D%>(?@T~bG>EuzQRoF49-y]LV<UFof~ jG*H$1X)bK-zug,7J#.mTGzNNp)WX');

/**#@-*/


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix = 'duck_';

/** Sets up WordPress vars and included files. */

require_once ABSPATH.'wp-settings.php';