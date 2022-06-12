<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_task', function (Blueprint $table) {
            $table->bigIncrements('id_task');
            $table->string('id_order');
            $table->string('task_desc');
            $table->boolean('task_status');
            $table->timestamps();
        });

        Schema::table('order_task', function ($table) {
            $table->foreign('id_order')->references('id_order')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_task');
    }
}
