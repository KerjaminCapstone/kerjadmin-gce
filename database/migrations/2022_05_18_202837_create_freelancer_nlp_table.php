<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerNlpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer_nlp', function (Blueprint $table) {
            $table->bigIncrements('id_freelance_nlp');
            $table->unsignedBigInteger('id_freelance');
            $table->string('nlp_tag1');
            $table->string('nlp_tag2')->nullable();
            $table->string('nlp_tag3')->nullable();
            $table->string('nlp_tag4')->nullable();
            $table->string('nlp_tag5')->nullable();
            $table->timestamps();
        });

        Schema::table('freelancer_nlp', function ($table) {
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
        Schema::dropIfExists('freelancer_nlp');
    }
}
