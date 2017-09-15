<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function index()
    {
    	return view("welcome", [
    		"title" => "InterCraft - Home"
    	]);
    }

    public function post(Request $request)
    {
    	return "Post event";
    }
}
