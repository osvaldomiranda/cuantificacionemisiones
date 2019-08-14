<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    public function establishment()
	{
	   	return $this->belongsTo(Establishment::class, 'establishment_id');
	}
}
