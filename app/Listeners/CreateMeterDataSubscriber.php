<?php

namespace App\Listeners;

use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Events\onMeterDataChanged;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\MeterRepoEloquent;
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
        $events->listen(onMeterDataChanged::class, CreateMeterDataSubscriber::class . '@handle');
    }

//    /**
//     * Handle the event.
//     *
//     * @param onMeterDataChanged $event
//     */
//    public function handle(onMeterDataChanged $event)
//    {
//        /** @var MeterData $mData */
//        $mData = $event->getObject();
//        /** @var Meter $meter */
//        $meter = $mData->meter;
//        /** @var MeterRepoEloquent $meterRepo */
//        $meterRepo = resolve(MeterRepo::class);
//        $meterRepo->reCalculateDept($meter);
//    }
}
