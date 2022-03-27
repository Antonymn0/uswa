<?php

namespace App\Listeners\TrialLesson;

use App\Events\TrialLesson\trialLessonCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\TrialLesson\TrialLessonCreatedMail;

class trialLessonCreatedListener implements ShouldQueue
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
     * @param  \App\Events\TrialLesson\trialLessonCreated  $event
     * @return void
     */
    public function handle(trialLessonCreated $event)
    {
        //send emails
        Mail::to($event->tutor->email)->send(new TrialLessonCreatedMail($event->trial_lesson, $event->tutor));
    }
}
