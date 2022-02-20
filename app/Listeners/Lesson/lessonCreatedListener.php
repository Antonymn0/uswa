<?php

namespace App\Listeners\Lesson;

use App\Events\Lesson\lessonCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class lessonCreatedListener
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
     * @param  \App\Events\Lesson\lessonCreated  $event
     * @return void
     */
    public function handle(lessonCreated $event)
    {
        //
    }
}
