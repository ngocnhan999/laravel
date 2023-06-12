<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentActivationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    //xu ly viec gui mail
     public function build()
    {
        return $this->view('frontend.email.student-activation')->with('student', $this->student);
    }
}
