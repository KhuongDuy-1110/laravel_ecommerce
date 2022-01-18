<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_MANAGER = 'manager';
    const ROLE_STAFF = 'staff';
    const ROLE_USER = 'user';

    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
