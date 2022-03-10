<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Admin $model)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function update(Admin $admin, Admin $model)
    {
        return Auth::guard('admin')->id() != $model->id && ($admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF);
    }

    public function delete(Admin $admin, Admin $model)
    {
        return Auth::guard('admin')->id() != $model->id && $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function restore(Admin $admin, Admin $model)
    {
        //
    }

    public function forceDelete(Admin $admin, Admin $model)
    {
        //
    }
}
