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
    return view('test', ["title" => "title.home"]);
})->name("home");

Route::get('/about', function () {
    return view('test', ["title" => "title.about"]);
})->name("about");

Route::get('/blog', function () {
    return view('test', ["title" => "title.blog"]);
})->name("blog");

Route::get('/gallery', function () {
    return view('test', ["title" => "title.gallery"]);
})->name("gallery");

Route::get('/members', function () {
    return view('test', ["title" => "title.members"]);
})->name("members");

Route::get('/map', function () {
    return view('test', ["title" => "title.map"]);
})->name("map");

