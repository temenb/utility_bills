<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DeptCalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\DeptCalculator\IDeptCalculator::class, \App\Services\DeptCalculator\Service::class);
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
