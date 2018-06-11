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

Route::get('/', function () {
    return View::make('index');
});

Route::get('/home', function () {
    return View::make('home');
});



Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/{agregar}/jugador', 'JugadorController@create');
Route::post('/agregar/jugador','JugadorController@store');


Route::get('/{modificar}/jugador', 'JugadorController@create');
Route::post('/modificar/jugador','JugadorController@update');



