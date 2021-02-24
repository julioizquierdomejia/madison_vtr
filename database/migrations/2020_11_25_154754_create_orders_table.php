<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('topic');
            $table->string('type');
            $table->string('avatar');
            $table->text('comments')->nullable();
            $table->string('speech');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('objective_id');
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade');

            $table->unsignedBigInteger('video_id')->nullable();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');

            $table->timestamps();
        });

        /*Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->timestamps();
        });*/

        Schema::create('order_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_objective_id_foreign');
            $table->dropForeign('orders_video_id_foreign');
            //$table->dropForeign('orders_status_id_foreign');
        });
        // Schema::table('order_statuses', function (Blueprint $table) {
        //     $table->dropForeign('order_statuses_order_id_foreign');
        //     $table->dropForeign('order_statuses_status_id_foreign');
        // });
        Schema::table('order_services', function (Blueprint $table) {
            $table->dropForeign('order_services_order_id_foreign');
            $table->dropForeign('order_services_service_id_foreign');
        });
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('order_services');
    }
}
