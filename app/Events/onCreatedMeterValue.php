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
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $meterValue;

    /**
     * @return MeterValue
     */
    public function getMeterValue(): MeterValue
    {
        return $this->meterValue;
    }

    /**
     * Create a new event instance.
     *
     * @param MeterValue $meterValue
     */
    public function __construct(MeterValue $meterValue)
    {
        $this->meterValue = $meterValue;
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
