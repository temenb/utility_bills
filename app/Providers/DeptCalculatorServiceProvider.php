<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DeptCalculatorServiceProvider extends ServiceProvider
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
    public function boot()
    {
        $this->app->bind(\App\Services\DeptCalculator\IDeptCalculator::class, \App\Services\DeptCalculator\Service::class);
        $this->app->when(App\Http\Controllers\Bill\BoardController::class)
            ->needs('$variableName')
            ->give(10);
        $this->app->register(\App\Services\DeptCalculator\Service::class, function ($app) {
            //для версии 5.1 и ранее:
            //$this->app->singleton('Riak\Contracts\Connection', function ($app) {
            return new \App\Services\DeptCalculator\Service();
        });
    }
}
