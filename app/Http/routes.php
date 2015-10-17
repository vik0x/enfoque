<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::put('agregar/tipogaleria.html','tipoGaleriaController@store');
Route::patch('modificar/tipogaleria/{id}.html','tipoGaleriaController@edit');
Route::delete('eliminar/tipogaleria/{id}.html','tipoGaleriaController@destroy');
