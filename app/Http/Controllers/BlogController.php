<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
    	return view("welcome", [
    		"title" => "InterCraft - Home"
    	]);
    }

    public function entry(Request $request, $slug)
    {
    	return $slug;
    }
}
