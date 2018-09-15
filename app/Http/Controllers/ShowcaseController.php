<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index ()
    {
        return ajaxView("showcase", "title.showcase");
    }
}
