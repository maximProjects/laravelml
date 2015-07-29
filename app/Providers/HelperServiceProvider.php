<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {

        $this->app->bind('TrlHelper', function(){
            return new \App\Helpers\TrlHelper;
        });

    }

    /**
     * Register the application services.
     * @return void
     */
    public function register(){}

}
