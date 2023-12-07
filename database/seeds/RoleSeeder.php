<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'manager'
            ],
            [
                'name' => 'staff'
            ],
            [
                'name' => 'user'
            ]
        ];
        $roleData = Role::all()->count();
        if (empty($roleData)) {
            Role::insert($data);
        }
    }
}
