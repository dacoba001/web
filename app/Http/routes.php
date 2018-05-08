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
Route::get('/clientes/create/users', 'ClientesController@users');
Route::post('/clientes/create/users', 'ClientesController@usersCreate');
Route::resource('tipos', 'TiposController');
Route::resource('productos', 'ProductosController');
Route::get('/stocks/min', 'StocksController@minStock');
Route::resource('stocks', 'StocksController');

Route::resource('carritos', 'CarritosController');
Route::get('/carritos/productos/{users}', 'CarritosController@productos');

Route::resource('pedidos', 'PedidosController');
Route::get('/pedidos/users/{users}', 'PedidosController@getPedidos');
Route::get('/pedidoss/estado/1', 'PedidosController@indexEntregados');
Route::post('/pedidos/entregartodo', 'PedidosController@postEntregarTodo');
Route::post('/pedidos/entregar/{detallepedido}', 'PedidosController@postEntregar');
Route::post('/pedidos/devolver/{detallepedido}', 'PedidosController@postDevolver');

Route::resource('importacions', 'ImportacionsController');

Route::get('reportes/importacions', 'ReportesController@reporteImportacions');
Route::post('reportes/importacions', 'ReportesController@reporteImportacions');
Route::get('reportes/pedidos', 'ReportesController@reportePedidos');
Route::post('reportes/pedidos', 'ReportesController@reportePedidos');
Route::get('reportes/pedidosdetalle/{pedido}', 'ReportesController@reportePedidosDetalle');
Route::get('reportes/stocks', 'ReportesController@reporteStocks');
Route::post('reportes/stocks', 'ReportesController@reporteStocks');

Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/home/productos/{tipos}', 'HomeController@getProductos');
Route::get('/home/tipos', 'HomeController@getTipos');
