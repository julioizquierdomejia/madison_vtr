<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoStatus;
use App\Models\VideoRequestStatus;
use App\Models\RequestService;
use App\Models\VideoType;

class VideoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Estado de solicitud
        $video_r_status = new VideoRequestStatus();
        $video_r_status->name = "Solicitado";
        $video_r_status->save();
        $video_r_status = new VideoRequestStatus();
        $video_r_status->name = "Procesando";
        $video_r_status->save();
        $video_r_status = new VideoRequestStatus();
        $video_r_status->name = "Resuelto";
        $video_r_status->save();

        //Servicios al solicitar video
        $video_r_service = new RequestService();
        $video_r_service->name = "Activar servicio express";
        $video_r_service->save();
        $video_r_service = new RequestService();
        $video_r_service->name = "Animación";
        $video_r_service->save();
        $video_r_service = new RequestService();
        $video_r_service->name = "Grabación";
        $video_r_service->save();

        //Tipos de vídeos
        $video_type = new VideoType();
        $video_type->name = "Subido";
        $video_type->save();
        $video_type = new VideoType();
        $video_type->name = "Solicitado";
        $video_type->save();

        //Estados de vídeos
        $video_status = new VideoStatus();
        $video_status->name = "Subido";
        $video_status->save();
        $video_status = new VideoStatus();
        $video_status->name = "Por Aprobar";
        $video_status->save();
        $video_status = new VideoStatus();
        $video_status->name = "Aprobado";
        $video_status->save();
        $video_status = new VideoStatus();
        $video_status->name = "En revisión";
        $video_status->save();
        $video_status = new VideoStatus();
        $video_status->name = "En producción";
        $video_status->save();
    }
}
