<?php

/*
|--------------------------------------------------------------------------
| Bootstrap
|--------------------------------------------------------------------------
*/

/*
 * Загружаем Composer пакеты
 * */

use App\Models\Post;

require_once __DIR__.'/../vendor/autoload.php';
/*
 * Загружаем окружение WP
 * */
require_once __DIR__."/../../../../../wp-load.php";

$app = new App\Core\Application(
    dirname(__DIR__)
);

$app->withEloquent();
$app->withFacades();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
 * Providers
 * */
$app->register(\App\Providers\AppServiceProvider::class);
$app->register(\App\Providers\AcfServiceProvider::class);
$app->register(\App\Providers\AssetServiceProvider::class);

/*
 * Modules
 * */
$app->configure('app');
$modules = config('app.modules');

foreach ($modules as $module) {
    new $module();
}

return $app;