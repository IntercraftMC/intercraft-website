<?php

namespace App\Support;

class SvgLoader
{
    public static function load($path, $class = Null, $size = Null)
    {
        $svg = new \DOMDocument();
        $svg->load(public_path("img/$path"));
        if ($class) {
            $svg->documentElement->setAttribute("class", $class);
        }
        if ($size) {
            $svg->documentElement->setAttribute("width", $size[0]);
            $svg->documentElement->setAttribute("height", $size[1]);
        }
        $output = $svg->saveXML($svg->documentElement);
        return $output;
    }
}
