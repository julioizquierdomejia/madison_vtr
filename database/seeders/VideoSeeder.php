<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoStatus;
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
