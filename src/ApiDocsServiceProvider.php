<?php

namespace Paplauskas\ApiDocs;

use Illuminate\Support\ServiceProvider;

class ApiDocsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //load our routes
        require __DIR__ . '/routes.php';

        //define the views
        $this->loadViewsFrom(__DIR__ . '/views', 'apidocs');
    }

    public function register()
    {

    }
}
