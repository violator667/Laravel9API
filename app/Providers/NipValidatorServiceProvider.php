<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NipValidatorServiceProvider extends ServiceProvider
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
        \Validator::extend('nip', \App\Rules\Nip::class . '@passes');
    }
}
