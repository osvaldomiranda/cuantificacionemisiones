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
            $table->integer('process_id')->references('id')->on('process');
            $table->integer('declaration_id')->references('id')->on('declaration');
            $table->integer('raw_material_id');
            $table->integer('raw_material');
            $table->integer('rm_unity');
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

            $table->integer('final_product_id');
            $table->integer('final_product');
            $table->integer('fp_unity');
            $table->float('pf_jan',10,2)->nullable();
            $table->float('pf_feb',10,2)->nullable();
            $table->float('pf_mar',10,2)->nullable();
            $table->float('pf_apr',10,2)->nullable();
            $table->float('pf_may',10,2)->nullable();
            $table->float('pf_jun',10,2)->nullable();
            $table->float('pf_jul',10,2)->nullable();
            $table->float('pf_aug',10,2)->nullable();
            $table->float('pf_sep',10,2)->nullable();
            $table->float('pf_oct',10,2)->nullable();
            $table->float('pf_nov',10,2)->nullable();
            $table->float('pf_dic',10,2)->nullable();


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