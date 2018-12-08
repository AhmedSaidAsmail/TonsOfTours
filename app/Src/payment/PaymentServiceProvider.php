<?php

namespace Payment;

use Illuminate\Support\ServiceProvider;


class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('payment', function ($app) {
            $request = $app->make('request');
            return new Payment($request);
        });

    }

}