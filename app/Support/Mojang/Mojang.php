<?php

namespace App\Support\Mojang;

use GuzzleHttp\Client;

class Mojang
{
	protected static function client($baseUri)
	{
		return new Client(['base_uri' => $baseUri, 'timeout' => 5]);
	}

	public static function status()
	{
		$client = static::client("https://status.mojang.com");
		return $client->get("check") == 200;
	}

	public static function lookup(string $username)
	{
		static $cache = [];
		if (isset($cache[$username])) {
			return $cache[$username];
		}

		$client = static::client("https://api.mojang.com/users/profiles/minecraft/");
		$result = json_decode($client->get(urlencode($username)."?at=".time())->getBody());
		if ($result)
			return $cache[$username] = [
				"uuid" => $result->id,
				"username" => $result->name
			];
		return $cache[$username] = Null;
	}
}