<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
    }
}
