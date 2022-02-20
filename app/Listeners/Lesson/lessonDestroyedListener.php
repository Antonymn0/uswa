<?php

namespace App\Listeners\Lesson;

use App\Events\Lesson\lessonDestroyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class lessonDestroyedListener
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
     * @param  \App\Events\Lesson\lessonDestroyed  $event
     * @return void
     */
    public function handle(lessonDestroyed $event)
    {
        //
    }
}
