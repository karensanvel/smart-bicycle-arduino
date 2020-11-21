<?php

use Illuminate\Http\Request;


Route::get('getDatos', 'LecturaTHController@getDatos')->name('lectura.datos.get');//ultimos 10 datos
Route::get('getLastData', 'LecturaTHController@getLastData')->name('lectura.data.get');//ultimo dato registrado en la bd
Route::get('history-tempHum', 'LecturaTHController@temperatureMoistureHistory')->name('lectura.history.temphum.get');
Route::get('history-alarm', 'LecturaTHController@alarmHistory')->name('lectura.history.alarm.get');
Route::get('lastRoute', 'CoordenadaController@lastRoute')->name('last.route.get');//Obtener todas las coordenadas y el tiempo de viaje de la ultima ruta que se esté viajando
Route::get('getAllRoutes', 'CoordenadaController@getAllRoutes')->name('coordenadas.rutas.get');//rutas viajadas por el usuario y sus coordenadas
Route::get('ultimasCoordenadas', 'CoordenadaController@ultimasCoordenadas')->name('coordenadas.ultimas-coordenadas.get');//ultimas coordenadas del viaje en proceso
Route::get('datosViaje/{id}', 'CoordenadaController@getParametersByRoute')->name('coordenadas.viaje-parametros.get');//conocer parametros de viaje por id como la fecha, tiemp de viaje y sus coordenadas
Route::get('getAllCoordenadas/{id}', 'CoordenadaController@getAllCoordenadasPorViaje')->name('coordenadas.viaje-coordenadas.get');// todas las coordenadas por rutaId
Route::get('numeroSerial/{number}', 'UserController@getNumber')->name('user.numero.get');//numero serial del logeado (BORRAR Y ADAPTAR)
Route::get('user/{username}', 'UserController@getUsername')->name('user.username.get'); //informacion del usuario con su numero serial
Route::get('numeroserial/{id}', 'UserController@getId')->name('user.serialId.get');//informacion del usuario (BORRAR Y ADAPTAR)
Route::post('create', 'UserController@store')->name('user.datos.store');//crear un usuario 
