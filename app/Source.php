<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function establishment()
	{
	   	return $this->belongsTo(Establishment::class, 'establishment_id');
	}

}
