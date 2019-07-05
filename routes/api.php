<?php

use Illuminate\Http\Request;

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

/**
 * Ajax Routes
 */
Route::middleware('auth:api')->group(function() {
    Route::get("/showcase")->name("api/showcase");
    Route::get("/showcase/{project}")->name("api/showcase-project");
});
