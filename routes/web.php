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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::get('logout', 'Auth\LogoutController@getLogout')->name('logout');

Route::get('auth/facebook/redirect', 'Auth\FacebookAuthController@getFacebookRedirect')->name('facebook.login');
Route::get('auth/facebook/callback', 'Auth\FacebookAuthController@getFacebookCallback');

Route::get('auth/google/redirect', 'Auth\GoogleAuthController@getGoogleRedirect')->name('google.login');
Route::get('auth/google/callback', 'Auth\GoogleAuthController@getGoogleCallback');

Route::get('/trac-nghiem', 'QuestionController@index')->name('question');
Route::get('/introduction', 'IntroductionController@index')->name('introduction');
Route::middleware(['role:superadministrator|administrator|technicaladministrator|user'])->group(function () {
    Route::group(['prefix' => 'trac-nghiem'], function () {
        Route::get('/trac-nghiem-hung-thu-nghe-nghiep-riasec', 'QuestionRiasecTestController@index')->name('question.riasec-test');
        Route::post('/trac-nghiem-hung-thu-nghe-nghiep-riasec', 'QuestionRiasecTestController@submitRIASECQuestion')->name('question.riasec-test-submit');
        Route::get('/trac-nghiem-nhan-cach-neo', 'QuestionNeoTestController@index')->name('question.neo-test');
        Route::post('/trac-nghiem-nhan-cach-neo', 'QuestionNeoTestController@submitNEOQuestion')->name('question.neo-test-submit');
        Route::get('/trac-nghiem-sang-loc-kho-khan-tam-ly', 'QuestionPsychologyTestController@index')->name('question.psychology-test');
        Route::post('/trac-nghiem-sang-loc-kho-khan-tam-ly', 'QuestionPsychologyTestController@submitPsychologyQuestion')->name('question.psychology-tes-submitt');


        Route::get('/question-riasec-result', 'QuestionRiasecResultController@index')->name('question.riasec-result');
        Route::get('/question-neo-result', 'QuestionNeoResultController@index')->name('question.neo-result');
        Route::get('/question-psychology-result', 'QuestionPsychologyResultController@index')->name('question.psychology-result');
    });

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::get('speciality', 'ProfileController@getSpeciality')->name('speciality');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');

    Route::get('history', 'HistoryController@index')->name('history');
    Route::get('history-detail/{type}/{id}', 'HistoryController@historyDetail')->name('history.detail');
    Route::get('history-export/riasec/{id}', 'HistoryController@riasecHistoryDetailExportPDF')->name('history.riasec.export');
    Route::get('history-export/psychology/{id}', 'HistoryController@psychologyHistoryDetailExportPDF')->name('history.psychology.export');
    Route::get('history-export/neo/{id}', 'HistoryController@neoHistoryDetailExportPDF')->name('history.neo.export');
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::group(['prefix' => 'question-neo', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'neo.index', 'uses' => 'QuestionNeoController@index']);
        Route::get('/export', ['as' => 'neo.export', 'uses' => 'QuestionNeoController@export']);
        Route::get('/create', ['as' => 'neo.create', 'uses' => 'QuestionNeoController@create']);
        Route::post('/', ['as' => 'neo.store', 'uses' => 'QuestionNeoController@store']);
        Route::get('/edit/{id}', ['as' => 'neo.edit', 'uses' => 'QuestionNeoController@edit']);
        Route::post('/edit/{id}', ['as' => 'neo.update', 'uses' => 'QuestionNeoController@update']);
        Route::get('/delete/{id}', ['as' => 'neo.delete', 'uses' => 'QuestionNeoController@destroy']);
    });

    Route::group(['prefix' => 'report', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'report.index', 'uses' => 'ReportController@index']);
        Route::get('/detail', ['as' => 'reportdetail.index', 'uses' => 'ReportController@detail']);
        Route::get('/detail/{id}', ['as' => 'reportuserdetail.index', 'uses' => 'ReportController@userDetail']);
        Route::get('/neo-export', ['as' => 'neoreport.export', 'uses' => 'ReportController@neoExport']);
        Route::get('/neo-export-detail', ['as' => 'neoreport.exportdetail', 'uses' => 'ReportController@neoExportDetail']);
        Route::get('/psychology-export', ['as' => 'psychologyreport.export', 'uses' => 'ReportController@psychologyExport']);
        Route::get('/psychology-export-detail', ['as' => 'psychologyreport.exportdetail', 'uses' => 'ReportController@psychologyExportDetail']);
        Route::get('/riasec-export', ['as' => 'riasecreport.export', 'uses' => 'ReportController@riasecExport']);
        Route::get('/riasec-export-detail', ['as' => 'riasecreport.exportdetail', 'uses' => 'ReportController@riasecExportDetail']);
    });

    Route::group(['prefix' => 'question-riasec', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'riasec.index', 'uses' => 'QuestionRiaSecController@index']);
        Route::get('/create', ['as' => 'riasec.create', 'uses' => 'QuestionRiaSecController@create']);
        Route::get('/export', ['as' => 'riasec.export', 'uses' => 'QuestionRiaSecController@export']);
        Route::post('/', ['as' => 'riasec.store', 'uses' => 'QuestionRiaSecController@store']);
        Route::get('/edit/{id}', ['as' => 'riasec.edit', 'uses' => 'QuestionRiaSecController@edit']);
        Route::post('/edit/{id}', ['as' => 'riasec.update', 'uses' => 'QuestionRiaSecController@update']);
        Route::get('/delete/{id}', ['as' => 'riasec.delete', 'uses' => 'QuestionRiaSecController@destroy']);
    });

    Route::group(['prefix' => 'question-difficult-psychology', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'psychology.index', 'uses' => 'QuestionDifficultPsychologyController@index']);
        Route::get('/create', ['as' => 'psychology.create', 'uses' => 'QuestionDifficultPsychologyController@create']);
        Route::get('/export', ['as' => 'psychology.export', 'uses' => 'QuestionDifficultPsychologyController@export']);
        Route::post('/', ['as' => 'psychology.store', 'uses' => 'QuestionDifficultPsychologyController@store']);
        Route::get('/edit/{id}', ['as' => 'psychology.edit', 'uses' => 'QuestionDifficultPsychologyController@edit']);
        Route::post('/edit/{id}', ['as' => 'psychology.update', 'uses' => 'QuestionDifficultPsychologyController@update']);
        Route::get('/delete/{id}', ['as' => 'psychology.delete', 'uses' => 'QuestionDifficultPsychologyController@destroy']);
    });

    Route::group(['prefix' => 'explain-question-neo', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'explainneo.index', 'uses' => 'ExplainQuestionNEOController@index']);
        Route::get('/create', ['as' => 'explainneo.create', 'uses' => 'ExplainQuestionNEOController@create']);
        Route::post('/', ['as' => 'explainneo.store', 'uses' => 'ExplainQuestionNEOController@store']);
        Route::get('/edit/{id}', ['as' => 'explainneo.edit', 'uses' => 'ExplainQuestionNEOController@edit']);
        Route::post('/edit/{id}', ['as' => 'explainneo.update', 'uses' => 'ExplainQuestionNEOController@update']);
        Route::get('/delete/{id}', ['as' => 'explainneo.delete', 'uses' => 'ExplainQuestionNEOController@destroy']);
    });

    Route::group(['prefix' => 'explain-question-riasec', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'explainriasec.index', 'uses' => 'ExplainQuestionRIASECController@index']);
        Route::get('/create', ['as' => 'explainriasec.create', 'uses' => 'ExplainQuestionRIASECController@create']);
        Route::post('/', ['as' => 'explainriasec.store', 'uses' => 'ExplainQuestionRIASECController@store']);
        Route::get('/edit/{id}', ['as' => 'explainriasec.edit', 'uses' => 'ExplainQuestionRIASECController@edit']);
        Route::post('/edit/{id}', ['as' => 'explainriasec.update', 'uses' => 'ExplainQuestionRIASECController@update']);
        Route::get('/delete/{id}', ['as' => 'explainriasec.delete', 'uses' => 'ExplainQuestionRIASECController@destroy']);
    });

    Route::group(['prefix' => 'university', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'university.index', 'uses' => 'UniversityController@index']);
        Route::get('/create', ['as' => 'university.create', 'uses' => 'UniversityController@create']);
        Route::post('/', ['as' => 'university.store', 'uses' => 'UniversityController@store']);
        Route::get('/edit/{id}', ['as' => 'university.edit', 'uses' => 'UniversityController@edit']);
        Route::post('/edit/{id}', ['as' => 'university.update', 'uses' => 'UniversityController@update']);
        Route::get('/delete/{id}', ['as' => 'university.delete', 'uses' => 'UniversityController@destroy']);
    });

    Route::group(['prefix' => 'user', 'middleware' => ['role:superadministrator']], function () {
        Route::get('/', ['as' => 'user.index', 'uses' => 'UserManagementController@index']);
        Route::get('/create', ['as' => 'user.create', 'uses' => 'UserManagementController@create']);
        Route::get('/export', ['as' => 'user.export', 'uses' => 'UserManagementController@export']);
        Route::post('/', ['as' => 'user.store', 'uses' => 'UserManagementController@store']);
        Route::get('/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserManagementController@edit']);
        Route::post('/edit/{id}', ['as' => 'user.update', 'uses' => 'UserManagementController@update']);
        Route::get('/delete/{id}', ['as' => 'user.delete', 'uses' => 'UserManagementController@destroy']);
        Route::get('/block/{id}', ['as' => 'user.block', 'uses' => 'UserManagementController@block']);
        Route::get('/unblock/{id}', ['as' => 'user.unblock', 'uses' => 'UserManagementController@unblock']);
        Route::get('/search', ['as' => 'user.search', 'uses' => 'UserManagementController@search']);
        Route::get('/history/{id}', ['as' => 'user.history', 'uses' => 'UserManagementController@history']);
    });

    Route::group(['prefix' => 'neo-rule', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'neorule.index', 'uses' => 'NEORuleController@index']);

        Route::group(['prefix' => 'type-rule'], function () {
            Route::get('/create', ['as' => 'neotyperule.create', 'uses' => 'NEORuleController@createTypeRule']);
            Route::get('/edit/{id}', ['as' => 'neotyperule.edit', 'uses' => 'NEORuleController@editTypeRule']);
            Route::post('/edit/{id}', ['as' => 'neotyperule.update', 'uses' => 'NEORuleController@updateTypeRule']);
            Route::post('/', ['as' => 'neotyperule.store', 'uses' => 'NEORuleController@storeTypeRule']);
            Route::get('/delete/{id}', ['as' => 'neotyperule.delete', 'uses' => 'NEORuleController@destroyTypeRule']);
        });

        Route::group(['prefix' => 'result-rule'], function () {
            Route::get('/create', ['as' => 'neoresultrule.create', 'uses' => 'NEORuleController@createResultRule']);
            Route::get('/edit/{id}', ['as' => 'neoresultrule.edit', 'uses' => 'NEORuleController@editResultRule']);
            Route::post('/edit/{id}', ['as' => 'neoresultrule.update', 'uses' => 'NEORuleController@updateResultRule']);
            Route::post('/', ['as' => 'neoresultrule.store', 'uses' => 'NEORuleController@storeResultRule']);
            Route::get('/delete/{id}', ['as' => 'neoresultrule.delete', 'uses' => 'NEORuleController@destroyResultRule']);
        });
    });

    Route::group(['prefix' => 'psychology-rule', 'middleware' => ['role:superadministrator|administrator|technicaladministrator']], function () {
        Route::get('/', ['as' => 'psychologyrule.index', 'uses' => 'PsychologyRuleController@index']);

        Route::group(['prefix' => 'result-rule'], function () {
            Route::get('/edit/{id}', ['as' => 'psychologyresultrule.edit', 'uses' => 'PsychologyRuleController@editResultRule']);
            Route::post('/edit/{id}', ['as' => 'psychologyresultrule.update', 'uses' => 'PsychologyRuleController@updateResultRule']);
            Route::get('/create', ['as' => 'psychologyresultrule.create', 'uses' => 'PsychologyRuleController@createResultRule']);
            Route::post('/', ['as' => 'psychologyresultrule.store', 'uses' => 'PsychologyRuleController@storeResultRule']);
            Route::get('/delete/{id}', ['as' => 'psychologyresultrule.delete', 'uses' => 'PsychologyRuleController@destroyResultRule']);
        });

        Route::group(['prefix' => 'answer-rule',], function () {
            Route::get('/edit/{id}', ['as' => 'psychologyanswerrule.edit', 'uses' => 'PsychologyRuleController@editAnswerRule']);
            Route::post('/edit/{id}', ['as' => 'psychologyanswerrule.update', 'uses' => 'PsychologyRuleController@updateAnswerRule']);
            Route::get('/create', ['as' => 'psychologyanswerrule.create', 'uses' => 'PsychologyRuleController@createAnswerRule']);
            Route::post('/', ['as' => 'psychologyanswerrule.store', 'uses' => 'PsychologyRuleController@storeAnswerRule']);
            Route::get('/delete/{id}', ['as' => 'psychologyanswerrule.delete', 'uses' => 'PsychologyRuleController@destroyAnswerRule']);
        });
    });
});

Route::get('history-export-pdf/{user_id}/riasec/{id}', 'HistoryController@riasecHistoryDetailExportPDF');
Route::get('history-export-pdf/{user_id}/psychology/{id}', 'HistoryController@psychologyHistoryDetailExportPDF');
Route::get('history-export-pdf/{user_id}/neo/{id}', 'HistoryController@neoHistoryDetailExportPDF');