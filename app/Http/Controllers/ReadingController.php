<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reading;
use DB;

class Reading extends Controller
{
    public function index(Request $request)
    {
    	$declaration_id = $request->input('declaration_id');
    	$readings = Reading::where('declaration_id', $declaration_id)->get();
    	return response()->json($readings); 
    }

    public function save(Request $request)
    {
    	$declaration_id = $request->input('declaration_id');
    	
    	$reading = Reading::where('declaration_id', $declaration_id)->last();

    	if($readings){
    		$reading->declaration_id = $declaration_id;
    		$reading->correlative	  = $request->input('correlative');	
    		$reading->method 		  = $request->input('method'); 	
    		$reading->lab            = $request->input('lab');
    		$reading->date_reading   = $request->input('date_reading'); 
    		$reading->file           = $request->input('file');
    		$reading->save();
    	}else {
    		$reading = new Reading();
    		$reading->declaration_id = $declaration_id;
    		$reading->correlative	 = $request->input('correlative');	
    		$reading->method 		 = $request->input('method'); 	
    		$reading->lab            = $request->input('lab');
    		$reading->date_reading   = $request->input('date_reading'); 
    		$reading->file           = $request->input('file');
    		$reading->save();
    	}

    	return response()->json($reading); 
    }

}