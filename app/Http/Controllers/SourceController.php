<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use App\Source;
use App\Factor;
use App\Consumption;
use App\Process;
use App\Paralization;
use App\OperatingCicle;
use App\UserEstablishment;


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

    public function factorsByProcess(Request $request){


      //  Info($request);

        $process = $request->input('process');
        $declaration = $request->input('declaration');
        $establishment_id = $request->input('establishment_id'); 
        
        $sources = Source::where('process', $process)->where("establishment_id", $establishment_id)->get();

        $sourceArray = array();
        $incI = 0;
        foreach($sources as $source){

            $consumption = Consumption::where('declaration_id', $declaration)->where('source_id', $source->id)->get()->first();
           
            if($consumption){
                $sumPrimary =  $consumption->jan + $consumption->feb + $consumption->mar+ 
                               $consumption->apr + $consumption->may + $consumption->jun+
                               $consumption->jul + $consumption->aug + $consumption->sep+
                               $consumption->oct + $consumption->nov + $consumption->dic;
                
                $sumSecondary = $consumption->sec_jan + $consumption->sec_feb + $consumption->sec_mar+ 
                                $consumption->sec_apr + $consumption->sec_may + $consumption->sec_jun+
                                $consumption->sec_jul + $consumption->sec_aug + $consumption->sec_sep+
                                $consumption->sec_oct + $consumption->sec_nov + $consumption->sec_dic;
            } else {
                 $sumPrimary = 12;
                 $sumSecondary = 12;
            }


            $factorsPrimaryCO2  = rand(1,100)/100;
            $factorsPrimaryCO   = rand(1,100)/100;
            $factorsPrimaryME   = rand(1,100)/100;
            $factorsPrimaryNOX  = rand(1,100)/100;
            $factorsPrimaryNO   = rand(1,100)/100;
            $factorsPrimaryPM   = rand(1,100)/100;
            $factorsPrimaryPM10 = rand(1,100)/100;
            $factorsPrimaryPM25 = rand(1,100)/100;
            $factorsPrimarySOX  = rand(1,100)/100;

            
            // $factorsPrimaryCO2  = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryCO   = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryME   = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryNOX  = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryNO   = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryPM   = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryPM10 = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimaryPM25 = Factor::where('ccf8',$source->ccf8)->get()->first();
            // $factorsPrimarySOX  = Factor::where('ccf8',$source->ccf8)->get()->first();
            
            $sourceArray[$incI]['source_type'] = $source->source_type;
            $sourceArray[$incI]['source_type_name'] = $source->source_type_name;
            $sourceArray[$incI]['fuel'] = $source->primary_fuel_name;
            $sourceArray[$incI]['consumption'] = $sumPrimary;
            $sourceArray[$incI]['unity'] = $source->nominal_consume_unity;

            $sourceArray[$incI]['CO2']  = number_format((float)$factorsPrimaryCO2 * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['CO']   = number_format((float)$factorsPrimaryCO * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['ME']   = number_format((float)$factorsPrimaryME * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['NOX']  = number_format((float)$factorsPrimaryNOX * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['NO']   = number_format((float)$factorsPrimaryNO * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['PM']   = number_format((float)$factorsPrimaryPM * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['PM10'] = number_format((float)$factorsPrimaryPM10 * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['PM25'] = number_format((float)$factorsPrimaryPM25 * $sumPrimary, 2, '.', '');
            $sourceArray[$incI]['SOX']  = number_format((float)$factorsPrimarySOX * $sumPrimary, 2, '.', '');

            $incI++;

           
            if($source->ccf8_secondary){
                
                $sourceArray[$incI]['source_type'] = $source->source_type;
                $sourceArray[$incI]['source_type_name'] = $source->source_type_name . ' Secondaryfuel';
                $sourceArray[$incI]['fuel'] = $source->primary_fuel_name;
                $sourceArray[$incI]['consumption'] = $sumSecondary;
                $sourceArray[$incI]['unity'] = $source->nominal_consume_unity;

                $sourceArray[$incI]['CO2']  = number_format((float)$factorsPrimaryCO2 * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['CO']   = number_format((float)$factorsPrimaryCO * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['ME']   = number_format((float)$factorsPrimaryME * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['NOX']  = number_format((float)$factorsPrimaryNOX * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['NO']   = number_format((float)$factorsPrimaryNO * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['PM']   = number_format((float)$factorsPrimaryPM * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['PM10'] = number_format((float)$factorsPrimaryPM10 * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['PM25'] = number_format((float)$factorsPrimaryPM25 * $sumSecondary, 2, '.', '');
                $sourceArray[$incI]['SOX']  = number_format((float)$factorsPrimarySOX * $sumSecondary, 2, '.', '');
                $incI++;
            }



        }

        Info($sourceArray);
        return response()->json($sourceArray);

    }


    public function sourcesByProcess(Request $request){
        $process = $request->input('process');

        if($process=='OTHERS'){
           $sources =  Source::select()->whereNotIn('process',['ENERGY','GENERAL_USE','PDA'])->where('pda', false)->get();
        }else if ($process=='PDA'){
           $sources = Source::where('pda', true)->get(); 
        }else {
           $sources = Source::where('process', $process)->where('pda', false)->get(); 
        }

        return response()->json($sources);
    }

    public function sourcesByStep(Request $request){
        $step = $request->input('step');

        $sources = Source::where('process', $process)->get();

        return response()->json($sources);
    }


    public function process(){
        $process = Source::select('process')->whereNotIn('process',['ENERGY','GENERAL_USE','PDA'])->first();

        if($process){ 
            $process_name = Process::where('name', $process->process)->first();
        } else {
            $process_name = '';
        }

        return response()->json($process_name);
    }

    public function refresh(){
        //  http://10.100.2.48:8081/api/source/get_sources/1
        $user = Auth::user();

        $user_establishment = UserEstablishment::where('user_id', $user->id)->with('user')->with('establishment')->get()->first();

        $establishment_id = $user_establishment->retc_code;

        $client = new Client();
        $res = $client->get("http://10.100.1.34:8081/api/source/get_sources/" . $establishment_id );

        $jsonData = json_decode((string) $res->getBody()->getContents(), true) ;
      

        if($jsonData){
            foreach($jsonData as $data){
                $this->create_source($data);
            }
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

                    $source->ccf8_secondary      =  $response['ccf8_secondary'];
                    $source->name_ccf8_secondary =  $response['name_ccf8_secondary'];
                    $source->name_ccf8           =  $response['name_ccf8'];
                    $source->pipeline_code  =  $response['pipeline_code'];
                    $source->kva            =  $response['kva'];


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

                    $source->pda               =  $response['pda'];

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

                $new_source->ccf8_secondary      =  $response['ccf8_secondary'];
                $new_source->name_ccf8_secondary =  $response['name_ccf8_secondary'];
                $new_source->name_ccf8           =  $response['name_ccf8'];
                $new_source->pipeline_code  =  $response['pipeline_code'];
                $new_source->kva            =  $response['kva'];

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

                $new_source->pda               =  $response['pda'];
                
                $new_source->save();
            }
        });
    }
}
