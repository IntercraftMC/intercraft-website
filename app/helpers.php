<?php

/**
 * Get the view to render depending on if the request is Ajax or not
 */
function ajax_view (string $page, $title, $args = [])
{
    if (Request::ajax()) {
        return response()->json([
            "header" => config("header.$page", Null),
            "title"  => __($title),
            "view"   => (string) view("page.$page", $args)
        ])->header("Vary", "X-Requested-With");
    }
    return view("main", [
        "header" => config("header.$page", Null),
        "page"   => "page.$page",
        "title"  => __($title),
        "vars"   => $args
    ]);
}

function header_attributes($header)
{
    $header = $header ?? [];
    $result = [];
    if (isset($header["title"]))
        $result[] = 'title="' . $header["title"] . '"';
    if (isset($header["lead"]))
        $result[] = 'lead="' . $header["lead"] . '"';
    if (isset($header["video"]))
        $result[] = 'video="' . $header["video"] . '"';
    if (isset($header["size"]))
        $result[] = 'size="' . $header["size"] . '"';
    return implode(' ', $result);
}

function config_options ($config)
{
    $results = [];
    foreach (config($config) as $key => $value) {
        $results[] = "<option value=\"$key\">$value</option>";
    }
    return implode("\n", $results);
}

function discord_invitation ()
{
    return "https://discord.gg/" . config("discord.invite_code");
}
