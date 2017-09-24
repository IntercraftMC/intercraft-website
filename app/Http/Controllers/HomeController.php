<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage;

class HomeController extends Controller
{
    public function index()
    {
    	return view("home", [
    		"title" => "Home",
    		"images" => GalleryImage::orderBy("id", "desc")->take(6)->get()
    	]);
    }
}
