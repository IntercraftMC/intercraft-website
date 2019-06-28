<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index()
    {
        return ajax_view("home", "showcase");
    }
}
