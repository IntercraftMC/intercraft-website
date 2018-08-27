<?php

/**
 * Get the view to render depending on if the request is Ajax or not
 */
function ajaxView (string $page, $title, $args = [])
{
    if (Request::ajax()) {
        return response()->json([
            "title" => $title,
            "view"  => (string) view("page.$page", $args)
        ])->header("Vary", "X-Requested-With");
    }
    return view("main", [
        "title" => $title,
        "page"  => "page.$page",
        "vars"  => $args
    ]);
}

function is_nav_item_active ($route)
{
    return True;
}
