<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
// use App\Mail\OrdersReportmail;
use App\Jobs\SendRegisterMail;
use App\Jobs\SendOrderMail;
use App\Jobs\SendProductReportMail; 

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

    public static function confirmOrderMail($email)
    {
        $details = [
            'title' => 'Incoming confirmation order mail',
            'body' => 'Thank you for choosing out product, here is your order !',
            'email' => $email,
        ];

        $job = new SendOrderMail($details);
        SendOrderMail::dispatch($job);

    }

    public static function sendOrdersReport($data){

        $job = new SendProductReportMail($data);
        SendProductReportMail::dispatch($job);

    }

}
