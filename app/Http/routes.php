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
Route::get('/', function () {
    //return view('welcome');
    return "Proyecto";
});
*/
Route::get('/', function () {
    return view('welcome');
});


Route::get('reg_usuarios',['uses' => 'UsuariosController@create', 'as' => 'reg_usuarios']);
Route::post('reg_usuarios',['uses' => 'UsuariosController@postCreate', 'as' => 'reg_usuarios']);
Route::resource('usuarios', 'UsuariosController',
                ['only' => ['index', 'show', 'update', 'destroy']]);

Route::resource('clientes', 'ClientesController');
Route::resource('tipos', 'TiposController');
Route::resource('productos', 'ProductosController');
Route::resource('stocks', 'StocksController');
Route::auth();
Route::get('/home', 'HomeController@index');
