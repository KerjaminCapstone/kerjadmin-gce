<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_data', function (Blueprint $table) {
            $table->bigIncrements('id_client');
            $table->string('id_user');
            $table->text('address');
            $table->double('address_long')->nullable();
            $table->double('address_lat')->nullable();
            $table->boolean('is_male');
            $table->string('nik');
            $table->timestamps();
        });

        Schema::table('client_data', function ($table) {
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_datas');
    }
}
