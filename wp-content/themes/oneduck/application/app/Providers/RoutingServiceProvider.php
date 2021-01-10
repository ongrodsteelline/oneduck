<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Load The Application Routes
    |--------------------------------------------------------------------------
    | Next we will include the routes file so that they can all be added to
    | the application. This will provide all of the URLs the application
    | can respond to, as well as the controllers that may handle them.
    */

    /**
     * @var $request \Illuminate\Http\Request
     * @var $config \Illuminate\Config\Repository
     */
    protected $config, $app, $request;

    /**
     * WordpressServiceProvider constructor.
     *
     * @param $app \App\Core\Application
     */
    public function __construct($app)
    {
        $this->app = $app;
        parent::__construct($app);
    }

    /**
     * Register the application router.
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) {
            $this->app->router->group([], function ($router) {
                require __DIR__.'/../../routes/web.php';
            });

            add_action('init', function () {
                try {
                    $response = $this->app->router->dispatch(request());
                    $response->sendHeaders();
                    $this->sendResponse($response);
                } catch (\Exception $e) {}
            });
        }
    }

    /**
     * Send the Application Response
     *
     * @param $response \Illuminate\Http\Response
     *
     * @return void
     */
    private function sendResponse($response)
    {
        if (!empty($response->content())) {
            $response->send();
            if (!is_admin()) {
                exit;
            }
        }
    }
}
