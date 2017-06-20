<?php

require '../bootstrap/bootstrap.php';

$mods = [
	
];

view('about', [
	'title' => "About InterCraft - InterCraft",
	'mods' => $mods
]);