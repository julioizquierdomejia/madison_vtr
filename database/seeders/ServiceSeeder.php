<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Servicios al solicitar video
        $video_r_service = new Service();
        $video_r_service->name = "Activar servicio express";
        $video_r_service->save();
        $video_r_service = new Service();
        $video_r_service->name = "Animación";
        $video_r_service->save();
        $video_r_service = new Service();
        $video_r_service->name = "Grabación";
        $video_r_service->save();
    }
}
