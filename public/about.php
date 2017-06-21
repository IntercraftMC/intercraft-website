<?php

require '../bootstrap/bootstrap.php';

$mods = config()['modpack'];

view('about', [
	'title' => "About InterCraft - InterCraft",
	'mods' => $mods
]);