<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\AccountRepository::class, \App\Repositories\AccountRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MeterRepository::class, \App\Repositories\MeterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MeterValueRepository::class, \App\Repositories\MeterValueRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrganizationRepository::class, \App\Repositories\OrganizationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServiceRepository::class, \App\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
