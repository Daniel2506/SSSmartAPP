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

/*
|--------------------------------------------------------------------------
| Routes Auth
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth'], function()
{
	Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@postLogin']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);
	Route::get('integrate', ['as' => 'auth.integrate', 'uses' => 'Auth\LoginController@integrate']);
});
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);

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
