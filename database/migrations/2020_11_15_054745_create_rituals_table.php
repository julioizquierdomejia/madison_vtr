<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRitualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rituals', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->bigInteger('ritual_status_id')->unsigned();
            $table->foreign('ritual_status_id')->references('id')->on('ritual_status');

            $table->bigInteger('ritual_type_id')->unsigned();
            $table->foreign('ritual_type_id')->references('id')->on('ritual_types');

            $table->date('published');
            $table->boolean('enabled');

            $table->timestamps();
        });

        Schema::create('ritual_objectives', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ritual_id')->unsigned();
            $table->foreign('ritual_id')->references('id')->on('rituals');
            
            $table->bigInteger('ritual_objective_id')->unsigned();
            $table->foreign('ritual_objective_id')->references('id')->on('objectives');

            $table->timestamps();
        });

        Schema::create('ritual_videos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ritual_id')->unsigned();
            $table->foreign('ritual_id')->references('id')->on('rituals');

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
        Schema::table('rituals', function (Blueprint $table) {
            $table->dropForeign('ritual_status_id_foreign');
            $table->dropForeign('ritual_type_id_foreign');
        });
        Schema::table('ritual_objectives', function (Blueprint $table) {
            $table->dropForeign('ritual_objective_id_foreign');
            $table->dropForeign('ritual_id_foreign');
        });

        Schema::table('ritual_parts', function (Blueprint $table) {
            $table->dropForeign('ritual_ritual_id_foreign');
            $table->dropForeign('ritual_video_id_foreign');
        });

        Schema::dropIfExists('rituals');
        Schema::dropIfExists('ritual_parts');
    }
}
