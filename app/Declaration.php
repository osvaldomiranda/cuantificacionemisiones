<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Consumption;

class Declaration extends Model
{
    public function establishment()
	{
	   	return $this->belongsTo(Establishment::class, 'establishment_id');
	}

}
