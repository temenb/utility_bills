<?php

namespace App\Listeners;

use App\Entities\MeterValue;
use App\Events\onCreatedMeterValue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use mysql_xdevapi\Exception;

class CreateMeterValueListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $object
     */
    public function handle($object)
    {
        if ($object instanceof MeterValue) {
            $meterValue = $object;
        } else if (is_callable([$object, 'getMeterValue'])){
            $meterValue = $object->getMeterValue();
        } else {
            throw new Exception('MeterValue entity is not found.');
        }
    }
}
