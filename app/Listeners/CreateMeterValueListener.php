<?php

namespace App\Listeners;

use App\Entities\MeterValue;
use App\Events\onCreatedMeterValue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use mysql_xdevapi\Exception;

class CreateMeterValueListener
{
    use FetchObjectTrait;

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
        $class = MeterValue::class;
        $meterValue = $this->fetchObject($object, $class);
    }
}
