<?php

namespace App\Mail\Transaction;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transaction, $user)
    {
        $this->transaction = $transaction;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/transaction/withdrawalSuccessful');
    }
}
