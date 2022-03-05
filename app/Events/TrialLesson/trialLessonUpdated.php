<?php

namespace App\Events\TrialLesson;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class trialLessonUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trial_lesson;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trial_lesson)
    {
        $this->trial_lesson = $trial_lesson;
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
