<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
* RUTAS CONTROLADOR INSUMO
*/
Route::group(['prefix'=>'insumo'],function(){
    Route::get('listInsumos', 'InsumoController@listInsumos');
    Route::post('insertInsumo', 'InsumoController@insertInsumo');
    Route::put('updateInsumo', 'InsumoController@updateInsumo');
    Route::put('deleteInsumo', 'InsumoController@deleteInsumo');
});


Route::group(['prefix'=>'docente'],function(){
    Route::get('list', 'DocenteController@list');
    Route::post('save', 'DocenteController@save');
    Route::put('update/{docente}', 'DocenteController@update');
    Route::post('delete', 'DocenteController@delete');
});

Route::group(['prefix'=>'clase'],function(){
    Route::get('list', 'ClaseController@list');
    Route::post('save', 'ClaseController@save');
    Route::put('update/{clase}', 'ClaseController@update');
    Route::post('delete', 'ClaseController@delete');
});

Route::group(['prefix'=>'estudiante'],function(){
    Route::get('list', 'EstudianteController@list');
    Route::post('save', 'EstudianteController@save');
    Route::put('update/{estudiante}', 'EstudianteController@update');
    Route::post('delete', 'EstudianteController@delete');
});

Route::group(['prefix'=>'nota'],function(){
    Route::get('list', 'NotaController@list');
    Route::post('save', 'NotaController@save');
    Route::put('update/{nota}', 'NotaController@update');
    Route::post('delete', 'NotaController@delete');
});

Route::group(['prefix'=>'nota_estudiante'],function(){
    Route::get('list', 'NotaEstudianteController@list');
    Route::post('save', 'NotaEstudianteController@save');
    Route::put('update/{nota_estudiante}', 'NotaEstudianteController@update');
    Route::post('delete', 'NotaEstudianteController@delete');
});

