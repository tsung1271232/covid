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


Route::prefix('/covid')->group(function () {
//    Route::Post('/signIn', 'CovidController@signIn')->name("signIn");

//    Route::Post('/startQuestion', 'CovidController@startQuestion')->name("startQuestion");

    Route::Post('/nextQuestion', 'CovidController@nextQuestion')->name("nextQuestion");

    Route::Post('/new_startQuestion', 'CovidController@new_startQuestion')->name("new_startQuestion");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
