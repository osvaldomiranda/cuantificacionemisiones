<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Binnacle;
use App\Consumption;
use App\OperatingCicle;
use App\Paralization;
use App\Emission;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $establishment_id = $request->input('establishment_id');
        $declarations = Declaration::where('establishment_id', $establishment_id)->get();
        return response()->json($declarations); 
    }

    public function indexWith(Request $request)
    {
        $establishment_id = $request->input('establishment_id');
        $declarations = Declaration::where('establishment_id', $establishment_id)->get();

        $declarationsArray = array();
        $incI = 0;
        foreach($declarations as $declaration){


            Info($declaration);

            $declarationsArray[$incI]['declaration'] = $declaration;
            $declarationsArray[$incI]['establishment'] = $declaration->establishment;
            $declarationsArray[$incI]['commune'] = $declaration->establishment->commune;
            $declarationsArray[$incI]['company'] = $declaration->establishment->company;
            
            $incI++;
        }
        
        Info($declarationsArray);

        return response()->json($declarationsArray); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function show(Declaration $declaration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function edit(Declaration $declaration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Declaration $declaration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Declaration $declaration)
    {
        //
    }


    public function new(Request $request){

        $establishment_id = $request->input('establishment_id');
        $type = $request->input('type');

        $declaration = Declaration::where('establishment_id', $establishment_id)->where('type', $type)->where('state', 'ACTIVA')->first();
        if(!$declaration){
            $declaration = new Declaration();
            $declaration->establishment_id = $establishment_id;
            $declaration->type = $type;
            $declaration->period = '2019';
            $declaration->user_id = 1;
            $declaration->state = 'ACTIVA';
            $declaration->save();

            $binnacle = new Binnacle();
            $binnacle->declaration_id = $declaration->id;
            $binnacle->new_state =  'ACTIVA';
            $binnacle->user_id = 1;
            $binnacle->save();
        }

        return response()->json($declaration); 
    }

    public function changeState(Request $request){

        $declaration_id = $request->input('declaration_id');
        $new_state = $request->input('new_state');


        $declaration = Declaration::where('id',$declaration_id)->first();
        $declaration->state = $new_state;
        $declaration->save();

        $binnacle = new Binnacle();
        $binnacle->declaration_id = $declaration_id;
        $binnacle->new_state =  $new_state;
        $binnacle->user_id = 1;
        $binnacle->save();

        if($new_state=='ENVIADA'){
         //   $this->send_to_reports($declaration_id);    
        }
    }


    public function send_to_reports($declaration_id){

        $declaration_array = Array();
        $declaration = Declaration::where('id', $declaration_id)->first(); 
        $consumptions = Consumption::where('declaration_id', $declaration->id)->get();
        $operatingCicles = OperatingCicle::where('declaration_id', $declaration->id)->get();
        $paralization = Paralization::where('declaration_id', $declaration->id)->get();
        //$emission = Emission::where('declaration_id', $declaration->id)->get();

        array_push($declaration_array, $declaration);
        
        $declaration_array[0]['consumption'] = $consumptions;
        $declaration_array[0]['operatingcicles'] = $operatingCicles;
        $declaration_array[0]['paralization'] = $paralization;
        // $declaration_array[0]['emission'] = $emission;



        $client = new Client();
        $res = $client->post("http://127.0.0.1:8081/api/refresh_declaration", ['form_params' => ['declaration' => json_encode($declaration_array)]]);

        $jsonData = json_decode((string) $res->getBody()->getContents(), true) ;



        return response()->json($jsonData);
    }






}
