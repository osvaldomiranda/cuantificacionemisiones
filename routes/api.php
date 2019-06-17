<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/solicitud_industrial', 'ApiUserController@solicitudIndustrial');
Route::post('/requisition/approve', 'RequisitionController@approve');
Route::post('/requisition/reject', 'RequisitionController@reject');

Route::post('/user_invitation', 'ApiUserController@setSecretInvitation')->middleware('client');
Route::post('/crear_solicitud', 'ApiUserController@createRequisition')->middleware('client');
Route::get('/set_user', 'ApiUserController@setUserVue');

Route::get('/requisitions', 'RequisitionController@index');


