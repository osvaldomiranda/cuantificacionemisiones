<?php

namespace App\Http\Controllers;

use App\Paralization;
use Illuminate\Http\Request;

class ParalizationController extends Controller
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
     * @param  \App\Paralization  $paralization
     * @return \Illuminate\Http\Response
     */
    public function show(Paralization $paralization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paralization  $paralization
     * @return \Illuminate\Http\Response
     */
    public function edit(Paralization $paralization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paralization  $paralization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paralization $paralization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paralization  $paralization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paralization $paralization)
    {
        //
    }

    public function bySource(Request $request){
        $source_id      = $request->input('source_id');
        $declaration_id = $request->input('declaration_id');


        $paralizations = Paralization::where('source_id', $source_id)->where('declaration_id', $declaration_id)->get()->toArray();


        return response()->json($paralizations);  
    }


    public function save(Request $request){
        $paralizations = $request->all();

        $first = $paralizations[0];
        Paralization::where('source_id', $first['source_id'])->where('declaration_id', $first['declaration_id'])->delete();

        foreach($paralizations as $data){
            $paralization = new Paralization($data);
            $paralization->save();    
        }
        
        return response()->json($paralizations);  
    }
}
