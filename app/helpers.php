<?php

/**
 * Get the view to render depending on if the request is Ajax or not
 */
function ajaxView (string $page, $title, $args = [])
{
    if (Request::ajax()) {
        return response()->json([
            "title" => __($title),
            "view"  => (string) view("page.$page", $args)
        ])->header("Vary", "X-Requested-With");
    }
    return view("main", [
        "title" => __($title),
        "page"  => "page.$page",
        "vars"  => $args
    ]);
}

function discord_invitation ()
{
    return "https://discord.gg/" . config("discord")["invite_code"];
}
