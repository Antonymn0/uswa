<?php

namespace App\Mail\PaypalPayments;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UswaPaymentAuthorised extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $transaction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/paypalPayments/paymentAuthorised');
    }
}
