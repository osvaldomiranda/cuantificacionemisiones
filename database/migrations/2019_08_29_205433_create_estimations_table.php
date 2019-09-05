<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->string('source')->nullable();
            $table->string('discharge_type')->nullable();
            $table->string('measuring_method')->nullable();
            $table->string('factor')->nullable();
            $table->string('factor_origin')->nullable();
            $table->string('estimated_emission')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('estimations');
    }
}
