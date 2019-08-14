<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParalizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paralizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('source_id')->references('id')->on('source');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->date('date_from');
            $table->date('date_to');

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
        Schema::dropIfExists('paralizations');
    }
}
