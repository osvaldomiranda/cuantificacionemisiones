<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->integer('source_type_id')->nullable();
            $table->string('source_type_name');
            $table->integer('establishment_id')->references('id')->on('establishment');            
            $table->integer('cell_id')->nullable();
            $table->string('description')->nullable();
            $table->string('register_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('internal_number')->nullable();
            $table->string('burner_count')->nullable();
            $table->string('height')->nullable();
            $table->string('diameter')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('location')->nullable();
            $table->string('ccf8')->nullable();
            $table->string('ccf8_secondary')->nullable();
            $table->string('name_ccf8_secondary')->nullable();
            $table->string('name_ccf8')->nullable();
            
            $table->string('process')->nullable();
            $table->string('pipeline_code')->nullable();
            $table->string('kva')->nullable();            
            $table->integer('manufacturing_year')->nullable();
            $table->integer('installation_year')->nullable();

            $table->date('first_statement_date')->nullable();
            $table->date('incription_date')->nullable();
            $table->date('initial_operation_date')->nullable();

            $table->integer('primary_fuel_id')->nullable();
            $table->string('primary_fuel_name')->nullable();

            $table->integer('secondary_fuel_id')->nullable();
            $table->string('secondary_fuel_name')->nullable();
            $table->string('nominal_consume_secondary')->nullable();
            $table->string('nominal_consume_unity_secondary')->nullable();

            $table->string('nominal_production')->nullable();
            $table->string('nominal_capacity')->nullable();
            $table->string('nominal_consume')->nullable();
            $table->string('nominal_power')->nullable();
            $table->string('installed_power')->nullable();
            $table->string('nominal_production_unity')->nullable();
            $table->string('nominal_capacity_unity')->nullable();
            $table->string('nominal_consume_unity')->nullable();
            $table->string('nominal_power_unity')->nullable();
            $table->string('installed_power_unity')->nullable();
            $table->string('state');


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
        Schema::dropIfExists('sources');
    }
}
