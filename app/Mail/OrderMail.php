<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;



    public function __construct($details)
    {
        $this->details = $details;
    }

    
    public function build()
    {
        return $this->subject('Incoming mail from khuong.pham@tda')->view('mail.MailOrder',['details' => $this->details]);
    }
}
