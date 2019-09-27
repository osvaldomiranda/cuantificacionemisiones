<?php

namespace App\Http\Controllers;

use App\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        //
    }

    public function byDeclarationProcess(Request $request){
        $process      = $request->input('process');
        $declaration_id = $request->input('declaration_id');

        $production = Production::where('process', $process)->where('declaration_id', $declaration_id)->get()->first();

        return response()->json($production);  
    }

    public function save(Request $request){

        Info("Production Save");
        Info($request);

        $process      = $request->input('process');
        $declaration_id = $request->input('declaration_id');

        $production = Production::where('process', $process)->where('declaration_id', $declaration_id)->get()->first();

        if($production){

            $production->final_product_id = $request->input('final_product_id');
            $production->final_product    = $request->input('final_product');
            $production->fp_unity         = $request->input('fp_unity');

            $production->raw_material_id = $request->input('raw_material_id');
            $production->raw_material    = $request->input('raw_material');
            $production->rm_unity        = $request->input('rm_unity');

            $production->rm_jan =  $request->input('rm_jan');
            $production->rm_feb =  $request->input('rm_feb');
            $production->rm_mar =  $request->input('rm_mar');
            $production->rm_apr =  $request->input('rm_apr');
            $production->rm_may =  $request->input('rm_may');
            $production->rm_jun =  $request->input('rm_jun');
            $production->rm_jul =  $request->input('rm_jul');
            $production->rm_aug =  $request->input('rm_aug');
            $production->rm_sep =  $request->input('rm_sep');
            $production->rm_oct =  $request->input('rm_oct');
            $production->rm_nov =  $request->input('rm_nov');
            $production->rm_dic =  $request->input('rm_dic');

            $production->fp_jan =  $request->input('fp_jan');
            $production->fp_feb =  $request->input('fp_feb');
            $production->fp_mar =  $request->input('fp_mar');
            $production->fp_apr =  $request->input('fp_apr');
            $production->fp_may =  $request->input('fp_may');
            $production->fp_jun =  $request->input('fp_jun');
            $production->fp_jul =  $request->input('fp_jul');
            $production->fp_aug =  $request->input('fp_aug');
            $production->fp_sep =  $request->input('fp_sep');
            $production->fp_oct =  $request->input('fp_oct');
            $production->fp_nov =  $request->input('fp_nov');
            $production->fp_dic =  $request->input('fp_dic');

            $production->save();
        } else {
            $production = new Production($request->all());
            $production->save();
        }

        return response()->json($production);  
    }



}
