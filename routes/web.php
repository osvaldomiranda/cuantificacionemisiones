<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Session;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
	dd($request->session()->get('token'));
    return view('welcome');
});



Route::get('/vuinvitation/{secret_a}/{secret_b}','ApiUserController@validateSecret');


Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');


