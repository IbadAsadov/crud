<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',"HomeController@getHome")->name('getHome');
Route::post('/user-get',"HomeController@getUser")->name('getUser');
Route::delete('/user-delete/{id}',"HomeController@deleteUser")->name('deleteUser');
Route::post('/user-add',"HomeController@addUser")->name('addUser');
Route::post('/edit-user-get',"HomeController@editUserGet")->name('editUserGet');
Route::put('/edit-user-post',"HomeController@editUserPost")->name('editUserPost');

