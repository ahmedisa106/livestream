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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('sessions/data','SessionController@data')->name('sessions.data');
Route::post('join-session/{session_id}','SessionController@joinSession')->name('joinSession');
Route::resource('sessions','SessionController');
Route::get('/home', 'HomeController@index')->name('home');
