<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Entities\MeterValue;

class onCreatedMeterValue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, StoreObjectTrait;

    /**
     * Create a new event instance.
     *
     * @param MeterValue $meterValue
     */
    public function __construct(MeterValue $meterValue)
    {
        $this->setObject($meterValue);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
