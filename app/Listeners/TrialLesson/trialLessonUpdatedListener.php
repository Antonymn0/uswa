<?php

namespace App\Listeners\TrialLesson;

use App\Events\TrialLesson\trialLessonUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class trialLessonUpdatedListener implements ShouldQueue
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
     * @param  \App\Events\TrialLesson\trialLessonUpdated  $event
     * @return void
     */
    public function handle(trialLessonUpdated $event)
    {
        //
    }
}
