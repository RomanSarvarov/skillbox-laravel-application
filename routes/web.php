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

/**
 * Admin dashboard
 */
Route::group([
	'prefix' => 'admin',
	'as' => 'admin.',
	'namespace' => 'Admin',
	'middleware' => 'dashboard'
], function () {
	Route::get('/', 'AdminController@dashboard');
});

/**
 * Front-end pages
 */
Route::resource('/posts', 'PostController');
Route::resource('/news', 'NewsController');

/**
 * Comments
 */
Route::post('/posts/{post:slug}', 'CommentController@storePost');
Route::post('/news/{news:slug}', 'CommentController@storeNews');

/**
 * Tags
 */
Route::get('/tags/{tag:slug}', 'TagController@show')->name('tags.show');

/**
 * Misc
 */
Route::get('/statistics', 'BaseController@statistics')->name('page.statistics');
Route::get('/about', 'BaseController@about')->name('page.about');
Route::get('/', 'BaseController@index')->name('homepage');

/**
 * Auth
 */
Auth::routes();

/**
 * Test
 */
Route::get('/test', function () {
    $post = \App\Models\Post::find(129);

    return $post->history;
});