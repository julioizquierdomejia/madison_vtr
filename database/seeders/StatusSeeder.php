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
        $status->alias = "reviewing";
        $status->name = "En revisión"; //cuando se crea el vídeo (superadmin/cliente)
        $status->class = "fas fa-eye";
        $status->color = "text-danger";
        $status->save();

        $status = new Status();
        $status->alias = "approved";
        $status->name = "Aprobado"; //el cliente puede aprobar el vídeo (se publica el vídeo)
        $status->class = "fas fa-check";
        $status->color = "text-success";
        $status->save();

        $status = new Status();
        $status->alias = "changing";
        $status->name = "Haciendo cambios"; //o el cliente puede pedir cambios en el vídeo
        $status->class = "fas fa-spin";
        $status->color = "text-yellow";
        $status->save();

        $status = new Status();
        $status->alias = "for_approving";
        $status->name = "Por Aprobar"; //al pedir cambios el cliente en el vídeo
        $status->class = "fas fa-spinner fa-spin";
        $status->color = "text-danger";
        $status->save();

        $status = new Status();
        $status->alias = "published";
        $status->name = "En producción"; //cuando el superadmin crea el vídeo (se publica el vídeo)
        $status->class = "fas fa-play";
        $status->color = "text-success";
        $status->save();
    }
}
