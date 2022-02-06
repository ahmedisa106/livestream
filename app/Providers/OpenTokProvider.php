<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenTok\OpenTok;

class OpenTokProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OpenTok::class,function ($app){

            return new OpenTok(config('opentok.api_key'),config('opentok.api_secret'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
