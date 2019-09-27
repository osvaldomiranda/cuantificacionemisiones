<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('process');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->integer('raw_material_id')->nullable();
            $table->string('raw_material')->nullable();
            $table->string('rm_unity')->nullable();
            $table->float('rm_jan',10,2)->nullable();
            $table->float('rm_feb',10,2)->nullable();
            $table->float('rm_mar',10,2)->nullable();
            $table->float('rm_apr',10,2)->nullable();
            $table->float('rm_may',10,2)->nullable();
            $table->float('rm_jun',10,2)->nullable();
            $table->float('rm_jul',10,2)->nullable();
            $table->float('rm_aug',10,2)->nullable();
            $table->float('rm_sep',10,2)->nullable();
            $table->float('rm_oct',10,2)->nullable();
            $table->float('rm_nov',10,2)->nullable();
            $table->float('rm_dic',10,2)->nullable();

            $table->integer('final_product_id')->nullable();
            $table->string('final_product')->nullable();
            $table->string('fp_unity')->nullable();
            $table->float('fp_jan',10,2)->nullable();
            $table->float('fp_feb',10,2)->nullable();
            $table->float('fp_mar',10,2)->nullable();
            $table->float('fp_apr',10,2)->nullable();
            $table->float('fp_may',10,2)->nullable();
            $table->float('fp_jun',10,2)->nullable();
            $table->float('fp_jul',10,2)->nullable();
            $table->float('fp_aug',10,2)->nullable();
            $table->float('fp_sep',10,2)->nullable();
            $table->float('fp_oct',10,2)->nullable();
            $table->float('fp_nov',10,2)->nullable();
            $table->float('fp_dic',10,2)->nullable();


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
        Schema::dropIfExists('productions');
    }
}