<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_types', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->timestamps();
        });

        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('support_type_id')->unsigned();
            $table->foreign('support_type_id')->references('id')->on('support_types')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('message');
            $table->boolean('answered')->default(0);
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
        Schema::table('supports', function (Blueprint $table) {
            $table->dropForeign('videos_support_type_id_foreign');
            $table->dropForeign('videos_user_id_foreign');
        });
        Schema::dropIfExists('supports');
        Schema::dropIfExists('support_types');
    }
}
