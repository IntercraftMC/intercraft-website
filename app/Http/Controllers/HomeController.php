<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return ajax_view("home", "home");
    }

    public function test()
    {
        return ajax_view("test", "test");
    }
}
