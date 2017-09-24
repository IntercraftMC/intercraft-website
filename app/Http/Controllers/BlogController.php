<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
    	return view("blog", [
    		"title" => "Blog",
            "posts" => Blog::orderBy("id", "desc")->get(),
            "recent" => Blog::recent(),
            "categories" => Blog::categories(),
            "archives" => Blog::archives()
    	]);
    }

    public function entry(Request $request, $slug)
    {
        if (Blog::where("id", $slug)->count() == 0)
            return redirect()->route("blog");

        return view("blog_entry", [
            "title" => $slug,
            "post" => Blog::slug($slug),
            "recent" => Blog::recent(),
            "categories" => Blog::categories(),
            "archives" => Blog::archives()
        ]);
    }
}
