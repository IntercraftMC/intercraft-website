<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
    	return view("gallery", [
    		"title" => "Gallery",
    		"images" => GalleryImage::orderBy("id", "desc")->get()
    	]);
    }
}
