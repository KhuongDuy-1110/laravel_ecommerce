<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const ROLE_MANAGER = 1;
    const ROLE_STAFF = 2;
    const ROLE_USER = 3;

    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = 'name';

    public function userRole()
    {
        return $this->hasOne('App\UserRole','role_id');
    }

}
