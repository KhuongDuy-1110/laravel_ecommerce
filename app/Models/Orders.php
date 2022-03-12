<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'client_id', 'client_phone', 'client_address', 'orderDetail', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'client_id');
    }

}
