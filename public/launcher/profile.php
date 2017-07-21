<?php

require('../../bootstrap/bootstrap.php');

use App\Models\User;

header('Content-Type: application/json');

// Check if the fields are set
if (fieldsExist($_POST, 'access_token')) {

	// Get the user from the database
	$user = User::fromToken(trim($_POST['access_token']));

	if ($user !== Null) {
		http_response_code(200);
		exit(json_encode([
			'email'     => $user->email(),
			'privilege' => $user->privilege(),
			'active'    => $user->isActive(),
			'uuid'      => $user->uuid(),
			'alt_uuids' => $user->altUuids()
		]));
	}
	http_response_code(401); // Not enough information
	exit("{}");
}
http_response_code(400); // Not enough information
exit("{}");