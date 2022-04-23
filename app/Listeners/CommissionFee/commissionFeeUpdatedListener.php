<?php

namespace App\Listeners\CommissionFee;

use App\Events\CommissionFee\commissionFeeUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\CommisionFeeRevised;
use App\Models\User;

class commissionFeeUpdatedListener implements shouldQueue
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
        $commision_fee = $event->commision_fee;
        $old_account = $event->old_account;

        $tutors = User::where('role', 'tutor')->get();

        foreach ($tutors as $tutor) {
            //send commision/fee update email
            Mail::to($tutor->email)->send(new CommisionFeeRevised($commision_fee, $old_account, $tutor));
        }

        
    }
}
