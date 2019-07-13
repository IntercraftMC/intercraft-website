<?php

namespace App\Http\Controllers;

use IntercraftDb\Models\Showcase;
use IntercraftDb\Models\ShowcaseItem;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index()
    {
        return ajax_view("showcase", "showcase", [
            "items" => Showcase::all()
        ]);
    }

    public function project($project)
    {
        return ajax_view("showcase", "showcase", [
            "items" => ShowcaseItem::where("showcase_id", $project)->get()
        ]);
    }

    // Ajax Methods --------------------------------------------------------------------------------

    public function ajax_index()
    {
        $response = [];
        foreach (Showcase::all() as $showcase) {
            $response[] = $showcase->attributesToArray();
        }
        return response()->json($response);
    }

    public function ajax_project($project)
    {
        $response = [];
        foreach (ShowcaseItem::where("showcase_id", $project)->get() as $item) {
            $response[] = $item->attributesToArray();
        }
        return response()->json($response);
    }
}
