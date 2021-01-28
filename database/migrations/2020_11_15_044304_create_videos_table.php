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

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('video_types')->onDelete('cascade');

            /*$table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('video_status');*/

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('format');
            $table->integer('part');
            //$table->string('quality');
            //$table->string('audio');

            $table->boolean('enabled');

            $table->timestamps();
        });

        Schema::create('video_objectives', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('video_id')->unsigned();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');

            $table->bigInteger('objective_id')->unsigned();
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('video_status_status', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('video_id')->unsigned();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('objectives')->onDelete('cascade');

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
            $table->dropForeign('videos_type_id_foreign');
            $table->dropForeign('videos_status_id_foreign');
            $table->dropForeign('videos_user_id_foreign');
        });
        Schema::table('video_objectives', function (Blueprint $table) {
            $table->dropForeign('video_objectives_video_id_foreign');
            $table->dropForeign('video_objectives_objective_id_foreign');
        });
        Schema::table('video_status_status', function (Blueprint $table) {
            $table->dropForeign('video_status_status_video_id_foreign');
            $table->dropForeign('video_status_status_status_id_foreign');
        });

        Schema::dropIfExists('videos');
        Schema::dropIfExists('video_status_status');
        Schema::dropIfExists('video_objectives');
    }
}
