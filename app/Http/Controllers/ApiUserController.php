<?php
namespace App\Http\Controllers;


use App\User;
use App\Establishment;
use App\Company;
use App\UserEstablishment;
use App\Requisition;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class ApiUserController extends Controller
{


        public function setSecretInvitation(Request $request)
    {

        $retcid = $request->input('retcid');
        $secret_a = $request->input('secret_a');
        $secret_b = $request->input('secret_b');
        $user = UserEstablishment::where('retc_id', '=', $retcid)->first();      
        if ($user){
            $user->secret_a = $secret_a;
            $user->secret_b = $secret_b;
            if ($user->save()){
                return response()->json(['response' => 1]);
            }
        }                
        return response()->json(['response' => 0]);
    }

    public function solicitudIndustrial(request $request){

        info($request);
        //dd($request);
        //usar campo rretc
        //representante legal empresa
        //To Do: validar datos (rut,valores numéricos)
        DB::transaction(function() use ($request){            
            $representante_legal = User::where('retcid',$request->empresa['rretc'])->first();
            info($representante_legal);
            //dd($userExists);
            if($representante_legal){
                $representante_legal->name=$request->empresa['rnombre'].' '.$request->empresa['rpaterno'].' '.$request->empresa['rmaterno'];
                $representante_legal->email=$request->empresa['remail'];
                $representante_legal->save();
            }else{
                $representante_legal=User::create(array(
                    'name'=>$request->empresa['rnombre'].' '.$request->empresa['rpaterno'].' '.$request->empresa['rmaterno'],
                    'email'=>$request->empresa['remail'],
                    'retcid'=>$request->empresa['rretc'],
                    'password'=>Hash::make('Enrique Pino Liso'),
                ));            
            }

            $encargado_establecimiento = User::where('retcid',$request->establecimiento['rretc'])->first();
            if($encargado_establecimiento){
                $encargado_establecimiento->name = $request->establecimiento['rnombre'].' '.$request->establecimiento['rpaterno'].' '.$request->establecimiento['rmaterno'];
                $encargado_establecimiento->email=$request->establecimiento['remail'];
                $encargado_establecimiento->save();
            }else{
                $encargado_establecimiento=User::create(array(
                    'name'=>$request->establecimiento['rnombre'].' '.$request->establecimiento['rpaterno'].' '.$request->establecimiento['rmaterno'],
                    'email'=>$request->establecimiento['remail'],
                    'retcid'=>$request->establecimiento['rretc'],
                    'password'=>Hash::make('Enrique Pino Liso'),
                ));
            }

            $companyExists = Company::where('retc_code',$request->empresa['retc'])->first();
            if(!$companyExists){
                $companyExists=new Company();
                $companyExists->retc_code = $request->empresa['retc'];       
            }
            $companyExists->user_id = $representante_legal->id;
            $companyExists->rut=$request->empresa['rut'];
            $companyExists->name=$request->empresa['razon'];
            $companyExists->fantasy_name=$request->empresa['fantasia'];
            $companyExists->digit=$request->empresa['digito'];
            $companyExists->street=$request->empresa['calle'];
            // $companyExists->number=$request->empresa['numero'];
            $companyExists->commune_id=$request->empresa['comuna'];
            $companyExists->save();

            $establishmentExists= Establishment::where('retc_code',$request->establecimiento['retc'])->first();
            if(!$establishmentExists){
                $establishmentExists=new Establishment();
                $establishmentExists->retc_code =$request->establecimiento['retc'];
            }
            $establishmentExists->name = $request->establecimiento['nombre'];
            $establishmentExists->commune_id = $request->establecimiento['comuna'];
            $establishmentExists->street = $request->establecimiento['calle'];
            // $establishmentExists->number = $request->establecimiento['numero'];
            $establishmentExists->company_id = $companyExists->id;
            $establishmentExists->user_id = $encargado_establecimiento->id;
            $establishmentExists->save();

            info("request usuarios");
            foreach($request->usuarios as $usuarios){
                info($usuarios);
                $usuario = User::where('retcid',$usuarios['per_retc'])->first();
                if(!$usuario){
                    $usuario= new User();
                    $usuario->retcid=$usuarios['per_retc'];
                }
                $usuario->name=$usuarios['nombre'].' '.$usuarios['paterno'].' '.$usuarios['materno'];
                $usuario->email=$usuarios['email'];
                $usuario->password=Hash::make('Registro de Fuentes y Procesos');
                $usuario->save();
                $userEstablishment = UserEstablishment::where('user_id',$usuario->id)->where('establishment_id',$establishmentExists->id)->first();
                if(!$userEstablishment){
                    $userEstablishment=new UserEstablishment();                    
                    $userEstablishment->user_id=$usuario->id;
                    $userEstablishment->establishment_id =$establishmentExists->id;
                }
                $userEstablishment->retc_id=$usuarios['retc'];
                $userEstablishment->save();
            }
        });

        return response()->json(['success' => true, 'message' => $request->body, 'errors' => [] ]);
    }


    
 

// *******************************************************************
    // public function setSecretInvitation(Request $request)
    // {

    //     $retcid = $request->input('retcid');
    //     $secret_a = $request->input('secret_a');
    //     $secret_b = $request->input('secret_b');
    //     $user = UserEstablishment::where('retc_id', '=', $retcid)->first();      
    //     if ($user){
    //         $user->secret_a = $secret_a;
    //         $user->secret_b = $secret_b;
    //         if ($user->save()){
    //             return response()->json(['response' => 1]);
    //         }
    //     }  else {
            
    //     }              
    //     return response()->json(['response' => 0]);
    // }

    // public function solicitudIndustrial(request $request){

    // 	// Info($request);
    // 	// Info($request->body);
    // 	// Info($request->objeto['retc']);

    // 	DB::transaction(function() use ($request){
    //         $requisition = Requisition::where('retc_id',$request->objeto['retc'])->first();
    //         info($requisition);
    //         //dd($userExists);
    //         if(!$requisition){
    //             $requisition=Requisition::create(array(
    //                 'retc_id'=> $request->objeto['retc'],
    //                 'data'=> json_encode($request->objeto),
    //                 'state'=>'PENDIENTE',
    //             ));
                
    //             $requisition->save(); 	
    //         };   
    //     });   

    //     return response()->json(['ok' => true, 'message' => "Solicitud recibida" ]);	
     
    // }


    public function validateSecret(Request $request){
        Info('ValidateSecret');
        Info($request);

        $secret_a =$request->secret_a;
        $secret_b =$request->secret_b;
        $result = UserEstablishment::where('secret_a',$secret_a)->where('secret_b',$secret_b)->first();

        
        Info('validateSecret');

        if($result){
            $token = $result->user->createToken('VU')->accessToken;

            $result->secret_a = null;
            $result->secret_b = null;
            $result->save();

            Info('token');
            Info($token);    
            Session::flash('token', $token);
            return redirect('/');
        }else{
            return abort(404,'Error: UserAccess');
        }
    }
    
    public function setUserVue(Request $request){

       $user = Auth::user();
       $user_establishment = UserEstablishment::where('user_id', $user->id)->with('user')->with('establishment')->get();

        return response()->json($user_establishment);

    }


    public function vu_simulate(Request $request){
        $ue = UserEstablishment::where('retc_id', '=', 119003)->first();  

        if($ue){
            $token = $ue->user->createToken('VU')->accessToken;
            Info('token_vu_simulate');
            Info($token); 

            Session::flash('token', $token);

            return redirect('/');
        } else {
            return abort(404,'Error: UserAccess');
        }
    }

    public function logout(Request $request){
        Info('**************');
        Info('**************');
        Info('**************');
        Info('**************');
        Info(' LOGOUT');

    }

}