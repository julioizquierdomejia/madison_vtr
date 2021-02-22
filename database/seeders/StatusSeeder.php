<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Estados de vídeos
        $status = new Status();
        $status->name = "Por Aprobar";
        $status->class = "fa-spin";
        $status->color = "badge-dark";
        $status->save();
        $status = new Status();
        $status->name = "En revisión";
        $status->class = "fa-eye";
        $status->color = "badge-danger";
        $status->save();
        $status = new Status();
        $status->name = "Aprobado";
        $status->class = "fa-success";
        $status->color = "badge-success";
        $status->save();
        $status = new Status();
        $status->name = "En producción";
        $status->class = "fa-play";
        $status->color = "badge-warning";
        $status->save();
    }
}
