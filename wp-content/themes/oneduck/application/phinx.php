<?php
require __DIR__.'/bootstrap/app.php';

return [
    'paths'         => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds'      => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments'  => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'default',
        'default'              => [
            'adapter'      => 'mysql',
            'host'         => config('database.host'),
            'name'         => config('database.database'),
            'user'         => config('database.username'),
            'pass'         => config('database.password'),
            'port'         => '3306',
            'charset'      => config('database.charset'),
            'table_prefix' => config('database.prefix'),
        ],
    ],
    'version_order' => 'creation'
];
