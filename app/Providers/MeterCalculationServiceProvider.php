<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MeterCalculationServiceProvider extends ServiceProvider
{
//    /**
//     * @var bool
//     */
//    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\App\Services\DeptCalculator\Service::class, function ($app) {
            //для версии 5.1 и ранее:
            //$this->app->singleton('Riak\Contracts\Connection', function ($app) {
            return new \App\Services\DeptCalculator\Service();
        });
    }
}
