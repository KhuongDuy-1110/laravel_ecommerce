<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Orders;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use App\Models\UserRole;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'dob', 'phone', 'address', 'verification_code','email_verified_at','expired_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($user) {
            $user->orders()->delete();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // public function user_roles()
    // {
    //     return $this->hasMany(UserRole::class, 'user_id', 'id');
    // }

    public function orders()
    {
        return $this->hasMany(Orders::class,'client_id','id');
    }

}
