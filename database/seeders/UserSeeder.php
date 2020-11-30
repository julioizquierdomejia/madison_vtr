<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Plan;

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
        $plans_basico = Plan::where('name', 'Full mensual')->first();


        $user = new User();
        $user->name = 'Admin_Madison';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345678');

        $user->save();

        $user->roles()->attach($role_superadmin);
        $user->plans()->attach($plans_basico);
    }
}
