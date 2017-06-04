<?php

namespace App;

class Crypto
{
	public static function generateAccessToken()
	{
		return sha1(openssl_random_pseudo_bytes(64));
	}
}