<?php

namespace App\Listeners\TrialLesson;

use App\Events\TrialLesson\trialLessonDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\TrialLesson\TrialLessonDeclinedMail;

class trialLessonDeclinedListener implements ShouldQueue
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
     * @param  \App\Events\TrialLesson\trialLessonDeclined  $event
     * @return void
     */
    public function handle(trialLessonDeclined $event)
    {
        //send emails
        Mail::to($event->student->email)->send(new TrialLessonDeclinedMail($event->trial_lesson, $event->student));
    }
}
