<?php

namespace App;

class Session
{
	public static function isCsrfTokenValid($token)
	{
		if (isset($_SESSION['csrf_token']))
			return $token === $_SESSION['csrf_token'];
		return False;
	}

	public static function csrfToken()
	{
		return $_SESSION['csrf_token'] = sha1(openssl_random_pseudo_bytes(32));
	}
}