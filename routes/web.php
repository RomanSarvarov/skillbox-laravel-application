<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Feedback
 */
Route::get('/contacts', 'FeedbackController@create')->name('contacts');
Route::post('/contacts', 'FeedbackController@store');
Route::get('/admin/feedbacks', 'FeedbackController@index');

/**
 * Posts
 */
Route::resource('/posts', 'PostController');

/**
 * Misc
 */
Route::get('/about', 'BaseController@about');
Route::get('/', 'BaseController@index');
