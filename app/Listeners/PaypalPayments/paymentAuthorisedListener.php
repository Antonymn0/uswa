<?php

namespace App\Listeners\PaypalPayments;

use App\Events\PaypalPayments\paymentAuthorised;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\PaypalPayments\UswaPaymentAuthorised;

class paymentAuthorisedListener
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
     * @param  \App\Events\PaypalPayments\paymentAuthorised  $event
     * @return void
     */
    public function handle(paymentAuthorised $event)
    {
        //send emails
        Mail::to($event->user->email)->send(new UswaPaymentAuthorised($event->user, $event->transaction));
    }
}
