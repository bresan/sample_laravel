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

Route::get('candidats', 'CandidatsController@index');

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Auth::routes();

    Route::get('candidats/all', 'CandidatsController@index');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('candidats/new', 'CandidatsController@new');
    Route::get('candidats/{candidat}/edit', 'CandidatsController@edit');
    Route::post('candidats/save', 'CandidatsController@save');
    Route::post('candidats/edit/{candidat}', 'CandidatsController@update');
    Route::patch('candidats/{candidat}', 'CandidatsController@update');
    Route::delete('candidats/{candidat}', 'CandidatsController@delete');
    Route::patch('candidats/{candidat}', 'CandidatsController@vote');
});



Route::get('reset', function () {
    session_start();
    unset($_SESSION['ja_votou']);
});
