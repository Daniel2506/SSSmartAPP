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

/*
|--------------------------------------------------------------------------
| Routes Auth
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth'], function()
{
	Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
	Route::get('integrate', ['as' => 'auth.integrate', 'uses' => 'Auth\AuthController@integrate']);
});
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);

/*
|--------------------------------------------------------------------------
| Secure Routes Application
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

	/*
	|-------------------------
	| Admin Routes
	|-------------------------
	*/
	Route::group(['prefix' => 'usuarios'], function()
	{
		Route::resource('roles', 'Admin\UsuarioRolController', ['only' => ['index', 'store', 'destroy']]);
	});
	Route::group(['prefix' => 'roles'], function()
	{
		Route::resource('permisos', 'Admin\PermisoRolController', ['only' => ['index', 'update', 'destroy']]);
	});

	Route::resource('roles', 'Admin\RolController', ['except' => ['destroy']]);
	Route::resource('permisos', 'Admin\PermisoController', ['only' => ['index']]);
	Route::resource('modulos', 'Admin\ModuloController', ['only' => ['index']]);
	Route::resource('usuarios', 'Admin\UserController', ['except' => ['destroy']]);
	Route::resource('maquinas', 'Admin\MaquinaController', ['except' => ['destroy']]);
	Route::resource('bitacoras', 'Admin\BitacoraController', ['except' => ['destroy']]);
	Route::resource('facturas', 'Admin\FacturaController', ['except' => ['destroy']]);
});
