<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Entities\MeterData;

class onMeterDataChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $object;

    /**
     * Create a new event instance.
     *
     * @param MeterData $meterData
     */
    public function __construct(MeterData $meterData)
    {
        $this->setObject($meterData);
    }

    /**
     * @return MeterData
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param $object
     */
    protected function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }
}
