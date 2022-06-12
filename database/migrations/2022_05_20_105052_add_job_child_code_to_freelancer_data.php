<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobChildCodeToFreelancerData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freelance_data', function (Blueprint $table) {
            $table->string('job_child_code');
        });

        Schema::table('freelance_data', function ($table) {
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
        Schema::table('freelance_data', function (Blueprint $table) {
            //
        });
    }
}
