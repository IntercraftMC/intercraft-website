<?php

/**
 * Public routes
 */
Route::get('/',                 "HomeController@index")->name("home");
Route::get('/index',            "HomeController@index");
Route::get('/about',            "AboutController@index")->name("about");
Route::get('/map',              "MapController@index")->name("map");
Route::get('/members',          "MembersController@index")->name("members");
Route::get('/members/{member}', "MembersController@member")->name("member");
Route::get('/showcase',         "ShowcaseController@index")->name("showcase");
