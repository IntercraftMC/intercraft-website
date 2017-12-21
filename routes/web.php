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

Route::get('/',                   'HomeController@index')->name('home');
Route::get('/about',              'AboutController@index')->name('about');
Route::get('/blog',               'BlogController@index')->name('blog');
Route::get('/blog/{slug}',        'BlogController@entry')->name('blog_entry');
Route::get('/gallery',            'GalleryController@index')->name('gallery');
Route::get('/members',            'MemberController@index')->name('members');
Route::get('/members/{username}', 'MemberController@member')->name('members_member');
Route::get('/map',                'MapController@index')->name('map');
Route::get('/join',               'JoinController@index')->name('join');

Route::post('/join',     'JoinController@store');

Route::middleware(['App\Http\Middleware\Registration'])->group(function() {
	Route::get('/register', 'RegistrationController@index')->name('register');
	Route::post('/register', 'RegistrationController@post');
});
