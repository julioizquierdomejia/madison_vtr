<?php

namespace Database\Seeders;

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
        //
        $role = new Role();
        $role->name = 'superadmin';
        $role->description = 'superadmin';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'editor';
        $role->description = 'editor';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'user';
        $role->save();

    }
}
