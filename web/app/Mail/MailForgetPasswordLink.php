<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailForgetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject('We Jain Enlightened | Change Password !')
        ->from($address = config('mail.from.address'), $name = "We Jain Enlightened")
        ->view('Admin.Mails.mailToUserForgetPasswordLink');
    }
}
