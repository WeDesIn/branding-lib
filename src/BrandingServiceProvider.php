<?php

namespace Digihood\Branding;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
class BrandingServiceProvider extends ServiceProvider {


    public $routeFilePath = '/routes/web.php';

        public function boot()
        {
            $this->setupCustomRoutes($this->app->router);
        }
        public function register()
        {

        }


            /**
     * Load custom routes file.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupCustomRoutes(Router $router)
    {
        // if the custom routes file is published, register its routes
        if (file_exists(base_path().$this->customRoutesFilePath)) {
            $this->loadRoutesFrom(base_path().$this->customRoutesFilePath);
        }
    }
    }
