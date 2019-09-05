<?php

namespace App\Http\Controllers;

use App\Estimation;
use Illuminate\Http\Request;

class EstimationController extends Controller
{
	public function index(Request $request)
    {
    	$declaration_id = $request->input('declaration_id'); 
        $estimation = Estimation::where('declaration_id', $declaration_id)->get();

        return response()->json($estimation);
    }

    public function save(Request $request){  

        $data = json_decode($request->data);

        $fileName = $request->file->getClientOriginalName();        
        $fileDir = $request->file->storeAs('files',$fileName);  

    	$estimation = new Estimation();
    	$estimation->declaration_id     = $data->declaration_id;
    	$estimation->source	            = $data->source;
    	$estimation->discharge_type     = $data->discharge_type;
    	$estimation->measuring_method   = $data->measuring_method;
    	$estimation->unity  		    = $data->unity;
    	$estimation->factor    		    = $data->factor;
		$estimation->factor_origin      = $data->factor_origin;
		$estimation->estimated_emission = $data->estimated_emission;
    	$estimation->file               = $fileDir;

    	$estimation->save();

    	return response()->json($estimation);
    
    }
}