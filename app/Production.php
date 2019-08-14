<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    public function declaration()
	{
	   	return $this->belongsTo(Declaration::class, 'declaration_id');
	}
    public function process()
	{
	   	return $this->belongsTo(Process::class, 'process_id');
	}
}
