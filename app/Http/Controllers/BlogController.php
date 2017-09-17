<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
    	return view("blog", [
    		"title" => "Blog"
    	]);
    }

    public function entry(Request $request, $slug)
    {
    	return $slug;
    }
}
