<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Category $category)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->roles[0]['name'] === Role::ROLE_MANAGER || $user->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function update(User $user, Category $category)
    {
        return $user->roles[0]['name'] === Role::ROLE_MANAGER || $user->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function delete(User $user, Category $category)
    {
        return $user->roles[0]['name'] === Role::ROLE_MANAGER || $user->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function restore(User $user, Category $category)
    {
        //
    }

    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
