<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use App\Jobs\SendRegisterMail;

class MailController extends Controller
{
    public static function verificationMail($email, $verification_code)
    {
        $details = [
            'title' => 'Incoming mail from Khuong Pham',
            'body' => 'Please click the link below to verify your account: ',
            'verification_code' => $verification_code,
            'email' => $email,
        ];
        // Mail::to($email)->send(new VerifyMail($details));

        $job = new SendRegisterMail($details);
        SendRegisterMail::dispatch($job);
        
        
    }
}
