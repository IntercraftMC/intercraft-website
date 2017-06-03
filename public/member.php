<?php

require '../bootstrap/bootstrap.php';
use App\Models\User;

$user = User::fromUsername(get('profile'));

if (!$user)
	redirect('members');

view('member', [
	'title' => "{$user->username()} - InterCraft Members",
	'user' => $user
]);