<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{

	protected $fillable = [  'declaration_id'
							,'process'
							,'raw_material_id'
							,'raw_material'
							,'rm_unity'
							,'final_product_id'
							,'final_product'
							,'fp_unity'
							,'fp_jan'
							,'fp_feb'
							,'fp_mar'
							,'fp_apr'
							,'fp_may'
							,'fp_jun'
							,'fp_jul'
							,'fp_aug'
							,'fp_sep'
							,'fp_oct'
							,'fp_nov'
							,'fp_dic'
							,'rm_jan'
							,'rm_feb'
							,'rm_mar'
							,'rm_apr'
							,'rm_may'
							,'rm_jun'
							,'rm_jul'
							,'rm_aug'
							,'rm_sep'
							,'rm_oct'
							,'rm_nov'
							,'rm_dic' ];


    public function declaration()
	{
	   	return $this->belongsTo(Declaration::class, 'declaration_id');
	}
    public function process()
	{
	   	return $this->belongsTo(Process::class, 'process_id');
	}
}
