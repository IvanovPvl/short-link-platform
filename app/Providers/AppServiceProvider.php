<?php

namespace App\Providers;

use App\Services\ShortCreator;
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
        $this->app->bind(ShortCreator::class, function () {
            return new ShortCreator();
        });
    }
}
