<?php

require '../bootstrap/bootstrap.php';

if (count($_POST) > 0) {
	$response = App\Captcha::response();
	if ($response->isSuccess())
		exit("Success!");
}

view('join', [
	'title' => 'Join InterCraft',
	'questions' => config()['questionnaire']
]);