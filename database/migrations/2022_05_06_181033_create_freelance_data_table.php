<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelanceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelance_data', function (Blueprint $table) {
            $table->bigIncrements('id_freelance');
            $table->string('id_user');
            $table->boolean('is_trainee');
            $table->float('rating', 1, 1);
            $table->integer('job_done');
            $table->date('date_join');
            $table->double('points')->nullable()->default(0.0);
            //
            $table->text('address');
            $table->double('address_long')->nullable();
            $table->double('address_lat')->nullable();
            $table->boolean('is_male');
            $table->date('dob');
            $table->string('nik');
            $table->string('profile_pict')->nullable();
            $table->timestamps();
        });

        Schema::table('freelance_data', function ($table) {
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
        Schema::dropIfExists('freelance_datas');
    }
}
