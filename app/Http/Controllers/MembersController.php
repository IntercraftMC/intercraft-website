<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        return ajax_view("home", "members");
    }

    public function member($member)
    {
        return ajax_view("home", "member");
    }
}
