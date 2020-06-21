<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Added this line to use Schema
use Schema;

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
        // Added this line to prevent key-length error
        Schema::defaultStringLength(191);
    }
}
