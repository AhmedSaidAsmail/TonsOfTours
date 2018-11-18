<?php

namespace App\Providers;

use App\Src\Images\Image;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Image::class, function ($app) {
            $request = $app->make('request');
            return new Image($request);
        });
    }
}
