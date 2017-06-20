<?php

require '../bootstrap/bootstrap.php';

use App\Models\GalleryImage;

$images = GalleryImage::all();

view('gallery', [
	'title' => 'Gallery - InterCraft',
	'images' => $images
]);