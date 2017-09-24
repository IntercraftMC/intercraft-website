<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
    	return view("about", [
    		"headerImage" => Null,
    		"title" => "About",
    		"mods" => config("modpack")
    	]);
    }
}
