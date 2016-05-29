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
Route::group(['middleware'=>'admin'],function(){
	Route::get('/admin','generalController@index');

	Route::get('/admin/tipogaleria.html','tipoGaleriaController@index');
	Route::put('/agregar/tipogaleria.html','tipoGaleriaController@store');
	Route::patch('modificar/tipogaleria/{id}.html','tipoGaleriaController@update');
	Route::delete('eliminar/tipogaleria/{id}.html','tipoGaleriaController@destroy');
	
	Route::get('/admin/galerias.html','galeriaController@index');
	Route::put('/guardar/inf_principal.html','galeriaController@storePrincipal');
	Route::put('/guardar/portada.html','galeriaController@storePortada');
	Route::put('/guardar/imagenes.html','galeriaController@store');
	Route::put('/guardar/videos.html','galeriaController@storeVideos');
	Route::patch('/editar/galeria.html','galeriaController@edit');
	Route::delete('/eliminar/galeria.html','galeriaController@destroy');
	Route::delete('/eliminar/imagen.html','galeriaController@destroyImg');
	Route::patch('/modificar/inf_principal.html','galeriaController@updatePrincipal');
	Route::patch('/modificar/portada.html','galeriaController@updatePortada');
	Route::patch('/modificar/videos.html','galeriaController@updateVideos');
	Route::patch('/modificar/imagenes.html','galeriaController@update');

	Route::post('/admin/publicidad.html','publiController@index');
	Route::get('/admin/publicidad.html','publiController@index2');
	Route::put('/guardar/publicidad.html','publiController@store');
	Route::patch('/modificar/publicidad/{id}.html','publiController@update');
	Route::delete('/eliminar/publicidad/{id}.html','publiController@destroy');
	Route::patch('/editar/publicidad/{id}.html','publiController@show');

});

Route::get('/',function(){
	return redirect('index.html');
});
Route::get('/index.html','publicController@index');
Route::get('/seccion/{id}.html','publicController@show');
Route::get('/galeria/{id}.html','publicController@recursos');
Route::get('galerias.html','publicController@index');
Route::get('/login.html','loginController@index');
Route::patch('validar.html','loginController@store');
Route::get('/videos.html','publicController@video');
Route::get('/conocenos.html','publicController@conocenos');
Route::get('/cerrar.html','loginController@destroy');