<?php

namespace App\Listeners\User;

use App\Events\User\tutorAccountApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\User\TutorAccountApprovedMail;

class tutorAccountApprovedListener
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
     * @param  \App\Events\User\tutorAccountApproved  $event
     * @return void
     */
    public function handle(tutorAccountApproved $event)
    {
       Mail::to($event->tutor->email)->send(new TutorAccountApprovedMail($event->tutor));
    }
}
