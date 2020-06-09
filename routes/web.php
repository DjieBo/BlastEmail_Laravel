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

Route::get('/', function () {return view('welcome');});
Route::get('/', 'ActionController@index');
Route::post('/login', 'ActionController@login');
Route::get('/main', 'ProcessController@main');
Route::get('/logout', 'ActionController@logout');
Route::post('/upload', 'ProcessController@upload');
Route::post('/sendemail', 'ProcessController@sendemail');