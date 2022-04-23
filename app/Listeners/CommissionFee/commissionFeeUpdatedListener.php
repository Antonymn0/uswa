<?php

namespace App\Listeners\CommissionFee;

use App\Events\CommissionFee\commissionFeeUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\CommisionFeeRevised;
use App\Models\User;

class commissionFeeUpdatedListener 
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
     * @param  \App\Events\CommissionFee\commissionFeeUpdated  $event
     * @return void
     */
    public function handle(commissionFeeUpdated $event)
    {


        $old_account = $event->old_account;
        $account = $event->account;

        $tutors = User::where('role', 'tutor')->get();

        foreach ($tutors as $tutor) {
            //send commision/fee update email
            Mail::to($tutor->email)->send(new CommisionFeeRevised($old_account, $account,  $tutor));
        }

        
    }
}
