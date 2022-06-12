<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobChildCtgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_child_code', function (Blueprint $table) {
            $table->string('job_child_code')->unique();
            $table->string('job_child_name');
            $table->string('job_code');
            $table->timestamps();
        });

        Schema::table('job_child_code', function ($table) {
            $table->foreign('job_code')->references('job_code')->on('job_code')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_child_code');
    }
}
