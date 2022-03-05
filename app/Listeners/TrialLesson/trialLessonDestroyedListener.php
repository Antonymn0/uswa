<?php

namespace App\Listeners\TrialLesson;

use App\Events\TrialLesson\trialLessonDestroyed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class trialLessonDestroyedListener
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
     * @param  \App\Events\TrialLesson\trialLessonDestroyed  $event
     * @return void
     */
    public function handle(trialLessonDestroyed $event)
    {
        //
    }
}
