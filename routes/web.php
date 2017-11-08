<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PagesController@index');

Route::get('/admin', 'AdminController@show');

Route::get('/about', 'PagesController@about');

Route::get('/contact', 'PagesController@contact');



Route::post('event/{id}/level/add', 'ElectionLevelsController@add');

Route::get('event/{id}/status', 'EventsController@status');

Route::post('event/{id}/question/add', 'EventsController@addQuestion');

Route::get('event/{id}/questions', 'EventsController@getAllQuestions');

Route::get('event/{id}/start', 'EventsController@start');

Route::get('event/{id}/stop', 'EventsController@stop');

Route::get('event/{id}/slides', 'EventsController@slides');

Route::get('event/{id}/mainStat', 'EventsController@mainStat');

Route::resource('event', 'EventsController');

Auth::routes();

Route::get('/home', 'PagesController@index');
