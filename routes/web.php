<?php

/**
 * Public routes
 */
Route::get('/',     "HomeController@index")->name("home");
Route::get('/index', "HomeController@index");
Route::get('/test', "HomeController@test")->name("test");
