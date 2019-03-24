<?php

namespace App\Listeners;

use App\Models\Entities\MeterValue;
use App\Events\onCreatedMeterValue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use mysql_xdevapi\Exception;

class CreateMeterValueSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(onCreatedMeterValue::class, CreateMeterValueSubscriber::class . '@handle');
        $events->listen(
            'eloquent.created: ' . MeterValue::class,
            CreateMeterValueSubscriber::class . '@onMeterValueCreated'
        );
    }

    /**
     * Handle the event.
     *
     * @param onCreatedMeterValue $event
     */
    public function handle(onCreatedMeterValue $event)
    {
        $meterValue = $event->getObject();
        $this->onMeterValueCreated($meterValue);
    }

    /**
     * @param MeterValue $meterValue
     */
    public function onMeterValueCreated(MeterValue $meterValue)
    {
//        dump($meterValue);
    }
}
