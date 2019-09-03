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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/test', 'StartingPageController@start')->name('start');
// Route::post('/test/begin', 'StartingPageController@index')->name('test');
// Route::get('/submit', 'StartingPageController@submit')->name('submit');
// Route::post('/submit/quiz', 'StartingPageController@store')->name('store');
// Route::post('/submit/question', 'StartingPageController@storeQ')->name('storeQ');

Route::get('/home', 'UserController@index');
Route::get('/{id}/profile', 'UserController@show');

Route::get('quiz', 'QuizController@create')->name('quiz');
Route::post('quiz/start', 'QuizController@show');
Route::post('subject', 'QuizController@subject');
Route::post('quiz/{id}/{name}/result', 'QuizController@result')->name('quiz_result');

Route::post('quiz/save', 'TestTakerController@store')->name('save');
Route::post('quiz/retry', 'TestTakerController@store')->name('retry');

Route::get('submitquiz', 'SubmitQuizController@create');
Route::post('submitquiz/next', 'SubmitQuizController@store');
Route::post('submitquiz/save', 'SubmitQuizController@store_question');
Route::get('submitquiz/{id}', 'SubmitQuizController@show')->name('show');
Route::get('submitquiz/{id}/edit', 'SubmitQuizController@edit');
Route::post('submitquiz/{id}/update', 'SubmitQuizController@update');
Route::get('list', 'SubmitQuizController@list');