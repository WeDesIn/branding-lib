<?php

namespace Digihood\Branding;

use Illuminate\Support\ServiceProvider;



    
class BrandingServiceProvider extends ServiceProvider {
        public function boot()
        {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        }
        public function register()
        {

        }
    }
