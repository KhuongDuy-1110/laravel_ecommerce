<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'client_id', 'client_name', 'client_email', 'client_address', 'orderDetail',
    ];
}
