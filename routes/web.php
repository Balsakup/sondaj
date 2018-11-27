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

Route::group([ 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::' ], function () {
    Route::get('/', 'DashboardController@home')->name('dashboard.home');
    Route::post('/sort', 'DashboardController@sort')->name('dashboard.sort');

    Route::resource('surveys', 'SurveysController');
    Route::resource('pages', 'PagesController');
    Route::resource('questions', 'QuestionsController');
    Route::resource('answers', 'AnswersController');
    Route::resource('questionrules', 'QuestionRulesController');
    Route::resource('questionactions', 'QuestionActionsController');
});

Route::get('/', 'SurveysController@index')->name('surveys.index');
Route::get('/{id}', 'SurveysController@show')->name('surveys.show');

Route::get('/questionnaire/{id}', 'SurveyRepliesController@show')->name('surveyreplies@show');
