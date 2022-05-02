<?php

namespace App\Jobs;

use App\Mail\ForgetPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendActionSetDefaultPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }
    
    public function handle()
    {
        $mailAddress = $this->details->details['email'];
        Mail::to($mailAddress)->send(new ForgetPasswordMail($this->details));
    }
}
