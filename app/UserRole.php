<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    protected $fillable = ['role_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

}
