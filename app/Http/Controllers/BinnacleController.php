<?php

namespace App\Http\Controllers;

use App\Binnacle;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
	public function index(Request $request)
    {
    	$declaration_id = $request->input('declaration_id'); 
        $binacles = Binnacle::where('declaration_id', $declaration_id)->get();

        return response()->json($binacles);
    }

}