<?php

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(RoleSeeder::class);
        $managerRole = Role::where('name','manager')->first();
        $adminAccountData = [
            'name' => 'Phạm Duy Khương',
            'email' => 'khuong.pd@zinza.com.vn',
            'password' => Hash::make('khuong@123'),
        ];
        $admin = Admin::updateOrCreate([
            'email' => $adminAccountData['email']
        ], $adminAccountData);
        $admin->roles()->detach();
        $admin->roles()->attach($managerRole->id);
    }
}
