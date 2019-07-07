<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index()
    {
        return ajax_view("showcase", "showcase");
    }

    public function project($project)
    {
        return ajax_view("showcase", "showcase");
    }

    // Ajax Methods --------------------------------------------------------------------------------

    public function ajax_index()
    {
        return response()->json(["discord_bg.png"]);
    }

    public function ajax_project($project)
    {
        return response()->json(["discord_bg.png"]);
    }
}
