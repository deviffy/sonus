<?php

namespace Closca\Sonus;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response as IlluminateResponse;

class SonusServiceProvider extends ServiceProvider {
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(array(
            __DIR__.'/../../config/sonus.php' => config_path('sonus.php')
        ));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // merge default config
        $this->mergeConfigFrom(
            __DIR__.'/../../config/sonus.php',
            'config'
        );

        // create sonus
        $app['sonus'] = $app->share(function ($app) {
            return new Sonus;
        });
    }

}
