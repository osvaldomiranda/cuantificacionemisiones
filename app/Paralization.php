<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paralization extends Model
{

	protected $guarded = [];
	
    public function declaration()
	{
	   	return $this->belongsTo(Declaration::class, 'declaration_id');
	}
    public function source()
	{
	   	return $this->belongsTo(Source::class, 'source_id');
	}
}
