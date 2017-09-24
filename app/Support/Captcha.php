<?php

namespace App\Support;

use App\Http\CaptchaResponse;

class Captcha
{
	public static function check($responseKey)
	{
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$fields = [
			'secret' => env("CAPTCHA_SECRET_KEY"),
			'response' => $responseKey,
		];

		$fieldString = '';
		foreach($fields as $key=>$value)
			$fieldString .= $key.'='.$value.'&';

		rtrim($fieldString, '&');

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_POST, count($fields));
		curl_setopt($c, CURLOPT_POSTFIELDS, $fieldString);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, True);
		$result = json_decode(curl_exec($c), True);
		curl_close($c);
		return $result["success"];
	}

	public static function html()
	{
		$key = env("CAPTCHA_SITE_KEY");
		return "<div class=\"g-recaptcha\" data-sitekey=\"{$key}\"></div>";
	}
}