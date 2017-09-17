<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
    	return view("members", [
    		"title" => "Members"
    	]);
    }

    public function member(Request $request, $username)
    {
    	return view("member", [
            "title" => ""
        ]);
    }
}
