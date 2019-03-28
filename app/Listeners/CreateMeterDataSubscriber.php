<?php

namespace App\Listeners;

use App\Models\Entities\MeterData;
use App\Events\onCreatedMeterData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use mysql_xdevapi\Exception;

class CreateMeterDataSubscriber
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
//        $events->listen(onCreatedMeterData::class, CreateMeterDataSubscriber::class . '@handle');
        $events->listen(
            'eloquent.created: ' . MeterData::class,
            CreateMeterDataSubscriber::class . '@onMeterDataCreated'
        );
    }

//    /**
//     * Handle the event.
//     *
//     * @param onCreatedMeterData $event
//     */
//    public function handle(onCreatedMeterData $event)
//    {
//        $meterData = $event->getObject();
//        $this->onMeterDataCreated($meterData);
//    }
//
//    /**
//     * @param MeterData $meterData
//     */
    public function onMeterDataCreated(MeterData $meterData)
    {
//        dump($meterData);
    }
}
