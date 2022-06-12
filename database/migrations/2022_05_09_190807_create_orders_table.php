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
        Schema::create('order', function (Blueprint $table) {
            $table->string('id_order')->unique();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_freelance');
            $table->string('job_child_code');
            $table->text('job_address')->nullable();
            $table->double('job_long')->nullable();
            $table->double('job_lat')->nullable();
            $table->text('job_description');
            $table->boolean('already_paid')->default(false);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->unsignedBigInteger('id_status');
            $table->timestamps();
        });

        Schema::table('order', function ($table) {
            $table->foreign('id_client')->references('id_client')->on('client_data')->onDelete('cascade');
            $table->foreign('id_freelance')->references('id_freelance')->on('freelance_data')->onDelete('cascade');
            $table->foreign('job_child_code')->references('job_child_code')->on('job_child_code')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('order_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
