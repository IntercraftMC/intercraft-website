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

Route::get('/',         "HomeController@index")->name("home");
Route::get('/index',    "HomeController@index");
Route::get('/about',    "AboutController@index")->name("about");
Route::get('/blog',     "BlogController@index")->name("blog");
Route::get('/showcase', "ShowcaseController@index")->name("showcase");
Route::get('/members',  "MembersController@index")->name("members");
Route::get('/map',      "MapController@index")->name("map");
