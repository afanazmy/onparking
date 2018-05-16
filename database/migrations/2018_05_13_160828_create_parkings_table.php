<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('license_plate')->unique();
            $table->integer('operator_id')->unsigned();
            $table->integer('garage_id')->unsigned();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('license_plate')->references('license_plate')->on('vehicles');
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->foreign('garage_id')->references('id')->on('garages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings');
    }
}
