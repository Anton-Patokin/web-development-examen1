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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');Route::get('/wedstrijd', 'HomeController@index');
Route::get('/contest','Contest_admin@index');

Route::get('/contest_datums/update/{id}','Contest_admin@updateCourenturentContest');
Route::get('/contest_datums/delete/{id}','Contest_admin@deleteCourenturentContest');

Route::get('/contastant','Contest_admin@showContestant');
Route::get('/contastant/delete/{id}','Contest_admin@deleteContestant');
Route::get('/contastant/download_excel/{name}','Contest_admin@download_excelContestant');


Route::get('/test','Contest_admin@test');





//contest vieuw
Route::get('/play-contest','PlayController@index');



//post
Route::post('/play_contest/code','PlayController@play_code');
Route::post('/contest_datums','Contest_admin@seCourenturentContest');

Route::post('/contest_datums/update/id/{id}','Contest_admin@updateNowCourenturentContest');

Route::post('/apartisipan-information', 'PlayController@code');
Route::get('/apartisipan-information', 'PlayController@show_Partisipant_vieuw');
Route::post('/apartisipan-information/{code_view}', 'PlayController@logica');
