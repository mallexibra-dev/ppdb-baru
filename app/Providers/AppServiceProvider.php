<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        $this->loadViewsFrom(resource_path('views/ppdb'), 'ppdb');
        $this->loadViewsFrom(resource_path('views/murid'), 'murid');
        $this->loadViewsFrom(resource_path('views/spp'), 'spp');
        
    }

    
}
