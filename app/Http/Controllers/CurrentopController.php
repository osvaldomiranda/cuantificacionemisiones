<?php

namespace App\Http\Controllers;

use App\Currentop;
use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;



class CurrentopController extends Controller
{
	public function index(Request $request)
    {

    	$declaration_id = $request->input('declaration_id'); 
        $currentop = Currentop::where('declaration_id', $declaration_id)->get();

        Info($currentop);

        return response()->json($currentop);
    }

    public function save(Request $request){
    	//save local file

        Info($request);

        $data = json_decode($request->data);

    	$fileName = $request->file->getClientOriginalName();        
        $fileDir = $request->file->storeAs('files',$fileName);  

    	$currentop = new Currentop();
    	$currentop->declaration_id = $data->declaration_id;
    	$currentop->register_id	   = $data->register_id;
    	$currentop->operation_type = $data->operation_type;
    	$currentop->control_system = $data->control_system;
    	$currentop->description    = $data->description;
    	$currentop->file           = $fileDir;

    	$currentop->save();

    	return response()->json($currentop);
    }

    public function downloadExcel(Request $request){

        $excelname = $request->input('excelname'); 

        return Excel::download(new ExcelExport, $excelname);
    }


    public function downloadStorage(Request $request){

        Info($request);

        $filename = $request->input('filename'); 

        return Storage::download($filename);
    }


}