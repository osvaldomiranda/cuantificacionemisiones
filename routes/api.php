
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
Route::get('/sources/process', 'SourceController@process');

Route::get('/diagram/refresh', 'DiagramController@refresh');
Route::get('/diagram/byestablishment', 'DiagramController@byEstablishment');
Route::get('/diagram/get/','DiagramController@show');

Route::post('/declaration/new','DeclarationController@new');
Route::get('/declarations','DeclarationController@index');
Route::post('/declaration/change','DeclarationController@changeState');
Route::get('/declarationswith','DeclarationController@indexWith');

Route::post('/declarations/change','DeclarationController@changeStates');

Route::get('/consumption/bysource','ConsumptionController@bySource');
Route::post('/consumption/save','ConsumptionController@save');

Route::get('/paralization/bysource','ParalizationController@bySource');
Route::post('/paralization/save','ParalizationController@save');

Route::get('/operatingcicle/bysource','OperatingCicleController@bySource');
Route::post('/operatingcicle/save','OperatingCicleController@save');

Route::get('/factors/byprocess','SourceController@factorsByProcess');

Route::get('/binnacles','BinnacleController@index');
Route::get('/comments','CommentController@index');
Route::post('/comment/create','CommentController@create');
Route::post('/reading/save', 'ReadingController@save');

Route::get('/reading/bysource', 'ReadingController@bySource');
Route::get('/run/bysource', 'ReadingController@runBySource');

Route::get('/reading/bydeclaration', 'ReadingController@index');
Route::get('/runs/byreading', 'ReadingController@runsByReading');

Route::post('/currentops/save', 'CurrentopController@save');
Route::get('/currentops', 'CurrentopController@index');
Route::get('/currentop/download', 'CurrentopController@downloadStorage');

Route::post('/estimation/save', 'EstimationController@save');
Route::get('/estimations', 'EstimationController@index');


// para el diagrama de descarga
Route::get('/source_types', 'SourceTypes@index');
Route::get('/source_types/{type}', 'SourceTypes@getSourceByType');
Route::get('/source_type/{id}', 'SourceTypes@getSourceById');
Route::get('/source_types_fields/{sourceid}', 'SourceTypeFieldController@getFieldsBySource');
Route::get('/source_types/id_source/{sourceid}', 'SourceTypes@getIdSource');
Route::get('/source_types/sucessor/{sourceid}', 'SourceTypes@getSuccesors');
Route::get('/source_types/fuels/{id}','SourceTypes@getFuelBySource');
Route::get('/source_types/fieldsfuels/{id}','SourceTypes@getFieldsAndBurners');
