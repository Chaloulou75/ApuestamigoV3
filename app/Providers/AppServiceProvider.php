<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        //https for asset
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        //@admin as blade directive name
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->admin == 1;
        });

        //tailwind for pagination default template
        Paginator::useTailwind();
    }
}
