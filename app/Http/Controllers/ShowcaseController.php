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

    // API Methods --------------------------------------------------------------------------------

    public function api_getProjects()
    {

    }

    public function api_getProject($project)
    {
        return response()->json(["discord_bg.png"]);
    }
}
