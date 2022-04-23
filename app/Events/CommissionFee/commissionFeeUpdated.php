<?php

namespace App\Events\CommissionFee;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class commissionFeeUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $old_account;
    public $account;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $old_account, $account)
    {
        $this->old_account = $old_account;
        $this->account = $account;
        
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
