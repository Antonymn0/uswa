<?php

namespace App\Listeners\PaypalPayments;

use App\Events\PaypalPayments\paymentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\PaypalPayments\UswaPaymentProcessed;

class paymentProcessedListener implements ShouldQueue
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
     * @param  \App\Events\PaypalPayments\paymentProcessed  $event
     * @return void
     */
    public function handle(paymentProcessed $event)
    {
        //send emails
        Mail::to($event->user->email)->send(new UswaPaymentProcessed($event->user, $event->transaction));
    }
}
