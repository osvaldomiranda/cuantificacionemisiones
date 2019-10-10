<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(Request $request)
    {

    	Info("***** userController 14 ******");
    	Info($request);

    	 $usuario = User::where('retcid',$usuarios['per_retc'])->first();
	    if(!$usuario){
	        $usuario= new User();
	        $usuario->retcid=$usuarios['per_retc'];
	    }
	    $usuario->name=$usuarios['nombre'].' '.$usuarios['paterno'].' '.$usuarios['materno'];
	    $usuario->email=$usuarios['email'];
        $usuario->type=$usuarios['tipo'];
	    $usuario->password=Hash::make('CuantificacionEmisiones');
	    $usuario->save();

    	return response()->json(['ok' => true, 'message' => "Usuario Actualizado" ]);
    }
}


  // 'retc' => '16266',
  // 'rut' => '6750037',
  // 'digito' => '7',
  // 'nombre' => 'ALEXIS',
  // 'paterno' => 'LIBUY',
  // 'materno' => 'CARVAJAL',
  // 'email' => 'ALEXIS.LIBUY@GMAIL.COM',
  // 'cargo' => NULL,
  // 'tipo' => '0',
  // 'genero' => '1',
  // 'estado' => '1',
  // 'establecimiento' => '5441944',
  // 'institucion' => '1',
  // 'region' => '13',
  // 'per_retc' => '1',
  // 'fono' => '1461618161',