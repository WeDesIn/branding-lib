<?php

namespace Digihood\Branding;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
class BrandingServiceProvider extends ServiceProvider {

    use Stats;

    protected $commands = [
        \Digihood\Branding\App\Console\Commands\installBranding::class,
    ];
    public $routeFilePath = __DIR__.'/routes/web.php';
    
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->setupCustomRoutes($this->app->router);
            // use the vendor configuration file as fallback
    $this->mergeConfigFrom(__DIR__.'/config/backpack/crud.php', 'backpack.crud');
    $this->mergeConfigFrom(__DIR__.'/config/backpack/base.php', 'backpack.base');
    $this->mergeConfigFromOperationsDirectory();

    }
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    protected function mergeConfigFromOperationsDirectory()
    {
        $operationConfigs = scandir(__DIR__.'/config/backpack/operations/');
        $operationConfigs = array_diff($operationConfigs, ['.', '..']);

        if (! count($operationConfigs)) {
            return;
        }

        foreach ($operationConfigs as $configFile) {
            $this->mergeConfigFrom(
                __DIR__.'/config/backpack/operations/'.$configFile,
                'backpack.operations.'.substr($configFile, 0, strrpos($configFile, '.'))
            );
        }
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
        if (file_exists($this->routeFilePath)) {
            $this->loadRoutesFrom($this->routeFilePath);
        }
    }


}
