<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function update(Request $request)
    {

    	Info("***** CompanyController 14 ******");
    	Info($request);

    	return response()->json(['ok' => true, 'message' => "Empresa Actualizada" ]);
    }
}