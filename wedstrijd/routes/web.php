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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/wedstrijd', 'HomeController@index');
Route::get('/contest_datums','Contest@index');

Route::get('/contest_datums/update/{id}','Contest@updateCourenturentContest');
Route::get('/contest_datums/delete/{id}','Contest@deleteCourenturentContest');

Route::get('/contastant','Contest@showContestant');
Route::get('/contastant/delete/{id}','Contest@deleteContestant');

//post
Route::post('/contest_datums','Contest@seCourenturentContest');

Route::post('/contest_datums/update/id/{id}','Contest@updateNowCourenturentContest');
