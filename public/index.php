<?php

require '../bootstrap/bootstrap.php';

use App\Models\GalleryImage;

$images = GalleryImage::all();

view('home', [
	'title' => "InterCraft - Minecraft Survival Server",
	'images' => array_slice($images, 0, 6),
	'adsenseId' => config()['adsense']['google_ad_client']
]);
