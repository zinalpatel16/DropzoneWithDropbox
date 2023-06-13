<?php

namespace Hcipl\DropzoneWithDropbox;

use Illuminate\Support\ServiceProvider;

class DropzoneWithDropboxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'dropzoneWithDropbox');
        
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->publishes([
             __DIR__.'/assets' => public_path('vendor/dropzoneWithDropbox'),
        ], 'public');

        $this->publishes([
             __DIR__.'/vendors' => public_path('vendor/dropzoneWithDropbox'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}