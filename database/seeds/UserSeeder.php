<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        // DB::table("users")->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('123'),
        // ]);
        //------------------

        // DB::table("users")->insert([
        //     'name' => 'user1',
        //     'email' => 'user1@gmail.com',
        //     'password' => Hash::make('123'),
        // ]);
        
        factory(App\Models\User::class,100)->create();

    }
}
