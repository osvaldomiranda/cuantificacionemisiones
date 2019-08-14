<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatingCicle extends Model
{
    public function declaration()
	{
	   	return $this->belongsTo(Declaration::class, 'declaration_id');
	}
    public function source()
	{
	   	return $this->belongsTo(Source::class, 'source_id');
	}
}
