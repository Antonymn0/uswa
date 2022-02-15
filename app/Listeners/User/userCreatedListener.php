<?php

namespace App\Listeners\User;

use App\Events\User\userCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\WelcomeToUswa;
use App\Mail\EmailVerification\VerifyEmail;

class userCreatedListener implements ShouldQueue
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
     * @param  \App\Events\User\userCreated  $event
     * @return void
     */
    public function handle(userCreated $event)
    {
        //send welcome emails
        Mail::to($event->user->email)->send(new WelcomeToUswa($event->user));
        Mail::to($event->user->email)->send(new verifyEmail($event->user));
    }
}
