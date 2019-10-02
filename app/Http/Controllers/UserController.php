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

    	return response()->json(['ok' => true, 'message' => "Usuario Actualizada" ]);
    }
}