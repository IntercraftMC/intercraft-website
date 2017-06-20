<?php

namespace App\Mojang;

use App\Http\Request;
use App\Http\Response;

class Mojang
{
	/**
	 * Get the status of the various Mojang/Minecraft servers
	 * @return App\Mojang\MojangStatus
	 */
	public static function status()
	{
		// Send the request
		$request = new Request('https://status.mojang.com/check', Request::GET);
		$response = $request->send();

		return new MojangStatus(json_decode($response->content(), True));
	}

	/**
	 * Get a user's UUID from their username
	 * @param  string $username 
	 * @return null|string 
	 */
	public static function uuidFromUsername(string $username)
	{
		$timestamp = (string) time();
		$request = new Request("https://api.mojang.com/users/profiles/minecraft/$username?at=$timestamp");
		$response = $request->send();

		if ($response->statusCode() != 200)
			return Null;
		
		$uuid = json_decode($response->content(), True)['id'];
		return $uuid;
	}

	public static function userExists(string $username)
	{
		return self::uuidFromUsername($username) !== Null;
	}

	public function profile(string $uuid)
	{
		$request = new Request("https://sessionserver.mojang.com/session/minecraft/profile/$uuid");
		$response = $request->send();

		if ($response->statusCode() != 200)
			return Null;
		
		$data = json_decode($response->content(), True);
		return new MojangProfile($data);
	}

	public function skinUrl(string $username)
	{
		return "http://skins.minecraft.net/MinecraftSkins/$username.png";
	}
}