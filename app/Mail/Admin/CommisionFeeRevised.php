<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CommisionFeeRevised extends Mailable
{
    use Queueable, SerializesModels;

    public $old_account;
    public $account;
    public $tutor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($old_account, $account,  $tutor)
    {
        $this->old_account = $old_account;
        $this->account = $account;
        $this->tutor = $tutor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/admin/uswaCommisionFeeUpdatedEmail');
    }
}
