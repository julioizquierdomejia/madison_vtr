<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Support;
use App\Models\SupportType;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new SupportType();
        $role->name = 'Quiero cambiar el plan que tengo';
        $role->save();

        $role = new SupportType();
        $role->name = 'Tengo dudas sobre los rituales';
        $role->save();

        $role = new SupportType();
        $role->name = 'No entiendo muy bien como subir o solicitar un video';
        $role->save();

        $role = new SupportType();
        $role->name = 'Tengo un problema';
        $role->save();

        $role = new SupportType();
        $role->name = 'Otro tema';
        $role->save();

    }
}
