<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
       
        view()->composer(
             '*',
            'App\Http\ViewComposers\MovieComposer'

            );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
