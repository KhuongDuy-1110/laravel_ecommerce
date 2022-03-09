<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, User $model)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function update(Admin $admin, User $model)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function delete(Admin $admin, User $model)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function restore(Admin $admin, User $model)
    {
        //
    }

    public function forceDelete(Admin $admin, User $model)
    {
        //
    }
}
