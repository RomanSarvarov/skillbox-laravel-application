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
Route::get('/contacts', 'FeedbackController@create')->name('contacts.create');
Route::post('/contacts', 'FeedbackController@store');
Route::get('/admin/feedbacks', 'FeedbackController@index')->name('contacts.index');

/**
 * Posts
 */
Route::resource('/posts', 'PostController');

/**
 * Tags
 */
Route::get('/tags/{tag:slug}', 'TagController@show')->name('tags.show');

/**
 * Misc
 */
Route::get('/about', 'BaseController@about')->name('page.about');
Route::get('/', 'PostController@index')->name('homepage');
