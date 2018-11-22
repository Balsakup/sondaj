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

    Route::resource('surveys', 'SurveysController');
    Route::resource('pages', 'PagesController');
    Route::resource('questions', 'QuestionsController');
    Route::resource('answers', 'AnswersController');
    Route::resource('questionrules', 'QuestionRulesController');
});
