<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_MANAGER = 'manager';
    const ROLE_STAFF = 'staff';
    const ROLE_USER = 'user';

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
