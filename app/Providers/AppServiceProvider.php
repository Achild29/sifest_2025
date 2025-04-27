<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Config::set('app.timezone', 'Asia/Jakarta');
        date_default_timezone_set('Asia/Jakarta');
    }
}
