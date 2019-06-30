<?php

/**
 * Get the view to render depending on if the request is Ajax or not
 */
function ajax_view(string $page, $title, $args = [])
{
    if (Request::ajax()) {
        return response()->json([
            "header" => config("header.$page", Null),
            "title"  => __($title),
            "view"   => (string) view("page.$page", $args)
        ])->header("Vary", "X-Requested-With");
    }
    return view("base.master", [
        "header" => config("header.$page", Null),
        "page"   => "page.$page",
        "title"  => __($title),
        "vars"   => $args
    ]);
}

/**
 * Generate a Discord invite link
 */
function discord_invite()
{
    return "https://discord.gg/" . env("DISCORD_INVITE_CODE");
}
