<?php

namespace App\Listeners\TrialLesson;

use App\Events\TrialLesson\trialLessonAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\TrialLesson\TrialLessonAcceptedMail;

class trialLessonAcceptedListener implements ShouldQueue
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
     * @param  \App\Events\TrialLesson\trialLessonAccepted  $event
     * @return void
     */
    public function handle(trialLessonAccepted $event)
    {
       //send emails
        Mail::to($event->student->email)->send(new TrialLessonAcceptedMail($event->trial_lesson, $event->student));
    }
}
