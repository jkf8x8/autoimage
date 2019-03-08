<?php

namespace Jkf8x8\Autoimg;

use Illuminate\Support\ServiceProvider;

class AutoimgServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('autoimg',function(){
            return new Autoimg();
        });
    }
}
