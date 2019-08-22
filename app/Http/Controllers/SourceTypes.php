<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SourceType;
use DB;

class SourceTypes extends Controller
{
    public function index()
    {
        $SourceTypes = SourceType::all()->where('process', 'GENERAL_USE')->toArray();
        return response()->json($SourceTypes);
    }

    public function getSourceByType($process){
    	
        //->orderBy('type', 'DESC')
        //$processEnergy = SourceType::where('process', $process)->with('fuels')->orderBy('type', 'desc')->get()->toArray();//::all()->where('process', $process)->orderByRaw('type DESC')->toArray();
		$processEnergy = SourceType::where('process', $process)->orderBy('type', 'desc')->get()->toArray();//::all()->where('process', $process)->orderByRaw('type DESC')->toArray();
		//info(response()->json($processEnergy));
		return response()->json($processEnergy);
	}

    public function getSuccesors($id){
        $sucessors=SourceType::with('sucessors')->find($id);
        //info(SourceType::join('sucessors', 'sucessors.source_type_id_destiny', '=', 'SourceType.id')->get());
        $sucessors = DB::table('source_types')->join('sucessors', 'sucessors.source_type_id_destiny', '=', 'source_types.id')->where('source_type_id','=',$id)->get();
        info($sucessors);
        return $sucessors;
    }

  // obtener campos y combustibles  
//App\SourceType::where('id', 131)->with('fields')->with('fuels')->orderBy('type', 'desc')->get()->toArray()
    public function getFieldsAndBurners($id){
        $result = SourceType::where('id', $id)->with('fields')->with('fuels')->orderBy('type', 'desc')->get()->toArray();
        //info("aqui");
        $fieldsFuels = [];
        $fields=[];
        foreach ($result as $key) {
            //info($key);
            $fieldsFuels['fuels'] = $key["fuels"];
            for($i=0;$i<sizeof($key["fields"]);$i++){
                //info($key["fields"][$i]["field_name"]);
                array_push($fields,$key["fields"][$i]["field_name"]);
            }            
        }
        
        $fieldsFuels["fields"] = $fields;
        //info($fieldsFuels);
        //info($result[0]["fields"]);

        return $fieldsFuels;
    } 

    public function getFuelBySource($id){
        info($id);
        //->orderBy('type', 'DESC')
        $fuels = SourceType::where('id', $id)->with('fuels')->orderBy('type', 'desc')->get()->toArray();//::all()->where('process', $process)->orderByRaw('type DESC')->toArray();
        //info(response()->json($fuels));
        return response()->json($fuels);        
    }


    public function getIdSource($source){
        $id = SourceType::where('name', $source)->value('id');
        info("informacion");
        info($id);
        return $id;
    }

    public function getSourceById($id){
        $SourceType = SourceType::where('id', $id)->get()->toArray();
        return response()->json($SourceType);
    }
}