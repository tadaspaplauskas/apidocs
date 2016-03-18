<?php

namespace Frankly\ApiDocs;

use Illuminate\Support\ServiceProvider;

class ApiDocsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ApiDocs', function () {
            return new ApiDocs;
        });
        
        $this->mergeConfigFrom(__DIR__ . '/../config/apidocs.php', 'apidocs');
    }
    
    public function boot()
    {
        //load our routes
        require __DIR__ . '/Http/routes.php';
        
        //define the views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'apidocs');
        
        //create config file for password in root/config folder
        $this->publishes([
            __DIR__ . '/../config/apidocs.php' => config_path('apidocs.php')
        ]);
        
    }
}