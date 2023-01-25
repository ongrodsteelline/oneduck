<?php

define('DB_NAME', 'oneduck1801');

define('DB_USER', 'oneduck1801');

define('DB_PASSWORD', 'oneduck1801');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

define('WP_DEBUG', false);

define('APP_NAME', 'App');

define('APP_ENV', 'development');

define('APP_URL', 'oneduck.learn-mail.com');

define('APP_PATH', dirname(__FILE__));

define('DISALLOW_FILE_MODS', false);

define('SMTP_HOST', 'smtp.sparkpostmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'SMTP_Injection');
define('SMTP_PASSWORD', '04c94635fa3586da89a64525a2a5a7d9027273de');
define('SMTP_SECURE', 'ssl');

/** Абсолютный путь к директории WordPress. */
if ( ! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}