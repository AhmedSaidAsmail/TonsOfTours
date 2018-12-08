<?php

namespace Shopping\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            $request = $app->make('request');
            return new CartManager($request);
        });
    }

}