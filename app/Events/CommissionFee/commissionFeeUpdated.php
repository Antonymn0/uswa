<?php

namespace App\Events\CommissionFee;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class commissionFeeUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $commision_fee;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commision_fee)
    {
        $this->commision_fee = $commision_fee;
        
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
