<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Binnacle;
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

        $declaration = Declaration::where('establishment_id', $establishment_id)->where('state', 'ACTIVA')->first();
        if(!$declaration){
            $declaration = new Declaration();
            $declaration->establishment_id = $establishment_id;
            $declaration->type = $type;
            $declaration->period = '2019';
            $declaration->user_id = 1;
            $declaration->state = 'ACTIVA';
            $declaration->save();

            $binnacle = new Binnacle();
            $binnacle->declaration_id = $declaration_id;
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
    }


    public function changeStates(Request $request){

        Info($request);

        // $declaration_id = $request->input('declaration_id');
        // $new_state = $request->input('new_state');


        // $declaration = Declaration::where('id',$declaration_id)->first();
        // $declaration->state = $new_state;
        // $declaration->save();

        // $binnacle = new Binnacle();
        // $binnacle->declaration_id = $declaration_id;
        // $binnacle->new_state =  $new_state;
        // $binnacle->user_id = 1;
        // $binnacle->save();

        $establishment_id = $request->input('establishment_id');
        $declarations = Declaration::where('establishment_id', $establishment_id)->get();
        return response()->json($declarations); 
    }


}
