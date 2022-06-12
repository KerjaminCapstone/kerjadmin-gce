<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_violation', function (Blueprint $table) {
            $table->bigIncrements('id_report');
            $table->string('id_order');
            $table->string('created_by');
            $table->string('title');
            $table->text('desc');
            $table->integer('report_status')->default(1); //1 = belum, 2 = acc, 3 = reject
            $table->timestamps();
        });

        Schema::table('report_violation', function ($table) {
            $table->foreign('id_order')->references('id_order')->on('order')->onDelete('cascade');
            $table->foreign('created_by')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_violation');
    }
}
