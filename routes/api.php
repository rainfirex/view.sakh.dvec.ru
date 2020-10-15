<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('bases', 'RegionBasesController@index');

Route::prefix('handler')->group(function () {

    Route::get('/gp/bd-{dep}/division-{division}/date-{date}', 'HandlerController@gp');

    Route::get('/osb/bd-{dep}/division-{division}/date-{date}', 'HandlerController@osb');

    Route::get('/peny/bd-{dep}/division-{division}/date-{date}', 'HandlerController@peny');

    Route::get('/shtraf/bd-{dep}/division-{division}/date-{date}', 'HandlerController@shtraf');

    Route::get('/count-error/bd-{dep}/division-{division}/date-{date}', 'HandlerController@countError');

});
