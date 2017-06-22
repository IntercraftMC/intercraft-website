<?php

require '../bootstrap/bootstrap.php';

use App\Models\BlogPost;

$posts      = BlogPost::all();
$categories = BlogPost::categories();
$archives   = BlogPost::archives();

view('blog', [
	'title' => 'Blog - InterCraft',
	'mainBlogPost' => $posts[0],
	'blogPosts' => $posts,
	'recent' => array_slice($posts, 0, 3),
	'archives' => $archives,
	'categories' => $categories
]);