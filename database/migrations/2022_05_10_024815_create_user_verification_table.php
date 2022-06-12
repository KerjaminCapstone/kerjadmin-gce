<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification', function (Blueprint $table) {
            $table->bigIncrements('id_verification');
            $table->string('id_user')->unique();
            $table->string('verification_code')->unique();
            $table->string('job_child_code');
            $table->timestamps();
        });

        Schema::table('user_verification', function ($table) {
            $table->foreign('job_child_code')->references('job_child_code')->on('job_child_code')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification');
    }
}
