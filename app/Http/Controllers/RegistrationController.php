<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Jobs\RegisterUser;

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

        $user->active   = True;
        $user->email    = $input['email'];
        $user->username = $input['username'];
        $user->password = password_hash($input['password'], PASSWORD_BCRYPT);

        $user->save();
        $regRequest->delete();

        $password = exec("mkpasswd " . escapeshellarg($input['password']));
        RegisterUser::dispatch($input['username'], $password);

        return redirect()->route('register')->with('registered', True);
    }
}
