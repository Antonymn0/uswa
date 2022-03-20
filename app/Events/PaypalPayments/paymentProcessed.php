<?php

namespace App\Events\PaypalPayments;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class paymentProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $User;
    public $transaction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
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