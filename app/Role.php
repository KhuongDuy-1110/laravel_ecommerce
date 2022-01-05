<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_MANAGER = 1;
    const ROLE_STAFF = 2;
    const ROLE_USER = 3;

    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = ['name'];

    // public function userRole()
    // {
    //     return $this->hasOne('App\UserRole','role_id');
    // }

    public function user()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

}
