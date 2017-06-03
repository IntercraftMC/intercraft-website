<?php

require '../bootstrap/bootstrap.php';

$images = [];
for ($i = 0; $i < 11; $i++)
	$images[] = 1;

view('gallery', [
	'title' => 'Gallery - InterCraft',
	'images' => $images
]);