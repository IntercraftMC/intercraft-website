<?php

require '../bootstrap/bootstrap.php';

use App\Captcha;
use App\Models\Application;
use App\Mojang\Mojang;

// Load the questions from the questionnaire
$questions = config()['questionnaire'];

$signUp = False;

// Generate the fields from the form
$fields = ['email', 'username'];
$questionFields = [];
for ($i = 0; $i < count($questions); $i++) {
	$questionFields[] = "question-$i";
}

// Check if the fields have been submitted
if (fieldsExist($_POST, ...array_merge($fields, $questionFields))) {

	$email = trim(post('email'));
	$username = trim(post('username'));

	// Validate the form
	$form = [
		['email', "required|email|unique('applications','email')", [
			'required' => 'Ahh, unfortunately an email is required, dangit',
			'email' => 'This is clearly not an email address...',
			'unique' => 'An application with this email already exists',
		]],
		['username', "required|minecraft_user", [
			'required' => 'Your Minecraft username is required',
			'minecraft_user' => 'Nice try, but seriously, we need your Minecraft username'
		]],
		['age', "required"],
		['g-recaptcha-response', "required|captcha"]
	];
		
	// Parse the result
	$result = validate($form);

	$questionnaire = [];
	for ($i = 0; $i < count($questionFields); $i++)
		$questionnaire[$questions[$i]['question']] = post($questionFields[$i]);

	if ($result->noErrors()) {

		$application = new Application();
		$application->setEmail($email)
		            ->setUsername($username)
		            ->setUuid(Mojang::uuidFromUsername($username))
		            ->setAnswers($questionnaire)
		            ->save();
		$signUp = True;
	}
}

view('join', [
	'title' => 'Join InterCraft',
	'questions' => $questions,
	'signUp' => $signUp
]);