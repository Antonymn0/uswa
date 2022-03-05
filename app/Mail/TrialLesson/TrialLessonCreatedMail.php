<?php

namespace App\Mail\TrialLesson;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrialLessonCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trial_lesson;
    public $tutor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trial_lesson, $tutor)
    {
        $this->trial_lesson = $trial_lesson;
        $this->tutor = $tutor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/trialLesson/trialLessonCreatedEmail');
    }
}
