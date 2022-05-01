<?php

namespace App\Http\Controllers;

use App\Jobs\SendActionSetDefaultPassword;
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

        $job = new SendRegisterMail($details);
        SendRegisterMail::dispatch($job);        
    }

    public static function confirmOrderMail($email,$orderDetail)
    {
        $details = [
            'title' => 'Incoming confirmation order mail',
            'body' => 'Thank you for choosing out product, here is your order !',
            'email' => $email,
            'orderDetail' => $orderDetail,
        ];

        $job = new SendOrderMail($details);
        SendOrderMail::dispatch($job);
    }

    public static function sendOrdersReport($data)
    {
        $job = new SendProductReportMail($data);
        SendProductReportMail::dispatch($job);
    }

    public static function sendActionDefaultPassword($email, $verification_code)
    {
        $details = [
            'title' => 'Incoming an important message !',
            'body' => 'This is your link to set the password of your account to the default: {12345678}',
            'email' => $email,
            'verification_code' => $verification_code,
        ];
        $job = new SendActionSetDefaultPassword($details);
        SendActionSetDefaultPassword::dispatch($job);
    }
}
