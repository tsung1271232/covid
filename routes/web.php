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

    Route::Post('/nextQuestion', 'CovidController@nextQuestion')->name("nextQuestion");

    Route::Post('/new_startQuestion', 'CovidController@new_startQuestion')->name("new_startQuestion");

    Route::Post('/preQuestion', 'CovidController@preQuestion')->name("preQuestion");

    Route::Post('/endQuestion', 'CovidController@endQuestion')->name("endQuestion");

    Route::get("/excel", "QuestionController@import");

    Route::get('/topic', "TopicController@index")->name('topics.index');

    Route::get('/questions/{topic}', 'QuestionController@index')->name('questions.index');

    Route::get("/test", "TopicController@question");

    Route::Post("insertQuestion", "QuestionController@store")->name('questions.insert');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
