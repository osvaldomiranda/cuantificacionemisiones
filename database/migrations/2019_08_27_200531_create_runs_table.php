<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->integer('reading_id')->references('id')->on('reading');
            $table->string('date')->nullable();
            $table->string('duration')->nullable();
            $table->float('measured_concentration',10,4)->nullable();
            $table->float('corrected_concentration',10,4)->nullable();
            $table->float('corrected_flow',10,4)->nullable();
            $table->float('emission',10,4)->nullable();
            $table->float('excess_air',10,4)->nullable();
            $table->float('temperature',10,4)->nullable();
            $table->float('speed',10,4)->nullable();
            $table->float('o2',10,4)->nullable();
            $table->float('co2',10,4)->nullable();
            $table->float('co',10,4)->nullable();
            $table->float('co_ppm',10,4)->nullable();
            $table->float('isocinetic',10,4)->nullable();
            $table->float('combustion_efficiency',10,4)->nullable();

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
        Schema::dropIfExists('runs');
    }
}
