<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_request_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('video_requests', function (Blueprint $table) {
            $table->id();

            $table->string('topic');
            $table->string('type');
            $table->string('avatar');
            $table->text('comments')->nullable();
            $table->string('speech');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('video_request_status')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('video_request_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('video_request_id');
            $table->foreign('video_request_id')->references('id')->on('video_requests')->onDelete('cascade');

            $table->unsignedBigInteger('request_service_id');
            $table->foreign('request_service_id')->references('id')->on('request_services')->onDelete('cascade');

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
        Schema::table('video_requests', function (Blueprint $table) {
            $table->dropForeign('video_requests_user_id_foreign');
            $table->dropForeign('video_requests_status_id_foreign');
        });
        Schema::table('video_request_services', function (Blueprint $table) {
            $table->dropForeign('video_request_services_video_request_id_foreign');
            $table->dropForeign('video_request_services_request_service_id_foreign');
        });
        Schema::dropIfExists('video_request_status');
        Schema::dropIfExists('video_requests');
    }
}
