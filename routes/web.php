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

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => 'can:access-admin',
], function() {
    Route::get('', 'HomeController@index');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
});

Route::get('init_password/{token}', 'InitPasswordController@index')->name('password.show_init');
Route::post('init_password', 'InitPasswordController@initialize')->name('password.init');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
