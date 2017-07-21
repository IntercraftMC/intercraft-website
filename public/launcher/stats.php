<?php

require('../../bootstrap/bootstrap.php');

use App\Minecraft;
use App\Models\User;
use App\Nbt\Nbt;

header('Content-Type: application/json');

$members = User::allActive();
$memberList = [];
foreach ($members as $member)
	$memberList[] = [
		'username' => $member->username(),
		'uuid' => $member->uuid(),
		'privilege' => $member->privilege()
	];

echo json_encode([
	'day' => Minecraft::currentDay(),
	'chunks' => Minecraft::chunkCount(),
	'players_online' => Minecraft::playersOnline(),
	'members' => $memberList,
	'privilege_names' => config()['user']['privilege']
]);