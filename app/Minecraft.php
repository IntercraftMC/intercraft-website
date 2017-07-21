<?php

namespace App;

use App\Nbt\Nbt;

class Minecraft
{
	public static function currentDay()
	{
		$mcConfig = config()['minecraft'];
		$nbt = new Nbt();
		$nbt->loadFile("{$mcConfig['server_root']}/{$mcConfig['world_name']}/level.dat");
		$root = $nbt->root();
		return floor($root['Data']['DayTime']->value() / 24000);
	}

	public static function chunkCount()
	{
		$mcConfig = config()['minecraft'];
		$path = joinPath($mcConfig['server_root'], $mcConfig['world_name']);
		return execUtil('count_chunks', $path);
	}

	public static function playersOnline()
	{
		$mcConfig = config()['minecraft'];
		return json_decode(execUtil('players_online', $mcConfig['server_address']), True);
	}
}