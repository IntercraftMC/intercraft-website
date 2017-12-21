<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    public function index()
    {
        return view("register", [
            "title" => "Complete your Registration"
        ]);
    }

    public function post(RegistrationRequest $request)
    {
        $regRequest = $request->registerRequest();
        $user       = $regRequest->user;

        $input = $request->all();

        $user->email    = $input['email'];
        $user->username = $input['username'];
        $user->password = password_hash($input['password'], PASSWORD_BCRYPT);

        $user->save();
        $regRequest->delete();

        return redirect()->route('register')->with('registered', True);
    }
}
