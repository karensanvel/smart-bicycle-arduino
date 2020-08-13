<?php

use Illuminate\Http\Request;


Route::get('getDatos', 'LecturaTHController@getDatos')->name('lectura.datos.get');
Route::get('getDatosUser', 'UserController@getDatos')->name('user.datos.get');
Route::get('getLastData', 'LecturaTHController@getLastData')->name('lectura.data.get');
//Route::get('getLecturas', 'LecturaTHController@getLecturas')->name('lecturas.data.get');
Route::get('numeroSerial/{number}', 'UserController@getNumber')->name('user.numero.get');
Route::get('user/{username}', 'UserController@getUsername')->name('user.username.get');
Route::get('numeroserial/{id}', 'UserController@getId')->name('user.serialId.get');
Route::post('create', 'UserController@store')->name('user.datos.store');
