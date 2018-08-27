<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index ()
    {
        return ajaxView("members", "title.members");
    }
}
