<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RitualObjective;
use App\Models\RitualType;
use App\Models\RitualStatus;

class RitualSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Tipos de rituales
        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Incentivar la colaboración";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Empatía";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Co-creación";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Liderazgo";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Batimovil";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        $ritual_objective = new RitualObjective();
        $ritual_objective->name = "Coaching";
        $ritual_objective->enabled = 1;
        $ritual_objective->save();

        //Estados de rituales
        $ritual_type = new RitualType();
        $ritual_type->alias = "Armado";
        $ritual_type->name = "Armaré el ritual a medida";
        $ritual_type->save();

        $ritual_type = new RitualType();
        $ritual_type->alias = "Sugerido";
        $ritual_type->name = "Sugerirme un ritual";
        $ritual_type->save();

        //Estados de rituales
        $ritual_status = new RitualStatus();
        $ritual_status->name = "Subido";
        $ritual_status->save();

        $ritual_status = new RitualStatus();
        $ritual_status->name = "Por Aprobar";
        $ritual_status->save();

        $ritual_status = new RitualStatus();
        $ritual_status->name = "Aprobado";
        $ritual_status->save();

        $ritual_status = new RitualStatus();
        $ritual_status->name = "En revisión";
        $ritual_status->save();

        $ritual_status = new RitualStatus();
        $ritual_status->name = "En producción";
        $ritual_status->save();
    }
}
