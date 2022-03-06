<?php

namespace App\Listeners\User;

use App\Events\User\tutorAccountDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\TutorAccountDeclinedMail;

class tutorAccountDeclinedListener
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
     * @param  \App\Events\User\tutorAccountDeclined  $event
     * @return void
     */
    public function handle(tutorAccountDeclined $event)
    {
        Mail::to($event->tutor->email)->send(new TutorAccountDeclinedMail($event->tutor));
    }
}
