<?php

namespace App\Mail\TrialLesson;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrialLessonAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trial_lesson;
    public $student;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trial_lesson, $student)
    {
        $this->trial_lesson = $trial_lesson;
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/trialLesson/trialLessonAcceptedEmail');
    }
}
