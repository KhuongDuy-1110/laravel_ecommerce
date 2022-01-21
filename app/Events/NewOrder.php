<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    
    public function __construct( $email )
    {
        $this->email = $email;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
