<?php

use App\Jobs\SendWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
Route::get('v1/imecas/ozono', 'ImecasController@ozono');
Route::get('v1/imecas/monoxido_de_carbono', 'ImecasController@monoxidoDeCarbono');
Route::get('v1/imecas/bioxido_de_azufre', 'ImecasController@bioxidoDeAzufre');
Route::get('v1/imecas/bioxido_de_nitrogeno', 'ImecasController@bioxidoDeNitrogeno');
// Route::middleware(['auth:api'])->group(function () {
Route::post('v1/registries', 'RegistryController@store');
Route::post('v1/registries/upload', 'RegistryController@upload');
Route::get('v1/registries', 'RegistryController@index');

// });
Route::get('v1/uploaded_resume', 'AuditInfoController@getUploadedResume');


Route::resource('v1/estaciones', 'EstacionesController');


Route::post(
    'v1/callback/whatsapp',
    function () {
        dd(request());
    }
);

Route::post('v1/callback/inbound', 'WhatsappSubscriberController@inbound');
