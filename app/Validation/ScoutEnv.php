<?php

namespace App\Validation;

use Scout\ScoutEnvironment;

class ScoutEnv extends ScoutEnvironment
{
	public function __construct($localePath, $database)
	{
		parent::__construct($localePath, $database, []);

		$this->addCustomConstraints();
	}

	public function addCustomConstraints()
	{
		$constraints = [
			'field' => [
				'captcha' => 'App\Validation\Constraints\Field\CaptchaConstraint',
				'minecraft_user' => 'App\Validation\Constraints\Field\MinecraftUserConstraint'
			]
		];

		$locale = [
			'field' => [
				'minecraft_user' => "This Minecraft username doesn't exist"
			]
		];

		$this->addConstraints($constraints);
		$this->addLocale($locale);
	}
}