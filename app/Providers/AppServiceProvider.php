<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        \App\Models\Repositories\AccountRepo::class
            => \App\Models\Repositories\AccountRepoEloquent::class,
        \App\Models\Repositories\MeterRepo::class
            => \App\Models\Repositories\MeterRepoEloquent::class,
        \App\Models\Repositories\MeterValueRepo::class
            => \App\Models\Repositories\MeterValueRepoEloquent::class,
        \App\Models\Repositories\OrganizationRepo::class
            => \App\Models\Repositories\OrganizationRepoEloquent::class,
        \App\Models\Repositories\PasswordResetRepo::class
            => \App\Models\Repositories\PasswordResetRepoEloquent::class,
        \App\Models\Repositories\ServiceRepo::class
            => \App\Models\Repositories\ServiceRepoEloquent::class,
        \App\Models\Repositories\UserRepo::class
            => \App\Models\Repositories\UserRepoEloquent::class,
    ];


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
        //
    }
}
