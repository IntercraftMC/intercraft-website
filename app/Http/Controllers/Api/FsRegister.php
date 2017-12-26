<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FsRegisterRequest;
use App\Models\User;
use App\Models\Filesystem;
use App\Jobs\MountFilesystems;

class FsRegister extends Controller
{
	public function post(FsRegisterRequest $request)
	{
		$user      = User::where("username", $request->username)->first();
		$drives    = json_decode($request->uuids);
		$completed = [];
		$failed    = [];
		$fsPath    = rtrim(env("MINECRAFT_SURVIVAL_ROOT"), '/') .
				     '/' . env("MINECRAFT_SURVIVAL_WORLD") .
				     "/opencomputers/";
		foreach ($drives as $drive) {
			if (is_dir($fsPath . $drive)) {
				if ($this->registerFilesystem($user, $drive)) {
					$completed[] = $drive;
					continue;
				}
			}
			$failed[] = $drive;
		}
		return jsonResponse(json_encode([
			"completed" => $completed,
			"failed"    => $failed
		]), 200);
	}

	protected function registerFilesystem(User $user, string $uuid)
	{
		if (Filesystem::where('uuid', $uuid)->first())
			return False;

		$fs = new Filesystem();
		$fs->user_id = $user->id;
		$fs->uuid    = $uuid;
		$fs->save();

		MountFilesystems::dispatch();

		return True;
	}
}
