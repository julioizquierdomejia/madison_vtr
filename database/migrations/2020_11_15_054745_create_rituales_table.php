<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRitualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rituales', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->bigInteger('ritual_objective_id')->unsigned();
            $table->foreign('ritual_objective_id')->references('id')->on('ritual_objectives');

            $table->bigInteger('ritual_status_id')->unsigned();
            $table->foreign('ritual_status_id')->references('id')->on('ritual_status');

            $table->date('published');
            $table->boolean('enabled');

            $table->timestamps();
        });

        Schema::create('ritual_parts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ritual_id')->unsigned();
            $table->foreign('ritual_id')->references('id')->on('rituales');

            $table->bigInteger('video_id')->unsigned();
            $table->foreign('video_id')->references('id')->on('videos');

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
        Schema::table('rituales', function (Blueprint $table) {
            $table->dropForeign('ritual_objective_id_foreign');
            $table->dropForeign('ritual_status_id_foreign');
        });

        Schema::table('ritual_parts', function (Blueprint $table) {
            $table->dropForeign('ritual_ritual_id_foreign');
            $table->dropForeign('ritual_video_id_foreign');
        });

        Schema::dropIfExists('rituales');
        Schema::dropIfExists('ritual_parts');
    }
}
