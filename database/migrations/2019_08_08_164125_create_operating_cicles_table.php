<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperatingCiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operating_cicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('source_id')->references('id')->on('source');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->string('day_from');
            $table->string('day_to');
            $table->string('time_from');
            $table->string('time_to');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operating_cicles');
    }
}
