<?php

require '../bootstrap/bootstrap.php';

use App\Models\User;

view('members', [
	'title' => 'Members - InterCraft',
	'users' => User::allActive()
]);