<?php

namespace App\Listeners\Lesson;

use App\Events\Lesson\lessonUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class lessonUpdatedListener implements ShouldQueue
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
     * @param  \App\Events\Lesson\lessonUpdated  $event
     * @return void
     */
    public function handle(lessonUpdated $event)
    {
        //
    }
}
