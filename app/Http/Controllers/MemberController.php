<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
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
        $profile = Profile::where("mc_username", $username)->first();
        if (!$profile || !$profile->user->active)
            return redirect()->route("members");

    	return view("member", [
            "title" => $profile->mc_username,
            "profile" => $profile
        ]);
    }
}
