<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Category $category)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function update(Admin $admin, Category $category)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function delete(Admin $admin, Category $category)
    {
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function restore(Admin $admin, Category $category)
    {
        //
    }

    public function forceDelete(Admin $admin, Category $category)
    {
        //
    }
}
