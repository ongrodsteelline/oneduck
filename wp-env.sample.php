<?php

define('DB_NAME', '');

define('DB_USER', '');

define('DB_PASSWORD', '');

define('DB_HOST', 'mysql');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

define('WP_DEBUG', false);

define('APP_NAME', 'App');

define('APP_ENV', 'development');

define('APP_URL', '');

define('APP_PATH', dirname(__FILE__));

define('DISALLOW_FILE_MODS', false);

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', null);
define('SMTP_PASSWORD', null);
define('SMTP_SECURE', 'ssl');

/** Абсолютный путь к директории WordPress. */
if ( ! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}