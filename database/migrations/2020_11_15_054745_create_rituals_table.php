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

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('ritual_status')->onDelete('cascade');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ritual_types')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->date('published');
            $table->boolean('enabled');

            $table->timestamps();
        });

        Schema::create('ritual_objectives', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ritual_id')->unsigned();
            $table->foreign('ritual_id')->references('id')->on('rituals')->onDelete('cascade');
            
            $table->bigInteger('ritual_objective_id')->unsigned();
            $table->foreign('ritual_objective_id')->references('id')->on('objectives')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('ritual_videos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ritual_id')->unsigned();
            $table->foreign('ritual_id')->references('id')->on('rituals')->onDelete('cascade');

            $table->bigInteger('video_id')->unsigned();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');

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
            $table->dropForeign('rituals_status_id_foreign');
            $table->dropForeign('rituals_type_id_foreign');
            $table->dropForeign('rituals_user_id_foreign');
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
