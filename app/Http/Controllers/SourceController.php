<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

use App\Source;
use App\Comsuption;
use App\Paralization;
use App\OperatingCicle;

use Illuminate\Http\Request;

class SourceController extends Controller
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
     * @param  \App\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        //
    }


    public function sourcesByProcess(Request $request){
        $process = $request->input('process');

        $sources = Source::where('process', $process)->get();

        return response()->json($sources);
    }

    public function refresh(){
        //  http://10.100.2.48:8081/api/source/get_sources/1
        $establishment_id = '1';
        $client = new Client();
        $res = $client->get("http://10.100.2.48:8081/api/source/get_sources/" . $establishment_id );

        $jsonData = json_decode((string) $res->getBody()->getContents(), true) ;

      
        foreach($jsonData as $data){
            $this->create_source($data);
        }
    }

    public function create_source($response){

        DB::transaction(function() use ($response){
            $source = Source::where('external_id', $response['id'])->get()->first();
            if($source){
                if($source->primary_fuel_id != $response["primary_fuel_id"] ){

                    // eliminar consumo
                    Consumption::where('source_id', $source->id)->delete();

                    // eliminar paralizaciòn
                    Paralization::where('source_id', $source->id)->delete();

                    // eliminar ciclo de funcionamiento
                    OperatingCicle::where('source_id', $source->id)->delete();

                    //update source
                    $source->external_id        =  $response['id'];
                    $source->name               =  $response['name'];
                    $source->source_type_id     =  $response['source_type_id'];
                    $source->source_type_name   =  $response['source_type_name'];
                    $source->establishment_id   =  $response['establishment_id'];       
                    $source->cell_id            =  $response['cell_id'];
                    $source->description        =  $response['description'];
                    $source->register_number    =  $response['register_number'];
                    $source->brand              =  $response['brand'];
                    $source->model              =  $response['model'];
                    $source->serial_number      =  $response['serial_number'];
                    $source->internal_number    =  $response['internal_number'];
                    $source->burner_count       =  $response['burner_count'];
                    $source->height             =  $response['height'];
                    $source->diameter           =  $response['diameter'];
                    $source->latitude           =  $response['latitude'];
                    $source->longitude          =  $response['longitude'];
                    $source->location           =  $response['location'];
                    $source->ccf8               =  $response['ccf8'];
                    $source->process            =  $response['process'];    
                    $source->manufacturing_year =  $response['manufacturing_year'];    
                    $source->installation_year  =  $response['installation_year'];

                    $source->first_statement_date       =  $response['first_statement_date'];
                    $source->incription_date            =  $response['incription_date'];
                    $source->initial_operation_date     =  $response['initial_operation_date'];

                    $source->primary_fuel_id            =  $response['primary_fuel_id'];    
                    $source->primary_fuel_name          =  $response['primary_fuel_name'];

                    $source->secondary_fuel_id          =  $response['secondary_fuel_id'];    
                    $source->secondary_fuel_name        =  $response['secondary_fuel_name'];
                    $source->nominal_consume_secondary  =  $response['nominal_consume_secondary'];
                    $source->nominal_consume_unity_secondary =  $response['nominal_consume_unity_secondary'];

                    $source->nominal_production         =  $response['nominal_production'];
                    $source->nominal_capacity           =  $response['nominal_capacity'];
                    $source->nominal_consume            =  $response['nominal_consume'];
                    $source->nominal_power              =  $response['nominal_power'];
                    $source->installed_power            =  $response['installed_power'];    
                    $source->nominal_production_unity   =  $response['nominal_production_unity'];
                    $source->nominal_capacity_unity =  $response['nominal_capacity_unity']; 
                    $source->nominal_consume_unity  =  $response['nominal_consume_unity'];
                    $source->nominal_power_unity    =  $response['nominal_power_unity'];
                    $source->installed_power_unity  =  $response['installed_power_unity'];
                    $source->state                  =  $response['state'];

                    $source->save();    

                }
            } else {
                // Agregar source
                $new_source = new Source();

                $new_source->external_id        =  $response['id'];
                $new_source->name               =  $response['name'];
                $new_source->source_type_id     =  $response['source_type_id'];
                $new_source->source_type_name   =  $response['source_type_name'];
                $new_source->establishment_id   =  $response['establishment_id'];       
                $new_source->cell_id            =  $response['cell_id'];
                $new_source->description        =  $response['description'];
                $new_source->register_number    =  $response['register_number'];
                $new_source->brand              =  $response['brand'];
                $new_source->model              =  $response['model'];
                $new_source->serial_number      =  $response['serial_number'];
                $new_source->internal_number    =  $response['internal_number'];
                $new_source->burner_count       =  $response['burner_count'];
                $new_source->height             =  $response['height'];
                $new_source->diameter           =  $response['diameter'];
                $new_source->latitude           =  $response['latitude'];
                $new_source->longitude          =  $response['longitude'];
                $new_source->location           =  $response['location'];
                $new_source->ccf8               =  $response['ccf8'];
                $new_source->process            =  $response['process'];    
                $new_source->manufacturing_year =  $response['manufacturing_year'];    
                $new_source->installation_year  =  $response['installation_year'];

                $new_source->first_statement_date       =  $response['first_statement_date'];
                $new_source->incription_date            =  $response['incription_date'];
                $new_source->initial_operation_date     =  $response['initial_operation_date'];

                $new_source->primary_fuel_id            =  $response['primary_fuel_id'];    
                $new_source->primary_fuel_name          =  $response['primary_fuel_name'];

                $new_source->secondary_fuel_id          =  $response['secondary_fuel_id'];    
                $new_source->secondary_fuel_name        =  $response['secondary_fuel_name'];
                $new_source->nominal_consume_secondary  =  $response['nominal_consume_secondary'];
                $new_source->nominal_consume_unity_secondary =  $response['nominal_consume_unity_secondary'];

                $new_source->nominal_production         =  $response['nominal_production'];
                $new_source->nominal_capacity           =  $response['nominal_capacity'];
                $new_source->nominal_consume            =  $response['nominal_consume'];
                $new_source->nominal_power              =  $response['nominal_power'];
                $new_source->installed_power            =  $response['installed_power'];    
                $new_source->nominal_production_unity   =  $response['nominal_production_unity'];
                $new_source->nominal_capacity_unity =  $response['nominal_capacity_unity']; 
                $new_source->nominal_consume_unity  =  $response['nominal_consume_unity'];
                $new_source->nominal_power_unity    =  $response['nominal_power_unity'];
                $new_source->installed_power_unity  =  $response['installed_power_unity'];
                $new_source->state                  =  $response['state'];
                
                $new_source->save();
            }
        });
    }
}
