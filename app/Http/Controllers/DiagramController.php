<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use App\Diagram;
use Illuminate\Http\Request;
use App\UserEstablishment;

class DiagramController extends Controller
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
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $establishment = json_decode(  $request->input("establishment") );

        if ($request->input("process") == ''){
            $diagram = Diagram::where("establishment", $establishment->id )->get();
        }else{
            $diagram = Diagram::where("establishment", $establishment->id )->where("process", $request->input("process"))->get();
        }
        return $diagram;//response()->json($diagram);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagram $diagram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagram $diagram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagram $diagram)
    {
        //
    }

 


    public function refresh(){
        //  10.100.1.34:8081/api/diagram/byestablishment?id=1
        $user = Auth::user();

        $user_establishment = UserEstablishment::where('user_id', $user->id)->with('user')->with('establishment')->get()->first();

        $establishment_id = $user_establishment->retc_code;



        $client = new Client();
        $res = $client->get("http://10.100.1.34:8081/api/diagram/byestablishment?id=" . $establishment_id );

        $jsonData = json_decode((string) $res->getBody()->getContents(), true) ;

        Info($jsonData);

        foreach($jsonData as $data){
            $this->create_diagram($data);
        }
    }

    public function create_diagram($response){

        DB::transaction(function() use ($response){
            $diagram = Diagram::where('establishment', $response['establishment'])->where('process', $response['process'])->get()->first();
            if($diagram){
                //update diagram
                $diagram->establishment = $response['establishment'];
                $diagram->process       = $response['process'];
                $diagram->send          = $response['send'];    
                $diagram->data          = $response['data'];
                $diagram->state         = $response['state'];

                $diagram->save();
            } else {
                // Agregar diagram
                $new_diagram = new Diagram();

                $new_diagram->establishment = $response['establishment'];
                $new_diagram->process       = $response['process'];
                $new_diagram->send          = $response['send'];    
                $new_diagram->data          = $response['data'];
                $new_diagram->state         = $response['state'];

                $new_diagram->save();    
            }
        });
    }


}
