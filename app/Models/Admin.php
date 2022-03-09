<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Role;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_admin');
    }
}
