<?php

namespace App\Http\Controllers;

use App\OperatingCicle;
use Illuminate\Http\Request;

class OperatingCicleController extends Controller
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
     * @param  \App\OperatingCicle  $operatingCicle
     * @return \Illuminate\Http\Response
     */
    public function show(OperatingCicle $operatingCicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OperatingCicle  $operatingCicle
     * @return \Illuminate\Http\Response
     */
    public function edit(OperatingCicle $operatingCicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OperatingCicle  $operatingCicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperatingCicle $operatingCicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OperatingCicle  $operatingCicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperatingCicle $operatingCicle)
    {
        //
    }
    public function bySource(Request $request){
        $source_id      = $request->input('source_id');
        $declaration_id = $request->input('declaration_id');

        $operatingcicle = OperatingCicle::where('source_id', $source_id)->where('declaration_id', $declaration_id)->get()->first();

        return response()->json($operatingcicle);  
    }

    public function save(Request $request){


        $source_id      = $request->input('source_id');
        $declaration_id = $request->input('declaration_id');

        $operatingcicle = OperatingCicle::where('source_id', $source_id)->where('declaration_id', $declaration_id)->get()->first();

        if($operatingcicle){
            $operatingcicle->day_from  = $request->input('day_from');
            $operatingcicle->day_to    = $request->input('day_to');
            $operatingcicle->time_from = $request->input('time_from');
            $operatingcicle->time_to   = $request->input('time_to');
            $operatingcicle->save();

        } else {
            $operatingcicle = new OperatingCicle($request->all());
            $operatingcicle->save();            
        }

        return response()->json($operatingcicle);  
    }
}
