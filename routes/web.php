<?php

// Route::get('test',function(){
//     $user = new App\User;
//     $user->idNumero=1;
//     $user->name='Karen Sanchez';
//     $user->username='karensanvel';
//     $user->password=bcrypt('12345678');
//     $user->save();

//     return $user;
// });  
//login
//Route::get('/login', 'UserController@showLoginForm')->name('user.login'); //mustra el login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('user.login');
Route::get('register', 'UserController@showRegisterForm')->name('user.register');   
Route::post('login', 'Auth\LoginController@login')->name('user.login.submit');
Route::post('logout', 'Auth\LoginController@logout')->name('user.auth.logout');//salir

Route::group(['middleware' => 'auth'], function() {
    Route::get('/index', 'UserController@index')->name('user.index');
    Route::get('/history', 'LecturaTHController@history')->name('lectura.history');
});
