<?php

namespace App\Providers;

use App\Validator\ExpirationMin;
use App\Validator\TotalSum;
use Illuminate\Support\ServiceProvider;
use Validator;

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
        Validator::extend('total_sum', TotalSum::class);
        Validator::extend('expiration_min', ExpirationMin::class);
    }
}
