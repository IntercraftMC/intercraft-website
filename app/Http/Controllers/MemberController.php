<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
    	return view("welcome", [
    		"title" => "InterCraft - Home"
    	]);
    }

    public function member(Request $request, $username)
    {
    	return $username;
    }
}
