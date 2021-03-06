<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Entities\MeterDebt::class => \App\Policies\AccountPolicy::class,
        \App\Models\Entities\Meter::class => \App\Policies\MeterPolicy::class,
        \App\Models\Entities\Organization::class => \App\Policies\OrganizationPolicy::class,
        \App\Models\Entities\Service::class => \App\Policies\ServicePolicy::class,
        \App\Models\Entities\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
