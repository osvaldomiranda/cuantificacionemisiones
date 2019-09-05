<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currentops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->string('register_id')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('control_system')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('currentops');
    }
}
