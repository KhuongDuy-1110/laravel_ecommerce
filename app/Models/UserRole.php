<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';

    protected $fillable = ['user_id','role_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

}
