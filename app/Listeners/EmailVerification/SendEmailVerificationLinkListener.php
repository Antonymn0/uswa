<?php

namespace App\Listeners\EmailVerification;

use App\Events\EmailVerification\SendEmailVerificationLink;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification\VerifyEmail;

class SendEmailVerificationLinkListener implements shouldQueue
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
     * @param  \App\Events\EmailVerification\SendEmailVerificationLink  $event
     * @return void
     */
    public function handle(SendEmailVerificationLink $event)
    {
        //send verification link email
        Mail::to($event->user->email)->send(new VerifyEmail($event->user));
    }
}
