<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;

    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function build()
    {
        return $this->subject('Teacher Registration Successful')
                    ->view('emails.teacher_registered');
    }
}
