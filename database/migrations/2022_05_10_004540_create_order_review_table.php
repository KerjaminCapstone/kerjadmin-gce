<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_review', function (Blueprint $table) {
            $table->bigIncrements('id_review');
            $table->string('id_order');
            $table->unsignedBigInteger('id_freelance');
            $table->double('rating');
            $table->string('commentary');
            $table->double('nlp_score')->nullable();
            $table->timestamps();
        });

        Schema::table('order_review', function ($table) {
            $table->foreign('id_order')->references('id_order')->on('order')->onDelete('cascade');
            $table->foreign('id_freelance')->references('id_freelance')->on('freelance_data')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_review');
    }
}
