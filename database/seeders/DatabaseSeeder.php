<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(StatusSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(RitualSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SupportSeeder::class);
    }
}
