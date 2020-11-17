<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $plan = new Plan();
        $plan->name = "Básico mensual";
        $plan->description = '<ul class="plan-list list-unstyled"><li class="my-2">2 rituales al mes</li><li class="my-2">3 bloques predeterminados</li><li class="my-2">1 bloque persoanlizado</li></ul>';
        $plan->enabled = 1;
        $plan->save();

        $plan = new Plan();
        $plan->name = "Medium mensual";
        $plan->description = '<ul class="plan-list list-unstyled"><li class="my-2">2 rituales al mes</li><li class="my-2">3 bloques predeterminados</li><li class="my-2">1 bloque persoanlizado</li></ul>';
        $plan->enabled = 1;
        $plan->save();

        $plan = new Plan();
        $plan->name = "Full mensual";
        $plan->description = '<ul class="plan-list list-unstyled"><li class="my-2">2 rituales al mes</li><li class="my-2">3 bloques predeterminados</li><li class="my-2">1 bloque persoanlizado</li></ul>';
        $plan->enabled = 1;
        $plan->save();
    }
}
