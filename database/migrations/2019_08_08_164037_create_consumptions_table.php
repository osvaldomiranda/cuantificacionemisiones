<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('source_id')->references('id')->on('source');
            $table->integer('declaration_id')->references('id')->on('declaratio');
            $table->integer('fuel_id');
            $table->string('fuel');
            $table->string('unity');
            $table->float('jan',10,2)->nullable();
            $table->float('feb',10,2)->nullable();
            $table->float('mar',10,2)->nullable();
            $table->float('apr',10,2)->nullable();
            $table->float('may',10,2)->nullable();
            $table->float('jun',10,2)->nullable();
            $table->float('jul',10,2)->nullable();
            $table->float('aug',10,2)->nullable();
            $table->float('sep',10,2)->nullable();
            $table->float('oct',10,2)->nullable();
            $table->float('nov',10,2)->nullable();
            $table->float('dic',10,2)->nullable();

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
        Schema::dropIfExists('consumptions');
    }
}
