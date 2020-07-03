<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

///////Productores
Route::get('productores/cedula/{cedula}','Productores@findByCedula');
Route::post('productores/create','Productores@Create');
Route::get('productores/find/id/{id}','Productores@getById');
Route::get('productores/list/general/{region}/{provincia?}/{municipio?}/{distrito?}/{seccion?}/{barrio?}','Productores@ListGeneral');
//////////////////////Cedulados////////////////////////////
Route::get('cedulados/{cedula}','sisee@get_cedulado');

//////////////////ESTADISTICAS////////////////////////////////////////////////////
Route::get('estadisticas/get/{region?}/{provincia?}/{municipio?}/{distrito?}/{seccion?}/{barrio?}','Estadistica@estadisticas');
Route::get('grafico/get/{region?}/{provincia?}/{municipio?}/{distrito?}/{seccion?}/{barrio?}','Estadistica@Graficos');
/**********************************************
 *
 * ********FINCAS*******************************
 *
 *
 *
 * * */
Route::get('fincas/get/id/{id}','Fincas@get');
Route::get('fincas/list/general/{region}/{provincia?}/{municipio?}/{distrito?}/{seccion?}/{barrio?}','Fincas@ListGeneral');
Route::post('fincas/create','Fincas@create');
Route::get('fincas/get/with-prod/{region?}/{provincia?}/{municipio?}/{distrito?}/{seccion?}/{barrio?}','Fincas@getfincasWithProd');


/***************************
 *
 *-*************** DIVISION TERRITORIAL***************************
*/
Route::get('regiones/list','DivisionTerritorial@ListRegiones');
Route::get('provincias/list/{region}','DivisionTerritorial@ListProvincias');
Route::get('provincias/','DivisionTerritorial@ListProvincias');
Route::get('municipios/list/{provincia}','DivisionTerritorial@ListMunicipios');
Route::get('distritos/list/{provincia}/{municipio}','DivisionTerritorial@ListDistritos');
Route::get('secciones/list/{provincia}/{municipio}/{distrito}', 'DivisionTerritorial@ListSecciones');
Route::get('barrios/list/{provincia}/{municipio}/{distrito}/{seccion}', 'DivisionTerritorial@ListBarrioParaje');

//////////////////////////UTILITARIOS////////////////
Route::get('actividades/list','Fincas@listActividades');
Route::get('nacionalidad/list','DivisionTerritorial@ListaNacionalidad');
Route::get('query-builder/{tabla}/{campo}/{signo}/{valor}/{valor2?}/{and?}/{region?}/{provincia?}/{municipio?}','querymaker@FunctionName');
Route::get('certificado-finca',function(){
    return redirect()->route('certificado-finca');
});
