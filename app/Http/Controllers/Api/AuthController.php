<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
	public function login(LoginRequest $request)
	{
		$user = User::where("email", $request->email)->first();
		if ($user->checkPassword($request->password)) {
			$user->generateAccessToken()->save();
			return $user->toJson();
		}
		return jsonResponse("{{$request->password}}", 401);
	}

	public function logout(Request $request)
	{
		$user = User::where("token", $request->token)->first();
		$user->token = Null;
		$user->save();
		return "{}";
	}

	public function sendResetPassword(Request $request)
	{
		// I'll do this later...
	}

	public function resetPassword(Request $request)
	{
		// I'll do this later too...
	}

	public function setPassword(Request $request)
	{
		if ($request->filled("new_password")) {
			$user = User::where("token", $request->token)->first();
			$user->setPassword($request->new_password)
			     ->save();
			return jsonResponse("Success");
		}
		return jsonResponse("Failure", 400);
	}
}
