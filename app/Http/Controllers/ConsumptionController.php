<?php

namespace App\Http\Controllers;

use App\Consumption;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
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
     * @param  \App\Consumption  $consumption
     * @return \Illuminate\Http\Response
     */
    public function show(Consumption $consumption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consumption  $consumption
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumption $consumption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consumption  $consumption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumption $consumption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consumption  $consumption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumption $consumption)
    {
        //
    }


    public function bySource(Request $request){
        $source_id      = $request->input('source_id');
        $declaration_id = $request->input('declaration_id');

        $consumption = Consumption::where('source_id', $source_id)->where('declaration_id', $declaration_id)->get()->first();

        return response()->json($consumption);  
    }

    public function save(Request $request){

        $source_id      = $request->input('source_id');
        $declaration_id = $request->input('declaration_id');

        $consumption = Consumption::where('source_id', $source_id)->where('declaration_id', $declaration_id)->get()->first();

        if($consumption){


            $consumption->fuel_id           =  $request->input('fuel_id');
            $consumption->fuel              =  $request->input('fuel');
            $consumption->unity             =  $request->input('unity');
            $consumption->secondary_fuel_id =  $request->input('secondary_fuel_id');
            $consumption->secondary_fuel    =  $request->input('secondary_fuel');
            $consumption->secondary_unity   =  $request->input('secondary_unity');


            $consumption->jan =  $request->input('jan');
            $consumption->feb =  $request->input('feb');
            $consumption->mar =  $request->input('mar');
            $consumption->apr =  $request->input('apr');
            $consumption->may =  $request->input('may');
            $consumption->jun =  $request->input('jun');
            $consumption->jul =  $request->input('jul');
            $consumption->aug =  $request->input('aug');
            $consumption->sep =  $request->input('sep');
            $consumption->oct =  $request->input('oct');
            $consumption->nov =  $request->input('nov');
            $consumption->dic =  $request->input('dic');

            $consumption->sec_jan =  $request->input('sec_jan');
            $consumption->sec_feb =  $request->input('sec_feb');
            $consumption->sec_mar =  $request->input('sec_mar');
            $consumption->sec_apr =  $request->input('sec_apr');
            $consumption->sec_may =  $request->input('sec_may');
            $consumption->sec_jun =  $request->input('sec_jun');
            $consumption->sec_jul =  $request->input('sec_jul');
            $consumption->sec_aug =  $request->input('sec_aug');
            $consumption->sec_sep =  $request->input('sec_sep');
            $consumption->sec_oct =  $request->input('sec_oct');
            $consumption->sec_nov =  $request->input('sec_nov');
            $consumption->sec_dic =  $request->input('sec_dic');

            $consumption->save();
        } else {
            $consumption = new Consumption($request->all());
            $consumption->save();
        }

        return response()->json($consumption);  
    }

}
