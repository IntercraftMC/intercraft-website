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

Route::get('/hash/{passwd}', function($passwd) { return password_hash($passwd, PASSWORD_BCRYPT); });

Route::get('/status', function(Request $request) {
	return '{"online": true}';
});

Route::get('/authenticate', "\App\Http\Controllers\Api\AuthController@authenticate")->middleware("auth.token");

Route::patch('/login', "\App\Http\Controllers\Api\AuthController@login");
Route::patch('/logout', "\App\Http\Controllers\Api\AuthController@logout")->middleware("auth.token");

Route::put('/password_reset_send', "\App\Http\Controllers\Api\AuthController@sendResetPassword");
Route::patch('/password_reset', "\App\Http\Controllers\Api\AuthController@resetPassword");
Route::patch('/password_set', "\App\Http\Controllers\Api\AuthController@setPassword")->middleware("auth.password");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('/authenticate', "\App\Http\Controllers\Api\AuthController@authenticate");
Route::middleware(['api', 'auth_user'])->post('/register_fs', "\App\Http\Controllers\Api\FsRegister@post");
// Route::get('/register_fs', "\App\Http\Controllers\Api\FsRegister@post");
