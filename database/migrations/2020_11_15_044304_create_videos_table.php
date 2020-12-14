<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->text('description')->nullable();

            $table->bigInteger('video_type_id')->unsigned();
            $table->foreign('video_type_id')->references('id')->on('videos');

            $table->bigInteger('video_status_id')->unsigned();
            $table->foreign('video_status_id')->references('id')->on('video_status');

            $table->string('format');
            //$table->string('quality');
            //$table->string('audio');

            $table->boolean('enabled');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('videos_video_type_id_foreign');
            $table->dropForeign('videos_video_status_id_foreign');
        });

        Schema::dropIfExists('videos');
    }
}
