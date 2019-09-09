<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reading;
use App\Run;
use DB;

class ReadingController extends Controller
{
    public function index(Request $request)
    {
    	$declaration_id = $request->input('declaration_id');
    	$readings = Reading::where('declaration_id', $declaration_id)->get();
    	return response()->json($readings); 
    }

    public function bySource(Request $request)
    {
        $declaration_id = $request->input('declaration_id');
        $source_id = $request->input('source_id');
        $readings = Reading::where('declaration_id', $declaration_id)->where('source_id', $source_id)->get()->first();
        return response()->json($readings); 
    }

    public function runByReading(Request $request)
    {
        $declaration_id = $request->input('declaration_id');
        $reading_id = $request->input('reading_id');
        $runs = Run::where('declaration_id', $declaration_id)->where('reading_id', $reading_id)->get();
        return response()->json($runs); 
    }


    public function save(Request $request)
    {

        $fileName = $request->file->getClientOriginalName();        
        $fileDir = $request->file->storeAs('files',$fileName);  

        $data = json_decode($request->data);

    	$declaration_id = $data->declaration_id;

    	$reading = Reading::where('declaration_id', $declaration_id)->where('source_id', $data->source_id)->get()->last();

    	if($reading){
    		$reading->declaration_id = $declaration_id;
            $reading->source_id      = $data->source_id;
            $reading->pollutant      = $data->pollutant; 
    		$reading->correlative	 = $data->correlative;	
    		$reading->method 		 = $data->method; 	
    		$reading->lab            = $data->lab;
    		$reading->date_reading   = $data->date_reading; 
    		$reading->file           = $fileDir;
    		$reading->save();
    	}else {
    		$reading = new Reading();
    		$reading->declaration_id = $declaration_id;
            $reading->source_id      = $data->source_id;
            $reading->pollutant      = $data->pollutant; 
    		$reading->correlative	 = $data->correlative;	
    		$reading->method 		 = $data->method; 	
    		$reading->lab            = $data->lab;
    		$reading->date_reading   = $data->date_reading; 
    		$reading->file           = $fileDir;
    		$reading->save();
    	}


        $runs = $data->runs;
        Run::where('declaration_id', $declaration_id)->where('reading_id', $reading->id)->delete();

        foreach($runs as $run){
            Info($run->measured_concentration);

            $new_run = new Run();
                
            $new_run->declaration_id = $declaration_id;
            $new_run->reading_id     = $reading->id; 
            $new_run->source_id               = $run->source_id;
            $new_run->duration                = $run->duration;
            $new_run->measured_concentration  = $run->measured_concentration;
            $new_run->corrected_concentration = $run->corrected_concentration;
            $new_run->corrected_flow          = $run->corrected_flow;
            $new_run->emission                = $run->emission;
            $new_run->excess_air              = $run->excess_air;
            $new_run->combustion_efficiency   = $run->combustion_efficiency;
            $new_run->temperature             = $run->temperature;
            $new_run->speed                   = $run->speed;
            $new_run->isocinetic              = $run->isocinetic;
            $new_run->o2                      = $run->o2;
            $new_run->co2                     = $run->co2;
            $new_run->co                      = $run->co;
            $new_run->co_ppm                  = $run->co_ppm;

            $new_run->save();    
        }
        

    	return response()->json($reading); 
    }

}