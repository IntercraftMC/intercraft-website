<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filesystem;
use App\Jobs\MountFilesystems;

class FsRegister extends Controller
{
	public function post(Request $request)
	{
		if ($this->isInvalid($request->all()))
			return jsonResponse("{}", 400);

		$isCreative   = boolval($request->creative);
		$user         = User::where("username", $request->username)->first();
		$drives       = json_decode($request->uuids);
		$completed    = [];
		$failed       = [];
		$survivalPath = rtrim(env("MINECRAFT_SURVIVAL_ROOT"), '/') .
				              '/' . env("MINECRAFT_SURVIVAL_WORLD") .
							  "/opencomputers/";
		$creativePath = rtrim(env("MINECRAFT_CREATIVE_ROOT"), '/') .
				              '/' . env("MINECRAFT_CREATIVE_WORLD") .
							  "/opencomputers/";
		foreach ($drives as $drive) {
			if (isFilesystemUuid($drive)) {
				$path = $isCreative ? $creativePath : $survivalPath;
				if (is_dir($path . $drive)) {
					if ($this->registerFilesystem($user, $drive, $isCreative)) {
						$completed[] = $drive;
						continue;
					}
				}
			}
			$failed[] = $drive;
		}
		return jsonResponse(json_encode([
			"completed" => $completed,
			"failed"    => $failed
		]), 200);
	}

	protected function isInvalid($input)
	{
		return Validator::make($input, [
			'creative' => 'required|boolean',
			'uuids' => 'required|json'
		])->fails();
	}

	protected function registerFilesystem(User $user, string $uuid, bool $isCreative)
	{
		if (Filesystem::where('uuid', $uuid)->where('is_creative', $isCreative)->first())
			return False;

		$fs = new Filesystem();
		$fs->user_id     = $user->id;
		$fs->is_creative = $isCreative;
		$fs->uuid        = $uuid;
		$fs->save();

		MountFilesystems::dispatch();

		return True;
	}
}
