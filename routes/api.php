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

// Route::middleware('client')->group(function () {
	Route::post('/user_invitation', 'ApiUserController@setSecretInvitation');
	Route::post('/crear_solicitud', 'ApiUserController@createRequisition');
// }

// Route::middleware('auth:api')->group(function () {
	Route::get('/set_user', 'ApiUserController@setUserVue');
// }

Route::get('/requisitions', 'RequisitionController@index');
Route::get('/sources/refresh', 'SourceController@refresh');
Route::get('/sources/byprocess', 'SourceController@sourcesByProcess');

Route::get('/diagram/refresh', 'DiagramController@refresh');
Route::get('/diagram/byestablishment', 'DiagramController@byEstablishment');



Route::get('/consumption/bysource','ConsumptionController@bySource');
Route::post('/consumption/save','ConsumptionController@save');

Route::get('/paralization/bysource','ParalizationController@bySource');
Route::post('/paralization/save','ParalizationController@save');

Route::get('/operatingcicle/bysource','OperatingCicleController@bySource');
Route::post('/operatingcicle/save','OperatingCicleController@save');