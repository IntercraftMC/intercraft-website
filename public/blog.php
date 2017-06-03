<?php

require '../bootstrap/bootstrap.php';

$posts = [];
for ($i = 0; $i < 5; $i++)
	$posts[] = [
		'id' => $i,
		'date' => 'May 27, 2017',
		'title' => 'Lorem Ipsum Dolor Sit Amet Consectetur',
		'author' => 'SirDavidLudwig',
		'img' => 'https://placekitten.com/825/400',
		'thumb' => 'https://placekitten.com/80/80',
		'views' => '113',
		'comments' => [],
		'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor inventore eligendi, sint accusamus at provident, quisquam commodi saepe dignissimos. Praesentium nihil error itaque! Id cum dignissimos, tempore aperiam voluptatum maxime.',
	];

view('blog', [
	'title' => 'Blog - InterCraft',
	'blogPosts' => $posts
]);