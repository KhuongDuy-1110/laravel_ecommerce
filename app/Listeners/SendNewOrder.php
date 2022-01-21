<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewOrder;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;

class SendNewOrder
{
    public function __construct()
    {
        //
    }

    public function handle(NewOrder $event)
    {
        $text = "A new order\n"
            . "<b>Email Address: </b>\n"
            . $event->email."\n"
            . "<b>Message: </b>\n"
            . "Incoming new order at ".Carbon::now('Asia/Ho_Chi_Minh');

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID'),
            'parse_mode' => 'HTML',
            'text' => $text,
        ]);
    }
}
