<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $fillable = ['user_id','role_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

}
