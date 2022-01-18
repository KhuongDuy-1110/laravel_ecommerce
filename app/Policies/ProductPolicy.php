<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Product $product)
    {
        return true;
    }

    public function create(User $user)
    {       
        // nvaa@gmail.com -> user
        // nva@gmail.com -> manager        
        return $user->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function update(User $user, Product $product)
    {
        
        return $user->roles[0]['name'] === Role::ROLE_MANAGER || $user->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function delete(User $user, Product $product)
    {
        
        return $user->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function restore(User $user, Product $product)
    {
        //
    }

    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
