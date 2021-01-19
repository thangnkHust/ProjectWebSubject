<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Auth
Route::post('/login', 'Api\Auth\LoginController@store');
Route::delete('/logout', 'Api\Auth\LoginController@destroy')->middleware('auth:api');
Route::post('/register','Api\Auth\RegisterController');
// Questions
Route::get('/questions', 'Api\QuestionsController@index');
Route::get('/questions/{question}/answers', 'Api\AnswersController@index');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/questions/{question}-{slug}', 'Api\QuestionDetailsController');
Route::middleware(['auth:api', 'cors'])->group(function() {
    // REturn current user
    Route::get('/user', function(Request $request){
        return $request->user();
    })->name('user');

    Route::post('/change-profile', 'Api\UsersController@update');
    // For questions function
    Route::apiResource('questions', 'Api\QuestionsController')->except('index');
    // For answers function
    Route::apiResource('questions.answers', 'Api\AnswersController')->except('index');
    // For vote function
    Route::post('/questions/{question}/vote', 'Api\VoteQuestionController');
    Route::post('/answers/{answer}/vote', 'Api\VoteAnswerController');

    Route::post('/answers/{answer}/accept', 'Api\AcceptAnswerController')->name('answers.accept');
    Route::post('/questions/{question}/favorites', 'Api\FavoritesController@store')->name('questions.favorite')->middleware('auth');
    Route::delete('/questions/{question}/favorites', 'Api\FavoritesController@destroy')->name('questions.unfavorite')->middleware('auth');
    Route::get('/my-posts', 'Api\MyPostsController');
});
