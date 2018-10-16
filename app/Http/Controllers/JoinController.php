<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index ()
    {
        return ajax_view("join", "title.join");
    }
}
