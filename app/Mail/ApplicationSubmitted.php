<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $application; // isse blade me data milega

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        $subject = $this->application->status == 'Approved' 
            ? '🎉 Congrats! Your Scholarship is Approved' 
            : 'Update on your Scholarship Application';

        return $this->subject($subject)
                    ->view('emails.scholarship_status');
    }
}