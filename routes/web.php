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
////////////

define('PUBLIC','public');


////////////////
Route::get('/', function () {
    return view('welcome');
});

Route::resource('users','UserController');

Route::resource('roles','RoleController');
Route::resource('permissions','PermissionController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/toggleActive/{user}','UserController@toggle_active')->name('users.toggleActive');
Route::get('/user/{user}/login','UserController@login')->name('user.login');
Route::get('/role/{role}/removePermission/{permission_id}','RoleController@removePermission');
Route::get('/role/{role}/assignPermission/{permission_id}','RoleController@assignPermission');


