<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        
        $role_superadmin = Role::where('name', 'superadmin')->first();


        $user = new User();
        $user->name = 'Admin_Madison';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345678');

        $user->save();

        $user->roles()->attach($role_superadmin);
    }
}
