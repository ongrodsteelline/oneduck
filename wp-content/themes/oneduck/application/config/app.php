<?php

return [
    'url' => APP_URL,
    'env' => APP_ENV,
    'debug' => WP_DEBUG,
    'timezone' => 'UTC',
    'locale' => 'ru',
    'fallback_locale' => 'en',
    'path' => [
        'assets' => 'wp-content/themes/oneduck/application/public/'
    ],
    'modules' => [
        \App\Modules\Wordpress\Wordpress::class,
        \App\Modules\Woocommerce\Woocommerce::class
    ]
];