<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('login', 'AuthController@login');

$router->get('user', 'UserController@getAllUser');
$router->get('user/data', 'UserController@getUser');
$router->post('user', 'UserController@store');
$router->get('/user/{id}', 'UserController@show');
$router->put('/user/{id}', 'UserController@update');
$router->delete('/user/{id}', 'UserController@destroy');

$router->get('barang', 'BarangController@getBarang');
$router->get('barang/{id}', 'BarangController@show');
$router->post('/barang', 'BarangController@store');
$router->put('/barang/{id}', 'BarangController@update');
$router->delete('/barang/{id}', 'BarangController@destroy');

$router->get('mutasi', 'MutasiController@getAllMutasi');
$router->post('mutasi', 'MutasiController@store');
$router->get('mutasi/{id}', 'MutasiController@show');
$router->put('mutasi/{id}', 'MutasiController@update');
$router->delete('mutasi/{id}', 'MutasiController@destroy');
$router->get('mutasi-barang/{id}', 'MutasiController@mutasiBarang');
$router->get('mutasi-user/{id}', 'MutasiController@mutasiUser');


