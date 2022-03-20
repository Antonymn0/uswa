<?php

namespace App\Listeners\PaypalPayments;

use App\Events\PaypalPayments\paypalMerchantOnbordingSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\PaypalPayments\UswaPaypalOnboardingSuccess;


class paypalMerchantOnbordingSuccessListener
{
   

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaypalPayments\paypalMerchantOnbordingSuccess  $event
     * @return void
     */
    public function handle(paypalMerchantOnbordingSuccess $event)
    {
        //send emails
        Mail::to($event->user->email)->send(new UswaPaypalOnboardingSuccess($event->user));
    }
}
