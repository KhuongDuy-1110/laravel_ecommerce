<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, User $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function update(User $user, User $model)
    {
        return Auth::user()->id != $model->id && ($user->roles[0]['name'] === Role::ROLE_MANAGER || $user->roles[0]['name'] === Role::ROLE_STAFF);
    }

    public function delete(User $user, User $model)
    {
        return Auth::user()->id != $model->id && $user->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
