<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Product $product)
    {
        return true;
    }

    public function create(Admin $admin)
    {       
        // nvaa@gmail.com -> Admin
        // nva@gmail.com -> manager        
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function update(Admin $admin, Product $product)
    {
        
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER || $admin->roles[0]['name'] === Role::ROLE_STAFF;
    }

    public function delete(Admin $admin, Product $product)
    {
        
        return $admin->roles[0]['name'] === Role::ROLE_MANAGER;
    }

    public function restore(Admin $admin, Product $product)
    {
        //
    }

    public function forceDelete(Admin $admin, Product $product)
    {
        //
    }
}
