<?php

namespace App\Providers;

use App\Entities\Organization;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Entities\MeterValue;
use App\Events\onCreatedMeterValue;
use App\Listeners\CreateMeterValueListener;

class EntitiesEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        onCreatedMeterValue::class => [
            CreateMeterValueListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(
            'eloquent.created: ' . MeterValue::class, CreateMeterValueListener::class
        );
    }
}
