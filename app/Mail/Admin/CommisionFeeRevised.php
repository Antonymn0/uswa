<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommisionFeeRevised extends Mailable
{
    use Queueable, SerializesModels;

    public $commision_fee;
    public $tutor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commision_fee, $tutor)
    {
        $this->commision_fee = $commision_fee;
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
