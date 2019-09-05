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
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vuinvitation/{secret_a}/{secret_b}','ApiUserController@validateSecret');


Route::get('/excel', function () {
    return Excel::download(new ExcelExport, 'products.xlsx');
});


Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');


