<?php

require '../bootstrap/bootstrap.php';

use App\Models\BlogPost;

$post = BlogPost::fromId(fieldInt($_GET, 'id', -1));

if ($post == Null)
	redirect('blog');

view('blog_post', [
	'title' => $post->title() . ' - InterCraft',
	'post' => $post,
	'recent' => array_slice(BlogPost::all(), 0, 3),
	'archives' => BlogPost::archives(),
	'categories' => BlogPost::categories()
]);