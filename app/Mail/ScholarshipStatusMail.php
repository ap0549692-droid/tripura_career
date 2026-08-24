<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScholarshipStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Scholarship Application Status Update')
                    ->view('emails.scholarship-status'); // YE LINE SABSE IMPORTANT
    }
}