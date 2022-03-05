<?php

namespace App\Events\TrialLesson;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class trialLessonDeclined
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $trial_lesson;
    public $student;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trial_lesson, $student)
    {
        $this->trial_lesson = $trial_lesson;
        $this->student = $student;
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
