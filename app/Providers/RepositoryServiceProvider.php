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
        $this->app->bind(\App\Models\Repositories\AccountRepo::class, \App\Models\Repositories\AccountRepoEloquent::class);
        $this->app->bind(\App\Models\Repositories\MeterRepo::class, \App\Models\Repositories\MeterRepoEloquent::class);
        $this->app->bind(\App\Models\Repositories\MeterValueRepo::class, \App\Models\Repositories\MeterValueRepoEloquent::class);
        $this->app->bind(\App\Models\Repositories\OrganizationRepo::class, \App\Models\Repositories\OrganizationRepoEloquent::class);
        $this->app->bind(\App\Models\Repositories\ServiceRepo::class, \App\Models\Repositories\ServiceRepoEloquent::class);
        $this->app->bind(\App\Models\Repositories\UserRepo::class, \App\Models\Repositories\UserRepoEloquent::class);
        //:end-bindings:
    }
}
