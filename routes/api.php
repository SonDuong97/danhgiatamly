<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('API')->group(function () {
    Route::post('login', 'PassportController@login');
    Route::post('register', 'PassportController@register');
    Route::get('question', 'QuestionController@index');

    Route::middleware('auth:api')->group(function () {
        Route::get('question/form', 'QuestionController@list');
        Route::post('question/riasec', 'QuestionController@submitRIASECQuestion');
        Route::post('question/neo', 'QuestionController@submitNEOQuestion');
        Route::post('question/psycho', 'QuestionController@submitPsychologyQuestion');

        Route::get('logout', 'PassportController@logout');
        Route::get('profile', 'ProfileController@index');
        Route::post('profile', 'ProfileController@update');
        Route::post('profile/upload', 'ProfileController@upload');

        Route::get('history', 'HistoryController@index');
        Route::get('history/{type}/{id}', 'HistoryController@detail');
    });
    Route::get('major', 'ProfileController@getSpeciality');
});

Route::middleware('auth:api')->group(function () {
    Route::get('history-export/riasec/{id}', 'HistoryController@riasecHistoryDetailExportPDF')->name('history.riasec.export');
    Route::get('history-export/psychology/{id}', 'HistoryController@psychologyHistoryDetailExportPDF')->name('history.psychology.export');
    Route::get('history-export/neo/{id}', 'HistoryController@neoHistoryDetailExportPDF')->name('history.neo.export');
});

