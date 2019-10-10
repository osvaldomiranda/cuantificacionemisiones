<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{

    public function update(Request $request)
    {
    	Info("***** EstablishmentController 14 ******");
    	Info($request);


	    $establishmentExists= Establishment::where('retc_code',$response['retc'])->first();
	    if(!$establishmentExists){
	        $establishmentExists=new Establishment();
	        $establishmentExists->retc_code =$response['retc'];
	    }
	    $establishmentExists->name = $response['nombre'];
	    $establishmentExists->commune_id = $response['comuna'];
	    $establishmentExists->street = $response['calle'];
	    $establishmentExists->number = $response['numero'];

	    $establishmentExists->user_id = $encargado_establecimiento->id;
	    $establishmentExists->save();


    	return response()->json(['ok' => true, 'message' => "Establecimiento Actualizado" ]);
    }
}

//   'codigo' => '5441944',
//   'nombre' => 'PRUEBILLA',
//   'comuna' => '10105',
//   'retc' => '1',
//   'dire' => 'MERCED 511',
//   'numero' => '213123123',
//   'calle' => 'calle 343',
//   'huso' => '1',
//   'utmn' => '1',
//   'utme' => '1',
//   'empresa' => '96792430',
//   'fono' => '123123123',
//   'fax' => '123123123',
//   'representante' => '5',
//   'estado' => '1',
//   'ciiu' => 'asdasd',
//   'rrut' => '19116811',
//   'rdigito' => '9',
//   'rnombre' => 'Jonaathan',
//   'rpaterno' => 'Salamanca',
//   'rmaterno' => 'Contreras',







// [2019-10-03 15:14:37] local.INFO: ***** userController 14 ******  
// [2019-10-03 15:14:37] local.INFO: array (
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
// )  
// [2019-10-03 15:28:47] local.INFO: ***** CompanyController 14 ******  
// [2019-10-03 15:28:47] local.INFO: array (
//   'retc' => '16266',
//   'rut' => '6750037',
//   'digito' => '7',
//   'nombre' => 'ALEXIS',
//   'paterno' => 'LIBUY',
//   'materno' => 'CARVAJAL',
//   'email' => 'ALEXIS.LIBUY@GMAIL.COM',
//   'cargo' => NULL,
//   'tipo' => '0',
//   'genero' => '1',
//   'estado' => '1',
//   'establecimiento' => '5441944',
//   'institucion' => '1',
//   'region' => '13',
//   'per_retc' => '1',
//   'fono' => '1461618161',
// )  
// [2019-10-03 15:29:00] local.INFO: ***** EstablishmentController 14 ******  
// [2019-10-03 15:29:00] local.INFO: array (
//   'retc' => '16266',
//   'rut' => '6750037',
//   'digito' => '7',
//   'nombre' => 'ALEXIS',
//   'paterno' => 'LIBUY',
//   'materno' => 'CARVAJAL',
//   'email' => 'ALEXIS.LIBUY@GMAIL.COM',
//   'cargo' => NULL,
//   'tipo' => '0',
//   'genero' => '1',
//   'estado' => '1',
//   'establecimiento' => '5441944',
//   'institucion' => '1',
//   'region' => '13',
//   'per_retc' => '1',
//   'fono' => '1461618161',
// )  
// [2019-10-03 15:29:11] local.INFO: ***** EstablishmentController 14 ******  
// [2019-10-03 15:29:11] local.INFO: array (
//   'retc' => '16266',
//   'rut' => '6750037',
//   'digito' => '7',
//   'nombre' => 'ALEXIS',
//   'paterno' => 'LIBUY',
//   'materno' => 'CARVAJAL',
//   'email' => 'ALEXIS.LIBUY@GMAIL.COM',
//   'cargo' => NULL,
//   'tipo' => '0',
//   'genero' => '1',
//   'estado' => '1',
//   'establecimiento' => '5441944',
//   'institucion' => '1',
//   'region' => '13',
//   'per_retc' => '1',
//   'fono' => '1461618161',
// )  
// [2019-10-03 15:30:16] local.INFO: ***** EstablishmentController 14 ******  
// [2019-10-03 15:30:16] local.INFO: array (
//   'codigo' => '5441944',
//   'nombre' => 'PRUEBILLA',
//   'comuna' => '10105',
//   'retc' => '1',
//   'dire' => 'MERCED 511',
//   'numero' => '213123123',
//   'calle' => 'calle 343',
//   'huso' => '1',
//   'utmn' => '1',
//   'utme' => '1',
//   'empresa' => '96792430',
//   'fono' => '123123123',
//   'fax' => '123123123',
//   'representante' => '5',
//   'estado' => '1',
//   'ciiu' => 'asdasd',
//   'rrut' => '19116811',
//   'rdigito' => '9',
//   'rnombre' => 'Jonaathan',
//   'rpaterno' => 'Salamanca',
//   'rmaterno' => 'Contreras',
// )  