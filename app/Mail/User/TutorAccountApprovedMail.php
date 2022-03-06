<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TutorAccountApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tutor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/user/tutorAccountApprovedEmail');
    }
}
