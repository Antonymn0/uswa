<?php

namespace App\Listeners\Transaction;

use App\Events\Transaction\TransactionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\Transaction\TransactionProcessed;
use App\Mail\Transaction\WithdrawalSuccessful;

class transactionCreatedListener implements ShouldQueue
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
     * @param  \App\Events\Transaction\TransactionCreated  $event
     * @return void
     */
    public function handle(TransactionCreated $event)
    {
        $transaction = $event->transaction;
        $user = $event->user;
        //send emails
        if($event->transaction->transaction_type == 'topup')
            Mail::to($user->email)->send(new TransactionProcessed($transaction, $user));

        if($event->transaction->transaction_type == 'withdrawal')
            Mail::to($user->email)->send(new WithdrawalSuccessful($transaction, $user));
    }
}
