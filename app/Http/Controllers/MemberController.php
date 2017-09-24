<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
    	return view("members", [
    		"title" => "Members",
            "admins" => User::admins(),
            "vips" => User::vips(),
            "citizens" => User::citizens()
    	]);
    }

    public function member(Request $request, $username)
    {
        if (User::active()->where("username", $username)->count() == 0)
            return redirect()->route("members");

    	return view("member", [
            "title" => $username,
            "user" => User::where("username", $username)->first()
        ]);
    }
}
