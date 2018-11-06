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
    return view('welcome');
});

Route::get('peliculas/{id?}', 'PeliculasController@show');

Route::get('agregarPelicula', 'PeliculasController@showForm');
Route::post('agregarPelicula', 'PeliculasController@addMovie');

Route::get('actores', 'ActorController@directory');
Route::get('actor/{id}', 'ActorController@show');

Route::get('actors/{id?}', 'ActorController@allInOne');