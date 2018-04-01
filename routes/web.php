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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('execute', 'ExecuteController')->middleware('auth');
Route::resource('client', 'ClientController')->middleware('auth');
Route::resource('season', 'SeasonController')->middleware('auth');
Route::resource('direction', 'DirectionController')->middleware('auth');
Route::resource('shedule', 'SheduleController')->middleware('auth');
Route::resource('branch', 'BranchController')->middleware('auth');
Route::resource('room', 'RoomController')->middleware('auth');

Route::delete('/direction/execute-delete/{id}', 'ExecuteController@executeDestroy')->middleware('auth');
Route::get('/branch/rooms/{id}', 'BranchController@rooms')->middleware('auth');
