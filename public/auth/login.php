<?php

require('../../bootstrap/bootstrap.php');

use App\Models\User;

header('Content-Type: application/json');

// Check if the fields are set
if (fieldsExist($_POST, 'email', 'password')) {

	// Get the user from the database
	$user = User::fromEmail(trim($_POST['email']));
	
	// Check if a user with the email exists
	if ($user !== Null) {

		// Check the password
		if (password_verify($_POST['password'], $user->password())) {

			// Generate a new access token and save it to the database
			$user->generateToken()
			     ->save();

			// Respond
			http_response_code(200);
			exit(json_encode([
				'status' => 200,
				'error_code' => 0,
				'access_token' => $user->token(),
			]));
		}
	}
	http_response_code(401); // Invalid email/password
	exit(json_encode([
		'status' => 401,
		'error_code' => 2
	]));
}
http_response_code(400); // Not enough information
exit(json_encode([
	'status' => 400,
	'error_code' => 1
]));