<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment', function (Blueprint $table) {
            $table->bigIncrements('id_payment');
            $table->string('id_order');
            $table->bigInteger('value_clean')->default(0);
            $table->bigInteger('app_fee')->default(0);
            $table->bigInteger('value_total')->default(0);
            $table->unsignedBigInteger('id_method')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });

        Schema::table('order_payment', function ($table) {
            $table->foreign('id_order')->references('id_order')->on('order')->onDelete('cascade');
            $table->foreign('id_method')->references('id_method')->on('payment_method')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payment');
    }
}
